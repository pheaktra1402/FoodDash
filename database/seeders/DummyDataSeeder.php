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
            ['id' => 1, 'category_code' => 'CAT001', 'category_name' => 'Burgers & Sandwiches', 'description' => 'Delicious burgers and gourmet sandwiches'],
            ['id' => 2, 'category_code' => 'CAT002', 'category_name' => 'Pizza & Pasta', 'description' => 'Freshly baked pizzas and traditional pasta'],
            ['id' => 3, 'category_code' => 'CAT003', 'category_name' => 'Asian & Noodles', 'description' => 'Authentic noodle bowls, ramen & sushi'],
            ['id' => 4, 'category_code' => 'CAT004', 'category_name' => 'Grill & Fast Food', 'description' => 'Grilled meats, fried chicken and tacos'],
            ['id' => 5, 'category_code' => 'CAT005', 'category_name' => 'Desserts & Drinks', 'description' => 'Sweet treats, coffee & fruit beverages'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['id' => $category['id']], $category);
        }

        // Remove old invalid/legacy demo products
        Product::where('product_code', 'NOT LIKE', 'PRD%')->delete();

        $products = [
            [
                'category_id' => 1,
                'product_code' => 'PRD001',
                'product_name' => 'មាន់ដុតទឹកឃ្មុំ',
                'description' => 'Yummy food',
                'cost_price' => 3.50,
                'selling_price' => 6.99,
                'stock_qty' => 50,
                'barcode' => '100000000001',
                'image' => 'https://sokkhak-river.com/wp-content/uploads/2024/11/7.jpg',
                'status' => 'Active',
            ],
            [
                'category_id' => 2,
                'product_code' => 'PRD002',
                'product_name' => 'Pepperoni Feast Pizza',
                'description' => 'Classic pizza topped with spicy pepperoni, mozzarella cheese and tomato sauce.',
                'cost_price' => 6.00,
                'selling_price' => 12.99,
                'stock_qty' => 40,
                'barcode' => '100000000002',
                'image' => 'https://images.unsplash.com/photo-1628840042765-356cda07504e?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 3,
                'product_code' => 'PRD003',
                'product_name' => 'Khmer Dessert',
                'description' => 'Sweet and yummy.',
                'cost_price' => 7.00,
                'selling_price' => 14.99,
                'stock_qty' => 30,
                'barcode' => '100000000003',
                'image' => 'https://images.deliveryhero.io/image/fd-kh/LH/krwl-listing.jpg',
                'status' => 'Active',
            ],
            [
                'category_id' => 4,
                'product_code' => 'PRD004',
                'product_name' => 'Golden Crispy Fried Chicken',
                'description' => 'Crispy golden fried chicken seasoned with secret herbs and spices.',
                'cost_price' => 4.00,
                'selling_price' => 8.99,
                'stock_qty' => 60,
                'barcode' => '100000000004',
                'image' => 'https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 2,
                'product_code' => 'PRD005',
                'product_name' => 'Creamy Spaghetti Carbonara',
                'description' => 'Rich and creamy pasta with pancetta, egg yolk, and freshly grated parmesan.',
                'cost_price' => 5.00,
                'selling_price' => 10.99,
                'stock_qty' => 45,
                'barcode' => '100000000005',
                'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 4,
                'product_code' => 'PRD006',
                'product_name' => 'Mexican Beef Tacos',
                'description' => 'Three soft corn tortillas filled with seasoned beef, fresh salsa and lime.',
                'cost_price' => 3.50,
                'selling_price' => 7.99,
                'stock_qty' => 50,
                'barcode' => '100000000006',
                'image' => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 3,
                'product_code' => 'PRD007',
                'product_name' => 'Romdoul Dessert',
                'description' => 'Cambodian dessert.',
                'cost_price' => 4.50,
                'selling_price' => 9.99,
                'stock_qty' => 40,
                'barcode' => '100000000007',
                'image' => 'https://images.deliveryhero.io/image/fd-kh/LH/bwy5-hero.jpg',
                'status' => 'Active',
            ],
            [
                'category_id' => 4,
                'product_code' => 'PRD008',
                'product_name' => 'នំត្នោត',
                'description' => 'Cambodian food.',
                'cost_price' => 9.00,
                'selling_price' => 18.99,
                'stock_qty' => 25,
                'barcode' => '100000000008',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNhRKqgrL7emXubMaGJJRDJrrbRoWVjstv6AhaZ5WLMIdrBLnK4ato0fjd&s=10',
                'status' => 'Active',
            ],
            [
                'category_id' => 1,
                'product_code' => 'PRD009',
                'product_name' => 'Avocado & Egg Toast',
                'description' => 'Artisanal sourdough topped with smashed avocado, poached egg, and chili flakes.',
                'cost_price' => 2.80,
                'selling_price' => 6.50,
                'stock_qty' => 35,
                'barcode' => '100000000009',
                'image' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 4,
                'product_code' => 'PRD010',
                'product_name' => 'Fresh Caesar Salad',
                'description' => 'Crisp romaine, garlic croutons, shaved parmesan, and creamy dressing.',
                'cost_price' => 3.00,
                'selling_price' => 7.50,
                'stock_qty' => 30,
                'barcode' => '100000000010',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 5,
                'product_code' => 'PRD011',
                'product_name' => 'Chocolate Fudge Cake',
                'description' => 'Decadent multi-layered chocolate cake with dark chocolate frosting.',
                'cost_price' => 2.50,
                'selling_price' => 5.99,
                'stock_qty' => 45,
                'barcode' => '100000000011',
                'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 5,
                'product_code' => 'PRD012',
                'product_name' => 'Fluffy Berry Pancakes',
                'description' => 'Stack of fluffy pancakes served with mixed fresh berries and maple syrup.',
                'cost_price' => 3.00,
                'selling_price' => 6.99,
                'stock_qty' => 40,
                'barcode' => '100000000012',
                'image' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 5,
                'product_code' => 'PRD013',
                'product_name' => 'Iced Caramel Macchiato',
                'description' => 'Rich espresso layered with cold milk and sweet caramel drizzle.',
                'cost_price' => 1.50,
                'selling_price' => 3.99,
                'stock_qty' => 70,
                'barcode' => '100000000013',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=600&q=80',
                'status' => 'Active',
            ],
            [
                'category_id' => 5,
                'product_code' => 'PRD014',
                'product_name' => 'Ah Molk',
                'description' => 'Cambodian food.',
                'cost_price' => 2.20,
                'selling_price' => 5.50,
                'stock_qty' => 50,
                'barcode' => '100000000014',
                'image' => 'https://api.asiavivatravel.com/wp-content/uploads/2024/11/Amok-Fish-Curry-768x512.jpg',
                'status' => 'Active',
            ],
            [
                'category_id' => 5,
                'product_code' => 'PRD015',
                'product_name' => 'នំបញ្ចុក',
                'description' => ' នំបញ្ចុកសម្លប្រហើរ។',
                'cost_price' => 2.50,
                'selling_price' => 2.50,
                'stock_qty' => 55,
                'barcode' => '100000000015',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSicayi8Q_magkl0Nz4vRSILedtW2JsIR5tIoohfbZDBm5oN7sG2nglqGOB&s=10',
                'status' => 'Active',
            ],
            [
                'category_id' => 1,
                'product_code' => 'PRD016',
                'product_name' => 'ទឹកគ្រឿង',
                'description' => 'Cambodian food.',
                'cost_price' => 3.20,
                'selling_price' => 2.99,
                'stock_qty' => 60,
                'barcode' => '100000000016',
                'image' => 'https://asiatoursdesk.com/wp-content/uploads/2025/01/traditional-khmer-food-1.jpg',
                'status' => 'Active',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['product_code' => $product['product_code']], $product);
        }

        $restaurants = [
            [
                'id' => 1,
                'name' => 'Burger & Grill Hub',
                'imageUrl' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500&q=80',
                'rating' => 4.8,
                'deliveryTime' => '15-25 min',
                'distance' => 1.2,
                'deliveryFee' => 1.99,
                'categories' => ['Burgers', 'Fast Food'],
            ],
            [
                'id' => 2,
                'name' => 'Pizza & Pasta Express',
                'imageUrl' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=500&q=80',
                'rating' => 4.7,
                'deliveryTime' => '20-30 min',
                'distance' => 2.5,
                'deliveryFee' => 1.49,
                'categories' => ['Pizza', 'Italian'],
            ],
            [
                'id' => 3,
                'name' => 'Asian Noodle Bar',
                'imageUrl' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=500&q=80',
                'rating' => 4.9,
                'deliveryTime' => '15-20 min',
                'distance' => 1.8,
                'deliveryFee' => 0.99,
                'categories' => ['Noodles', 'Asian'],
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::updateOrCreate(['id' => $restaurant['id']], $restaurant);
        }

        $foods = [
            [
                'id' => 1,
                'restaurantId' => 1,
                'name' => 'Cheeseburger Supreme',
                'description' => 'Juicy beef patty with melted cheese, fresh lettuce, tomatoes and special sauce.',
                'imageUrl' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=600&q=80',
                'price' => 6.99,
                'oldPrice' => 8.99,
                'rating' => 4.8,
                'ingredients' => ['Beef Patty', 'Cheddar Cheese', 'Lettuce', 'Tomato'],
                'extraToppings' => ['Extra Cheese', 'Bacon'],
            ],
            [
                'id' => 2,
                'restaurantId' => 2,
                'name' => 'Pepperoni Feast Pizza',
                'description' => 'Classic pizza topped with spicy pepperoni, mozzarella cheese and tomato sauce.',
                'imageUrl' => 'https://images.unsplash.com/photo-1628840042765-356cda07504e?w=600&q=80',
                'price' => 12.99,
                'oldPrice' => 15.99,
                'rating' => 4.7,
                'ingredients' => ['Pizza Dough', 'Tomato Sauce', 'Mozzarella', 'Pepperoni'],
                'extraToppings' => ['Extra Pepperoni', 'Stuffed Crust'],
            ],
            [
                'id' => 3,
                'restaurantId' => 3,
                'name' => 'Tonkotsu Pork Ramen',
                'description' => 'Rich pork broth ramen served with tender pork belly, egg, and green onions.',
                'imageUrl' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=600&q=80',
                'price' => 9.99,
                'oldPrice' => 11.99,
                'rating' => 4.9,
                'ingredients' => ['Ramen Noodles', 'Pork Broth', 'Chashu Pork', 'Soft-boiled Egg'],
                'extraToppings' => ['Extra Pork', 'Bamboo Shoots'],
            ],
        ];

        foreach ($foods as $food) {
            Food::updateOrCreate(['id' => $food['id']], $food);
        }
    }
}
