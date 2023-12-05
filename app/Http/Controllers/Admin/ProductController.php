<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::orderBy('order_index')->get();
        $products = Product::all();
        return view('admin.manage_products', compact('categories', 'products'));
    }

    public function create(CategoryController $categoryController): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $categoryController->getAllCategories();
        Session::put('previous_url', url()->previous());
        return view('admin.add_product', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'photos.*' => 'required|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article = mt_rand(101000, 189999);

        $product = new Product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'article' => $article,
            'category_id' => $request->input('category_id'),
        ]);
        $product->save();

        foreach ($request->file('photos') as $photo) {
            if ($photo->isValid()) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('public/photos', $imageName);
                $product->images()->create([
                    'name' => $imageName,
                    'path' => 'photos/' . $imageName,
                ]);
            } else {
                return back()->with('error', 'Некорректный файл изображения');
            }
        }

        return redirect(Session::get('previous_url'));
    }

    public function showByCategory($category_id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        Session::put('previous_url', url()->current());
        $products = Product::where('category_id', $category_id)->get();
        $categories = Category::orderBy('order_index')->get();
        $currentCategory = Category::find($category_id);
        return view('admin.category_page', compact('products', 'categories', 'currentCategory'));
    }

    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::findOrFail($id);
        $currentCategory = $product->category;
        return view('product_detail', compact('product', 'currentCategory'));
    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        if ($product) {
            foreach ($product->images as $image) {
                Storage::delete('public/photos/' . $image->name);
            }
            $product->delete();
            return response()->json(['message' => 'Продукт был успешно удален']);
        } else {
            return response()->json(['message' => 'Продукт не был найден'], 404);
        }
    }

    public function search(Request $request, $category_id): JsonResponse
    {
        $query = $request->input('query');

        $productsQuery = Product::where('category_id', $category_id)
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'LIKE', "%$query%")
                    ->orWhere('description', 'LIKE', "%$query%");
            });

        $products = $query ? $productsQuery->get() : collect([]);

        $categories = Category::orderBy('order_index')->get();
        $currentCategory = Category::find($category_id);

        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $currentCategory,
        ]);
    }
}