<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::orderBy('order_index')->get();
        return view('admin.manage_categories', compact('categories'));
    }

    public function getAllCategories(): array
    {
        return Category::all()->pluck('name', 'id')->toArray();
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:250',
            'subtitle' => 'nullable|max:250',
        ]);

        $maxOrderIndex = Category::max('order_index');
        $category = Category::create([
            'name' => $validatedData['name'],
            'subtitle' => $validatedData['subtitle'],
            'order_index' => $maxOrderIndex !== null ? $maxOrderIndex + 1 : 1,
        ]);

        return response()->json([
            'category' => $category,
            'message' => 'Категория успешно создана'
        ], 201);
    }

    public function checkUniqueName(Request $request): JsonResponse
    {
        $name = $request->input('name');
        $category = Category::where('name', $name)->first();
        if ($category && $category->id != $request->input('id')) {
            return response()->json([
                'unique' => false,
            ]);
        }
        return response()->json([
            'unique' => true
        ]);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:categories,name,' . $category->getKey() . ',id',
            'subtitle' => 'nullable|max:250'
        ]);

        $category->update($validatedData);
        return response()->json([
            'category' => $category,
            'message' => 'Категория успешно обновлена'
        ], 200);
    }

    public function updateCategoryOrder(Request $request): JsonResponse
    {
        try {
            $categoriesOrder = $request->input('categoriesItems');
            foreach ($categoriesOrder as $index => $categoryId) {
                Category::where('id', $categoryId)->update(['order_index' => $index + 1]);
            }
            return response()->json(['message' => 'Порядок категорий успешно обновлен'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(['message' => 'Категория успешно удалена'], 201);
    }
}