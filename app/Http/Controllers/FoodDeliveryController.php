<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
