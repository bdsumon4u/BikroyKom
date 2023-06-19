<?php

namespace App\Http\Controllers;

use App\HomeSection;
use App\Product;
use App\Setting;
use Illuminate\Http\Request;

class HomeSectionProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, HomeSection $section)
    {
        $rows = 3;
        $cols = 5;
        if ($productsPage = Setting::whereName('products_page')->first()) {
            $rows = $productsPage->value->rows;
            $cols = $productsPage->value->cols;
        }
        $per_page = $request->get('per_page', $rows * $cols);
        $products = $section->products(false, $per_page)->appends(request()->query());
        return view('products.index', compact('section', 'products', 'per_page', 'rows', 'cols'));
    }
}
