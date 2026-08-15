<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'category_code' => 'CAT001', 'category_name' => 'Khmer Main Dishes', 'description' => 'Traditional Cambodian main courses'],
            ['id' => 2, 'category_code' => 'CAT002', 'category_name' => 'Noodles & Soup', 'description' => 'Khmer noodle dishes and soups'],
            ['id' => 3, 'category_code' => 'CAT003', 'category_name' => 'Street Food', 'description' => 'Popular Cambodian street food'],
            ['id' => 4, 'category_code' => 'CAT004', 'category_name' => 'Khmer Desserts', 'description' => 'Traditional Cambodian sweets'],
            ['id' => 5, 'category_code' => 'CAT005', 'category_name' => 'Drinks', 'description' => 'Cambodian beverages'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], $category);
        }

        // Remove old Western demo products if they exist
        Product::whereIn('product_code', [
            'BUR001', 'PIZ001', 'SUS001', 'DES001', 'DRK001',
        ])->delete();

        $products = [
            [
                'category_id' => 1,
                'product_code' => 'KHM001',
                'product_name' => 'Fish Amok',
                'description' => 'Steamed fish curry with coconut milk, kroeung paste, and banana leaf.',
                'cost_price' => 4.50,
                'selling_price' => 8.99,
                'stock_qty' => 40,
                'barcode' => '100000000001',
                'image' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b9a2?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 1,
                'product_code' => 'KHM002',
                'product_name' => 'Beef Lok Lak',
                'description' => 'Stir-fried beef with lime-pepper dipping sauce, served with rice and fresh vegetables.',
                'cost_price' => 5.00,
                'selling_price' => 9.99,
                'stock_qty' => 35,
                'barcode' => '100000000002',
                'image' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 1,
                'product_code' => 'KHM003',
                'product_name' => 'Chicken Red Curry',
                'description' => 'Khmer-style red curry with chicken, coconut milk, eggplant, and fresh herbs.',
                'cost_price' => 4.00,
                'selling_price' => 7.99,
                'stock_qty' => 30,
                'barcode' => '100000000003',
                'image' => 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cb?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 1,
                'product_code' => 'KHM004',
                'product_name' => 'Grilled Mekong Fish',
                'description' => 'Whole fish grilled with lemongrass, garlic, and Cambodian spices.',
                'cost_price' => 6.00,
                'selling_price' => 11.99,
                'stock_qty' => 25,
                'barcode' => '100000000004',
                'image' => 'https://images.unsplash.com/photo-1515443961218-a51367888e4b?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 2,
                'product_code' => 'KHM005',
                'product_name' => 'Kuy Teav',
                'description' => 'Classic Cambodian rice noodle soup with pork broth, herbs, and bean sprouts.',
                'cost_price' => 2.50,
                'selling_price' => 4.99,
                'stock_qty' => 50,
                'barcode' => '100000000005',
                'image' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 2,
                'product_code' => 'KHM006',
                'product_name' => 'Num Banh Chok',
                'description' => 'Fresh rice noodles with green fish curry gravy and raw vegetables.',
                'cost_price' => 2.00,
                'selling_price' => 4.50,
                'stock_qty' => 45,
                'barcode' => '100000000006',
                'image' => 'https://images.unsplash.com/photo-1617093727343-374698b06650?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 2,
                'product_code' => 'KHM007',
                'product_name' => 'Samlor Korkor',
                'description' => 'Traditional Cambodian soup with pork, vegetables, and fermented fish paste.',
                'cost_price' => 3.00,
                'selling_price' => 5.99,
                'stock_qty' => 35,
                'barcode' => '100000000007',
                'image' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 3,
                'product_code' => 'KHM008',
                'product_name' => 'Bai Sach Chrouk',
                'description' => 'Grilled pork over jasmine rice with pickled vegetables and clear soup.',
                'cost_price' => 2.50,
                'selling_price' => 4.99,
                'stock_qty' => 55,
                'barcode' => '100000000008',
                'image' => 'https://images.unsplash.com/photo-1603133872877-684f608b9217?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 3,
                'product_code' => 'KHM009',
                'product_name' => 'Num Pang',
                'description' => 'Cambodian baguette sandwich with pate, pickled radish, and grilled meat.',
                'cost_price' => 2.00,
                'selling_price' => 3.99,
                'stock_qty' => 60,
                'barcode' => '100000000009',
                'image' => 'https://images.unsplash.com/photo-1509722747041-616f39b57569?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 3,
                'product_code' => 'KHM010',
                'product_name' => 'Bok L\'hong',
                'description' => 'Green papaya salad with lime, chili, peanuts, and fermented crab.',
                'cost_price' => 2.00,
                'selling_price' => 4.50,
                'stock_qty' => 40,
                'barcode' => '100000000010',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 3,
                'product_code' => 'KHM011',
                'product_name' => 'Fried Spring Rolls',
                'description' => 'Crispy rolls filled with minced pork, vegetables, and glass noodles.',
                'cost_price' => 1.50,
                'selling_price' => 3.50,
                'stock_qty' => 70,
                'barcode' => '100000000011',
                'image' => 'https://images.unsplash.com/photo-1534422298390-e85f0289e3d8?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 4,
                'product_code' => 'KHM012',
                'product_name' => 'Num Ansom Chek',
                'description' => 'Sticky rice cake with banana wrapped in banana leaf, a Khmer classic.',
                'cost_price' => 1.50,
                'selling_price' => 3.50,
                'stock_qty' => 40,
                'barcode' => '100000000012',
                'image' => 'https://images.unsplash.com/photo-1587132137057-bfe895245725?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 4,
                'product_code' => 'KHM013',
                'product_name' => 'Num Krok',
                'description' => 'Mini coconut rice pancakes, crispy outside and soft inside.',
                'cost_price' => 1.00,
                'selling_price' => 2.99,
                'stock_qty' => 50,
                'barcode' => '100000000013',
                'image' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 4,
                'product_code' => 'KHM014',
                'product_name' => 'Sticky Rice Mango',
                'description' => 'Sweet sticky rice with ripe mango and coconut cream.',
                'cost_price' => 2.00,
                'selling_price' => 4.99,
                'stock_qty' => 35,
                'barcode' => '100000000014',
                'image' => 'https://images.unsplash.com/photo-1596797038530-2c107229654b?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 5,
                'product_code' => 'KHM015',
                'product_name' => 'Teuk Tnot',
                'description' => 'Fresh sugar palm juice, naturally sweet and refreshing.',
                'cost_price' => 1.00,
                'selling_price' => 2.50,
                'stock_qty' => 60,
                'barcode' => '100000000015',
                'image' => 'https://images.unsplash.com/photo-1622597467836-f3285f2131b8?w=500&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 5,
                'product_code' => 'KHM016',
                'product_name' => 'Iced Cambodian Coffee',
                'description' => 'Strong drip coffee with sweet condensed milk over ice.',
                'cost_price' => 1.20,
                'selling_price' => 2.99,
                'stock_qty' => 65,
                'barcode' => '100000000016',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=500&q=80',
                'status' => 'Active',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['product_code' => $product['product_code']], $product);
        }

        $restaurants = [
            [
                'id' => 1,
                'name' => 'Phnom Penh Kitchen',
                'imageUrl' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=500&q=80',
                'rating' => 4.7,
                'deliveryTime' => '15-25 min',
                'distance' => 1.2,
                'deliveryFee' => 1.99,
                'categories' => ['Khmer', 'Main Dishes'],
            ],
            [
                'id' => 2,
                'name' => 'Siem Reap Street Eats',
                'imageUrl' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500&q=80',
                'rating' => 4.5,
                'deliveryTime' => '20-30 min',
                'distance' => 2.5,
                'deliveryFee' => 1.49,
                'categories' => ['Street Food', 'Noodles'],
            ],
            [
                'id' => 3,
                'name' => 'Khmer Sweet House',
                'imageUrl' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=500&q=80',
                'rating' => 4.8,
                'deliveryTime' => '15-20 min',
                'distance' => 1.8,
                'deliveryFee' => 0.99,
                'categories' => ['Desserts', 'Drinks'],
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::updateOrCreate(['id' => $restaurant['id']], $restaurant);
        }

        $foods = [
            [
                'id' => 1,
                'restaurantId' => 1,
                'name' => 'Fish Amok',
                'description' => 'Cambodia\'s national dish — silky fish curry steamed in banana leaf with coconut cream.',
                'imageUrl' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b9a2?w=500&q=80',
                'price' => 8.99,
                'oldPrice' => 10.99,
                'rating' => 4.8,
                'ingredients' => ['Fish', 'Coconut Milk', 'Kroeung', 'Banana Leaf'],
                'extraToppings' => ['Extra Chili', 'Fresh Herbs'],
            ],
            [
                'id' => 2,
                'restaurantId' => 2,
                'name' => 'Kuy Teav',
                'description' => 'Aromatic pork noodle soup topped with fresh herbs and bean sprouts.',
                'imageUrl' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=500&q=80',
                'price' => 4.99,
                'oldPrice' => null,
                'rating' => 4.6,
                'ingredients' => ['Rice Noodles', 'Pork Broth', 'Herbs', 'Bean Sprouts'],
                'extraToppings' => ['Extra Meat', 'Fried Garlic'],
            ],
            [
                'id' => 3,
                'restaurantId' => 3,
                'name' => 'Sticky Rice Mango',
                'description' => 'Sweet glutinous rice with ripe mango slices and rich coconut cream.',
                'imageUrl' => 'https://images.unsplash.com/photo-1596797038530-2c107229654b?w=500&q=80',
                'price' => 4.99,
                'oldPrice' => 5.99,
                'rating' => 4.9,
                'ingredients' => ['Sticky Rice', 'Mango', 'Coconut Cream'],
                'extraToppings' => ['Extra Mango', 'Sesame Seeds'],
            ],
        ];

        foreach ($foods as $food) {
            Food::updateOrCreate(['id' => $food['id']], $food);
        }
    }
}
