<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::orderBy('order_index')->get();
        $categoryProducts = [];
        $approvedReviews = Review::where('display_on_homepage', true)->get();

        foreach ($categories as $category) {
            $categoryProducts[$category->id] = Product::where('category_id', $category->id)->limit(6)->get();
        }

        return view('index', compact('categories', 'categoryProducts', 'approvedReviews'));
    }
}