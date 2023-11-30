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

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:categories,name,' . $category->getKey(),
            'subtitle' => 'nullable|max:250'
        ]);

        $category->update($validatedData);
        return redirect()->route('admin.categories.index')
            ->with('success', 'Категория успешно обновлена');
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(['message' => 'Категория успешно удалена'], 201);
    }
}