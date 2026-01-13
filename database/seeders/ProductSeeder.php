<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 你要更多就改这个数字：每个 sub category 生成多少个产品
        $perSub = 4;

        $adjectives = ['Classic', 'Premium', 'Minimal', 'Signature', 'Essential', 'Modern', 'Pro', 'Everyday'];
        $suffixes   = ['Edition', 'Series', 'Collection', 'Set', 'Kit', 'Pack', 'Bundle', 'Style'];

        // 不同 parent 给不同价格区间（更像真的）
        $parentBase = [
            'fashion-apparel'     => [29, 169],
            'accessories'         => [19, 199],
            'gadgets'             => [49, 499],
            'home-living'         => [29, 399],
            'beauty-personal-care' => [15, 199],
            'sports-outdoors'     => [25, 399],
            'kitchen-dining'      => [19, 299],
            'pet-supplies'        => [12, 189],
            'toys-games'          => [15, 249],
            'stationery-office'   => [5, 129],
            'automotive'          => [19, 399],
            'baby-kids'           => [15, 249],
            'health-wellness'     => [19, 299],
            'travel-luggage'      => [29, 499],
            'groceries-food'      => [5, 99],
        ];

        // 只抓 sub categories（产品应该绑 sub）
        $subs = Category::where('is_active', true)
            ->whereNotNull('parent_id')
            ->with('parent')
            ->orderBy('parent_id')
            ->orderBy('sort_order')
            ->get();

        foreach ($subs as $cat) {
            $parentSlug = $cat->parent?->slug;

            [$min, $max] = $parentBase[$parentSlug] ?? [19, 199];

            for ($i = 1; $i <= $perSub; $i++) {
                $adj = $adjectives[($i - 1) % count($adjectives)];
                $suf = $suffixes[($i - 1) % count($suffixes)];

                // 产品名（更像真的）
                $name = "{$adj} {$cat->name} {$suf}";

                // slug 保证唯一：加上 category slug + 编号
                $slug = Str::slug($name) . '-' . $cat->slug . '-' . $i;

                // 价格：用 deterministic 方式算（每次跑都一样）
                $seed = abs(crc32($cat->slug . '|' . $i));
                $price = $min + ($seed % (($max - $min) + 1));
                $price = round($price - 0.10, 2); // 给一点“xx.90”感

                $stock = 10 + ($seed % 41); // 10 ~ 50

                Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id'       => $cat->id,
                        'name'              => $name,
                        'slug'              => $slug,
                        'short_description' => "Curated {$cat->name} item for everyday use.",
                        'description'       => "A premium {$cat->name} product under {$cat->parent?->name}. Designed for quality, comfort, and daily lifestyle needs.",
                        'price'             => $price,
                        'stock'             => $stock,
                        'has_variants'      => false,
                        'is_active'         => true,
                        'is_digital'        => false,
                        'image'             => null,
                    ]
                );
            }
        }
    }
}
