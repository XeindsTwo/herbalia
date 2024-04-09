<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index(): JsonResponse
  {
    $categories = Category::orderBy('id')->get();
    return response()->json($categories);
  }

  public function store(Request $request): JsonResponse
  {
    try {
      $validatedData = $request->validate([
        'name' => 'required|max:100',
        'subtitle' => 'nullable|max:250',
      ]);

      $existingCategory = Category::where('name', $validatedData['name'])->first();
      if ($existingCategory) {
        return response()->json(['error' => ['Категория с таким именем уже существует']], 400);
      }

      $category = Category::create([
        'name' => $validatedData['name'],
        'subtitle' => $validatedData['subtitle'],
      ]);

      return response()->json([
        'category' => $category,
        'message' => 'Категория успешно создана'
      ]);
    } catch (Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  public function update(Request $request, Category $category): JsonResponse
  {
    try {
      $validatedData = $request->validate([
        'name' => 'required|max:250|unique:categories,name,' . $category->getKey() . ',id',
        'subtitle' => 'nullable|max:250'
      ]);

      $category->update($validatedData);
      return response()->json([
        'category' => $category,
        'message' => 'Категория успешно обновлена'
      ]);
    } catch (Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  public function destroy(Category $category): JsonResponse
  {
    try {
      $category->delete();
      return response()->json(['message' => 'Категория успешно удалена']);
    } catch (Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }
}