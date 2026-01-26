<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class PriceProvider
{
    /**
     * Get the full price ladder for a store variant
     *
     * @param int $storeVariantId
     * @param int $storeId
     * @param int|null $sellerId
     * @param int|null $customerId
     * @return array
     */
    public static function getPriceLadder(int $storeVariantId, int $storeId, ?int $sellerId = null, ?int $customerId = null): array
    {
        $prices = [];

        // 1️⃣ Base Store Variant Price
        $storeVariant = DB::table('store_variants')
            ->where('id', $storeVariantId)
            ->where('store_id', $storeId)
            ->first();

        if (!$storeVariant) {
            return [];
        }

        $prices[] = self::formatPrice('store', $storeVariant);

        // 2️⃣ Seller Price (override)
        if ($sellerId && Schema::hasTable('store_variant_seller_prices')) {
            $sellerPrice = DB::table('store_variant_seller_prices')
                ->where('store_variant_id', $storeVariantId)
                ->where('seller_id', $sellerId)
                ->where('active', true)
                ->first();

            if ($sellerPrice) {
                $prices[] = self::formatPrice('seller', $sellerPrice);
            }
        }

        // 3️⃣ Customer Price (override)
        if ($customerId && Schema::hasTable('store_variant_customer_prices')) {
            $customerPrice = DB::table('store_variant_customer_prices')
                ->where('store_variant_id', $storeVariantId)
                ->where('customer_id', $customerId)
                ->where('active', true)
                ->first();

            if ($customerPrice) {
                $prices[] = self::formatPrice('customer', $customerPrice);
            }
        }

        return $prices;
    }

    /**
     * Get the final price (last applicable layer)
     */
    public static function getFinalPrice(array $priceLadder): ?float
    {
        if (empty($priceLadder))
            return null;

        return end($priceLadder)['final'];
    }

    /**
     * Format price with discount check
     */
    protected static function formatPrice(string $level, object $row): array
    {
        $now = Carbon::now();

        $final = ($row->discount_price && (!isset($row->discount_ends_at) || $now->lt($row->discount_ends_at)))
            ? $row->discount_price
            : $row->price;

        return [
            'level' => $level,
            'price' => $row->price,
            'discount_price' => $row->discount_price,
            'discount_ends_at' => $row->discount_ends_at ?? null,
            'final' => $final,
        ];
    }
}
