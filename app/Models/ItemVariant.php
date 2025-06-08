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
    public function getPriceFor($user = null, $customerId = null)
    {
        return $this->prices()
            ->where(function ($q) use ($user, $customerId) {
                $q->where(function ($q) use ($user) {
                    $q->where('user_id', optional($user)->id)
                        ->orWhereNull('user_id');
                })->where(function ($q) use ($customerId) {
                    $q->where('customer_id', $customerId)
                        ->orWhereNull('customer_id');
                })->where(function ($q) use ($user) {
                    $q->where('role', optional($user)->role)
                        ->orWhereNull('role');
                });
            })
            ->orderByRaw('
                (user_id IS NOT NULL) DESC,
                (customer_id IS NOT NULL) DESC,
                (role IS NOT NULL) DESC
            ')
            ->first()
            ->price ?? $this->default_price; // fallback, see next step
    }

    public function variantPrices()
    {
        return $this->hasMany(ItemVariantPrice::class, 'item_variant_id');
    }

    public function basePrice()
    {
        return $this->hasOne(ItemVariantPrice::class, 'item_variant_id')
            ->whereNull('user_id')
            ->whereNull('applies_to_role');
    }



}
