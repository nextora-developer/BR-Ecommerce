<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parents = [
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'icon' => 'categories/accessories.jpg',
                'sort_order' => 1,
                'children' => [
                    ['name' => 'Watches', 'slug' => 'accessories-watches'],
                    ['name' => 'Bags', 'slug' => 'accessories-bags'],
                    ['name' => 'Jewelry', 'slug' => 'accessories-jewelry'],
                    ['name' => 'Belts & Hats', 'slug' => 'accessories-belts-hats'],
                ],
            ],
            [
                'name' => 'Home & Living',
                'slug' => 'home-living',
                'icon' => 'categories/home.jpg',
                'sort_order' => 2,
                'children' => [
                    ['name' => 'Home Decor', 'slug' => 'home-decor'],
                    ['name' => 'Furniture', 'slug' => 'home-furniture'],
                    ['name' => 'Lighting', 'slug' => 'home-lighting'],
                    ['name' => 'Storage & Organizers', 'slug' => 'home-storage'],
                ],
            ],
            [
                'name' => 'Beauty & Personal Care',
                'slug' => 'beauty-personal-care',
                'icon' => 'categories/beauty.jpg',
                'sort_order' => 3,
                'children' => [
                    ['name' => 'Skincare', 'slug' => 'beauty-skincare'],
                    ['name' => 'Hair Care', 'slug' => 'beauty-hair-care'],
                    ['name' => 'Makeup', 'slug' => 'beauty-makeup'],
                    ['name' => 'Personal Care', 'slug' => 'beauty-personal'],
                ],
            ],
            [
                'name' => 'Gadgets',
                'slug' => 'gadgets',
                'icon' => 'categories/gadgets.jpg',
                'sort_order' => 4,
                'children' => [
                    ['name' => 'Smart Devices', 'slug' => 'gadgets-smart'],
                    ['name' => 'Mobile Accessories', 'slug' => 'gadgets-mobile'],
                    ['name' => 'Computer Accessories', 'slug' => 'gadgets-computer'],
                    ['name' => 'Audio & Wearables', 'slug' => 'gadgets-audio'],
                ],
            ],
            [
                'name' => 'Sports & Outdoors',
                'slug' => 'sports-outdoors',
                'icon' => 'categories/sports.jpg',
                'sort_order' => 5,
                'children' => [
                    ['name' => 'Fitness Equipment', 'slug' => 'sports-fitness'],
                    ['name' => 'Outdoor Gear', 'slug' => 'sports-outdoor-gear'],
                    ['name' => 'Sportswear', 'slug' => 'sports-wear'],
                ],
            ],
            [
                'name' => 'Kitchen & Dining',
                'slug' => 'kitchen-dining',
                'icon' => 'categories/kitchen.jpg',
                'sort_order' => 6,
                'children' => [
                    ['name' => 'Cookware', 'slug' => 'kitchen-cookware'],
                    ['name' => 'Utensils', 'slug' => 'kitchen-utensils'],
                    ['name' => 'Tableware', 'slug' => 'kitchen-tableware'],
                    ['name' => 'Kitchen Storage', 'slug' => 'kitchen-storage'],
                ],
            ],
            [
                'name' => 'Pet Supplies',
                'slug' => 'pet-supplies',
                'icon' => 'categories/pets.jpg',
                'sort_order' => 7,
                'children' => [
                    ['name' => 'Pet Food', 'slug' => 'pet-food'],
                    ['name' => 'Pet Toys', 'slug' => 'pet-toys'],
                    ['name' => 'Pet Grooming', 'slug' => 'pet-grooming'],
                ],
            ],
            [
                'name' => 'Toys & Games',
                'slug' => 'toys-games',
                'icon' => 'categories/toys.jpg',
                'sort_order' => 8,
                'children' => [
                    ['name' => 'Educational Toys', 'slug' => 'toys-educational'],
                    ['name' => 'Board Games', 'slug' => 'toys-board-games'],
                    ['name' => 'Action Figures', 'slug' => 'toys-figures'],
                ],
            ],
            [
                'name' => 'Stationery & Office',
                'slug' => 'stationery-office',
                'icon' => 'categories/stationery.jpg',
                'sort_order' => 9,
                'children' => [
                    ['name' => 'Writing Supplies', 'slug' => 'office-writing'],
                    ['name' => 'Office Essentials', 'slug' => 'office-essentials'],
                    ['name' => 'School Supplies', 'slug' => 'office-school'],
                ],
            ],
            [
                'name' => 'Automotive',
                'slug' => 'automotive',
                'icon' => 'categories/automotive.jpg',
                'sort_order' => 10,
                'children' => [
                    ['name' => 'Car Accessories', 'slug' => 'auto-accessories'],
                    ['name' => 'Car Care', 'slug' => 'auto-care'],
                    ['name' => 'Motorcycle Gear', 'slug' => 'auto-motorcycle'],
                ],
            ],
            [
                'name' => 'Baby & Kids',
                'slug' => 'baby-kids',
                'icon' => 'categories/kids.jpg',
                'sort_order' => 11,
                'children' => [
                    ['name' => 'Baby Essentials', 'slug' => 'baby-essentials'],
                    ['name' => 'Kids Clothing', 'slug' => 'kids-clothing'],
                    ['name' => 'Kids Toys', 'slug' => 'kids-toys'],
                ],
            ],
            [
                'name' => 'Health & Wellness',
                'slug' => 'health-wellness',
                'icon' => 'categories/health.jpg',
                'sort_order' => 12,
                'children' => [
                    ['name' => 'Supplements', 'slug' => 'health-supplements'],
                    ['name' => 'Medical Devices', 'slug' => 'health-devices'],
                    ['name' => 'Personal Health', 'slug' => 'health-personal'],
                ],
            ],
            [
                'name' => 'Fashion & Apparel',
                'slug' => 'fashion-apparel',
                'icon' => 'categories/fashion.jpg',
                'sort_order' => 13,
                'children' => [
                    ['name' => 'T-Shirts', 'slug' => 'fashion-tshirts'],
                    ['name' => 'Hoodies & Jackets', 'slug' => 'fashion-hoodies'],
                    ['name' => 'Pants & Bottoms', 'slug' => 'fashion-pants'],
                    ['name' => 'Footwear', 'slug' => 'fashion-footwear'],
                ],
            ],
            [
                'name' => 'Travel & Luggage',
                'slug' => 'travel-luggage',
                'icon' => 'categories/travel.jpg',
                'sort_order' => 14,
                'children' => [
                    ['name' => 'Luggage', 'slug' => 'travel-luggage-items'],
                    ['name' => 'Travel Accessories', 'slug' => 'travel-accessories'],
                    ['name' => 'Outdoor Travel Gear', 'slug' => 'travel-outdoor'],
                ],
            ],
            [
                'name' => 'Groceries & Food',
                'slug' => 'groceries-food',
                'icon' => 'categories/food.jpg',
                'sort_order' => 15,
                'children' => [
                    ['name' => 'Snacks', 'slug' => 'food-snacks'],
                    ['name' => 'Beverages', 'slug' => 'food-beverages'],
                    ['name' => 'Organic & Healthy Food', 'slug' => 'food-organic'],
                ],
            ],
        ];

        foreach ($parents as $parentData) {
            $parent = Category::updateOrCreate(
                ['slug' => $parentData['slug']],
                [
                    'name'       => $parentData['name'],
                    'icon'       => $parentData['icon'],
                    'parent_id'  => null,
                    'is_active'  => true,
                    'sort_order' => $parentData['sort_order'],
                ]
            );

            foreach ($parentData['children'] as $index => $child) {
                Category::updateOrCreate(
                    ['slug' => $child['slug']],
                    [
                        'name'       => $child['name'],
                        'parent_id'  => $parent->id,
                        'is_active'  => true,
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }
    }
}
