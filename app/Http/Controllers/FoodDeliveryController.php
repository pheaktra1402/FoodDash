<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Food;

class FoodDeliveryController extends Controller
{
    public function getCategories()
    {
        return response()->json(Category::all());
    }

    public function getRestaurants()
    {
        return response()->json(Restaurant::all());
    }

    public function getFoods()
    {
        return response()->json(Food::all());
    }
}
