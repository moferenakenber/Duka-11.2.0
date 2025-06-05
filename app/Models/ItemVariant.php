<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ItemVariantPrice;
use Illuminate\Support\Facades\Auth;

class ItemVariant extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_variants'; // Explicitly set the table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'item_color_id',
        'item_size_id',
        'item_packaging_type_id',
        'is_active',
        'price',
        'stock',
        'owner_id',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the item that owns the variant.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the color associated with the variant.
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(ItemColor::class, 'item_color_id');
    }

    /**
     * Get the size associated with the variant.
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(ItemSize::class, 'item_size_id');
    }

    /**
     * Get the packaging type associated with the variant.
     */
    public function packagingType(): BelongsTo
    {
        return $this->belongsTo(ItemPackagingType::class, 'item_packaging_type_id');
    }

    public function itemColor()
    {
        return $this->belongsTo(ItemColor::class);
    }

    public function itemSize()
    {
        return $this->belongsTo(ItemSize::class);
    }

    public function itemPackagingType()
    {
        return $this->belongsTo(ItemPackagingType::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // public function prices()
    // {
    //     return $this->hasMany(ItemVariantPrice::class, 'item_variant_id');
    // }

    public function prices(): HasMany
    {
        return $this->hasMany(ItemVariantPrice::class);
    }

    /**
     * Get the applicable price for this variant, considering user and their role.
     *
     * @param User|null $user The user to check for (defaults to authenticated user).
     * @param string $currency The currency code (defaults to 'USD').
     * @return float|null The applicable price or null if not found.
     */
    public function getApplicablePrice(?User $user = null, string $currency = 'USD'): ?float
    {
        if (is_null($user) && Auth::check()) {
            $user = Auth::user();
        }

        $queryBase = $this->prices()->where('currency', $currency);

        // 1. Check for User-Specific Price
        if ($user) {
            $userPrice = (clone $queryBase)
                ->where('user_id', $user->id)
                ->whereNull('applies_to_role') // Ensure it's specifically for the user
                ->orderBy('created_at', 'desc')
                ->first();
            if ($userPrice) {
                return (float) $userPrice->price;
            }
        }

        // 2. Check for Role-Specific Price (using the user's 'role' attribute)
        if ($user && !empty($user->role)) { // Check if the user has a role defined
            $rolePrice = (clone $queryBase)
                ->where('applies_to_role', $user->role) // Match the role name
                ->whereNull('user_id')                   // Ensure it's a role price, not user-specific
                ->orderBy('created_at', 'desc')
                ->first();
            if ($rolePrice) {
                return (float) $rolePrice->price;
            }
        }

        // 3. Fallback to Base Price
        $basePrice = (clone $queryBase)
            ->whereNull('user_id')
            ->whereNull('applies_to_role')
            ->orderBy('created_at', 'desc')
            ->first();

        return $basePrice ? (float) $basePrice->price : null;
    }


}
