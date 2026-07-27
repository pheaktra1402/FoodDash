<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        
        // ពិនិត្យរកមើល Column តម្លៃប្រាក់ក្នុងតារាង orders ដោយស្វ័យប្រវត្តិ
        $priceColumn = 'total_price';
        if (Schema::hasColumn('orders', 'total_amount')) {
            $priceColumn = 'total_amount';
        } elseif (Schema::hasColumn('orders', 'price')) {
            $priceColumn = 'price';
        } elseif (Schema::hasColumn('orders', 'amount')) {
            $priceColumn = 'amount';
        }

        $totalRevenue = Order::sum($priceColumn);
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'totalRevenue',
            'recentOrders'
        ));
    }

    public function dashboard()
    {
        return $this->index();
    }
}