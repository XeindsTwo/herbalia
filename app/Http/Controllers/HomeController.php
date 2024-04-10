<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
  public function index(): JsonResponse
  {
    $categories = Category::all();
    return response()->json($categories);
  }
}