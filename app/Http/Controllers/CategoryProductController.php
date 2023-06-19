<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Category $category)
    {
        $per_page = $request->get('per_page', 15);
        $products = $category->products()
            ->whereIsActive(1)
            ->latest('id')
            ->paginate($per_page)->appends(request()->query());
        return view('products.index', [
            'products' => $products,
            'per_page' => $per_page,
        ]);
    }
}
