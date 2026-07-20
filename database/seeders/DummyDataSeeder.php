<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Food;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Burger', 'iconUrl' => 'https://cdn-icons-png.flaticon.com/512/3075/3075977.png'],
            ['id' => 2, 'name' => 'Pizza', 'iconUrl' => 'https://cdn-icons-png.flaticon.com/512/3595/3595458.png'],
            ['id' => 3, 'name' => 'Sushi', 'iconUrl' => 'https://cdn-icons-png.flaticon.com/512/2254/2254515.png'],
            ['id' => 4, 'name' => 'Dessert', 'iconUrl' => 'https://cdn-icons-png.flaticon.com/512/3081/3081885.png'],
            ['id' => 5, 'name' => 'Drinks', 'iconUrl' => 'https://cdn-icons-png.flaticon.com/512/3081/3081162.png'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $restaurants = [
            [
                'id' => 1,
                'name' => 'Burger King',
                'imageUrl' => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=500&q=80',
                'rating' => 4.5,
                'deliveryTime' => '15-25 min',
                'distance' => 1.2,
                'deliveryFee' => 1.99,
                'categories' => ['Burger', 'Fast Food'],
            ],
            [
                'id' => 2,
                'name' => 'Pizza Hut',
                'imageUrl' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=500&q=80',
                'rating' => 4.2,
                'deliveryTime' => '30-40 min',
                'distance' => 3.5,
                'deliveryFee' => 2.99,
                'categories' => ['Pizza', 'Italian'],
            ],
            [
                'id' => 3,
                'name' => 'Sushi master',
                'imageUrl' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=500&q=80',
                'rating' => 4.8,
                'deliveryTime' => '20-30 min',
                'distance' => 2.0,
                'deliveryFee' => 0.0,
                'categories' => ['Sushi', 'Japanese'],
            ],
        ];

        foreach ($restaurants as $rest) {
            Restaurant::create($rest);
        }

        $foods = [
            [
                'id' => 1,
                'restaurantId' => 1,
                'name' => 'Whopper',
                'description' => 'Our Whopper Sandwich is a ¼ lb of savory flame-grilled beef topped with juicy tomatoes, fresh lettuce, creamy mayonnaise, ketchup, crunchy pickles, and sliced white onions on a soft sesame seed bun.',
                'imageUrl' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&q=80',
                'price' => 5.99,
                'oldPrice' => 7.99,
                'rating' => 4.6,
                'ingredients' => ['Beef', 'Tomato', 'Lettuce', 'Onion', 'Pickles'],
                'extraToppings' => ['Cheese', 'Bacon', 'Extra Patty'],
            ],
            [
                'id' => 2,
                'restaurantId' => 2,
                'name' => 'Pepperoni Pizza',
                'description' => 'Classic pepperoni pizza with extra cheese.',
                'imageUrl' => 'https://images.unsplash.com/photo-1628840042765-356cda07504e?w=500&q=80',
                'price' => 12.99,
                'oldPrice' => null,
                'rating' => 4.4,
                'ingredients' => ['Dough', 'Tomato Sauce', 'Cheese', 'Pepperoni'],
                'extraToppings' => ['Extra Cheese', 'Mushrooms', 'Olives'],
            ],
            [
                'id' => 3,
                'restaurantId' => 3,
                'name' => 'Salmon Roll',
                'description' => 'Fresh salmon with avocado and cucumber.',
                'imageUrl' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=500&q=80',
                'price' => 8.99,
                'oldPrice' => 10.99,
                'rating' => 4.9,
                'ingredients' => ['Rice', 'Salmon', 'Seaweed', 'Avocado'],
                'extraToppings' => ['Spicy Mayo', 'Eel Sauce'],
            ],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }
    }
}
