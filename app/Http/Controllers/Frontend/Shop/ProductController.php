<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private int $pagination = 9;

    public function index()
    {
        $categoryName = 'Destaque';
        $categories = Category::all();


        if (request()->category === null) {
            $products = Product::where('featured', true);
        }

        if (request()->category) {
            $products = Product::with('categories')
                ->whereHas(
                    'categories',
                    function ($query) {
                        $query->where('slug', request()->category);
                    }
                );

            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        }

        if (request()->sort) {
            $products = $products->orderBy('price', request()->sort)->paginate($this->pagination);
        } else {
            $products = $products->paginate($this->pagination);
        }

        return view(
            'frontend.the_project.shop.pages.products.index',
            compact('products', 'categories', 'categoryName')
        );
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

        $stockLevel = getStockLevel($product->quantity, $product->min_quantity);

        return view('frontend.the_project.shop.pages.products.show')
            ->with(
                compact('product', 'stockLevel', 'mightAlsoLike')
            );
    }

    public function search(Request $request)
    {
        $request->validate(
            [
                'filter' => 'required|min:3',
            ]
        );

        $filter = $request->input('filter');

        $products = app(Product::class)->search($filter)->paginate($this->pagination);
        $categories = Category::all();
        $categoryName = sprintf("%d resultado(s) para '%s'", $products->total(), $filter);

        return view(
            'frontend.the_project.shop.pages.products.index',
            compact('products', 'categories', 'categoryName')
        );
    }
}
