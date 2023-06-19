<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\CategoryMenu;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $remaining_cats = Category::whereDoesntHave('categoryMenu')->get();
        $selected_cats = CategoryMenu::nested();
        return view('admin.categories.menu', compact('remaining_cats', 'selected_cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($request->has('category')) {
            $data = $request->validate([
                'category' => 'required|array',
            ]);

            collect($data['category'])
                ->each(function ($val, $key) {
                    CategoryMenu::updateOrInsert(['category_id' => $key], []);
                })->toArray();
        }

        if ($request->has('categories')) {
            $data = $request->validate([
                'categories' => 'required|array',
            ]);

            collect($data['categories'])
                ->each(function ($val, $key) {
                    CategoryMenu::updateOrInsert(['id' => $val['id']], $val);
                })->toArray();

            return true;
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return Response
     */
    public function show(CategoryMenu $categoryMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return Response
     */
    public function edit(CategoryMenu $categoryMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\CategoryMenu  $categoryMenu
     * @return Response
     */
    public function update(Request $request, CategoryMenu $categoryMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryMenu  $categoryMenu
     * @return Response
     */
    public function destroy(CategoryMenu $categoryMenu)
    {
        abort_if(request()->user()->role_id, 'Not Allowed.');
        return DB::transaction(function () use ($categoryMenu) {
            $categoryMenu->childrens()->delete();
            $categoryMenu->delete();
        });
    }
}
