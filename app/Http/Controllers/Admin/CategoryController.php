<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::all();
        return view('admin.manage_categories', compact('categories'));
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:250',
            'subtitle' => 'nullable|max:250',
        ]);

        $category = Category::create($validatedData);

        return response()->json([
            'category' => $category,
            'message' => 'Категория успешно создана'
        ], 201);
    }

    public function checkUniqueName(Request $request): JsonResponse
    {
        $name = $request->input('name');
        $category = Category::where('name', $name)->first();
        return response()->json([
            'unique' => !$category,
        ]);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:categories,name,' . $category->getKey(),
            'subtitle' => 'nullable|max:250'
        ]);

        $category->update($validatedData);
        return response()->json([
            'category' => $category,
            'message' => 'Категория успешно обновлена'
        ], 200);
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(['message' => 'Категория успешно удалена'], 201);
    }
}