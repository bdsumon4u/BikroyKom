<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->ready()
            ->addColumn('action', function (Image $image) {
                return '<a href="'.route('admin.images.destroy', $image).'" data-action="delete" class="btn btn-danger">Delete</a>';
            })
            ->rawColumns(['preview', 'action'])
            ->make(true);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        return $this->ready()
            ->addColumn('action', function (Image $image) {
                return '<div class="checkbox checkbox-dark">
                    <input id="single-select-'.$image->id.'" class="select-image" data-id="'.$image->id.'" type="checkbox" data-src="'.asset($image->path).'">
                    <label for="single-select-'.$image->id.'"></label>
                </div>';
            })
            ->rawColumns(['preview', 'action'])
            ->make(true);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multiple(Request $request)
    {
        return $this->ready()
            ->addColumn('action', function (Image $image) {
                return '<div class="checkbox checkbox-dark">
                    <input id="multi-select-'.$image->id.'" class="select-image" data-id="'.$image->id.'" type="checkbox" data-src="'.asset($image->path).'">
                    <label for="multi-select-'.$image->id.'"></label>
                </div>';
            })
            ->rawColumns(['preview', 'action'])
            ->make(true);
    }

    protected function ready()
    {
        return DataTables::of(request()->has('order') ? Image::all() : Image::latest('id'))
            ->addIndexColumn()
            ->addColumn('preview', function (Image $image) {
                return '<img src="'.asset($image->path).'" width="100" height="120" />';
            });
    }
}
