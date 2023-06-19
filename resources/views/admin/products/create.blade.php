@extends('layouts.light.master')
@section('title', 'Create Product')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
@endpush

@section('breadcrumb-title')
<h3>Create Product</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.products.index') }}">Products</a>
</li>
<li class="breadcrumb-item">Create Product</li>
@endsection


@push('styles')
<style>
    .nav-tabs {
        border: 2px solid #ddd;
    }
    .nav-tabs li:hover a,
    .nav-tabs li a.active {
        border-radius: 0;
        border-bottom-color: #ddd !important;
    }
    .nav-tabs li a.active {
        background-color: #f0f0f0 !important;
    }
    .nav-tabs li a:hover {
        border-bottom: 1px solid #ddd;
        background-color: #f7f7f7;
    }

    .is-invalid + .SumoSelect + .invalid-feedback {
        display: block;
    }
</style>
<style>
    .dropzone {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .previewer {
        display: inline-block;
        position: relative;
        margin-left: 3px;
        margin-right: 7px;
    }
    .previewer i {
        position: absolute;
        top: 0;
        color: red;
        right: 0;
        background: #ddd;
        padding: 2px;
        border-radius: 3px;
        cursor: pointer;
    }
    .dataTables_scrollHeadInner {
        width: 100% !important;
    }
    th,
    td {
        vertical-align: middle !important;
    }
    table.dataTable tbody td.select-checkbox:before,
    table.dataTable tbody td.select-checkbox:after,
    table.dataTable tbody th.select-checkbox:before,
    table.dataTable tbody th.select-checkbox:after {
        top: 50%;
    }
    .select2 {
        width: 100% !important;
    }
    .select2-selection.select2-selection--multiple {
        display: flex;
        align-items: center;
    }
    .select2-container .select2-selection--single {
        border-color: #ced4da !important;
    }
</style>
@endpush

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">Add New <strong>Product</strong></div>
            <div class="card-body p-3">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <ul class="nav nav-tabs list-group" role="tablist">
                            <li class="nav-item rounded-0"><a class="nav-link @if($errors->has('name') || $errors->has('slug') || $errors->has('description') || $errors->has('categories') || $errors->has('brand')) text-danger @endif active" data-toggle="tab" href="#item-1">General</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link @if($errors->has('price') || $errors->has('selling_price')) text-danger @endif" data-toggle="tab" href="#item-2">Price</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link @if($errors->has('sku') || $errors->has('track_stock') || $errors->has('stock_count')) text-danger @endif" data-toggle="tab" href="#item-3">Inventory</a></li>
                            <li class="nav-item rounded-0"><a class="nav-link @if($errors->has('base_image') || $errors->has('additional_images') || $errors->has('additional_images.*')) text-danger @enderror" data-toggle="tab" href="#item-4">Images</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-8 col-xl-9">
                        <div class="row">
                            <div class="col">
                                <x-form action="{{ route('admin.products.store') }}" method="post">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="item-1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">General</small></h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <x-label for="name" /><span class="text-danger">*</span>
                                                <x-input name="name" data-target="#slug" />
                                                <x-error field="name" />
                                            </div>
                                            <div class="form-group">
                                                <x-label for="slug" /><span class="text-danger">*</span>
                                                <x-input name="slug" />
                                                <x-error field="slug" />
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <x-label for="description" /><span class="text-danger">*</span>
                                                        <x-textarea editor name="description" cols="30" rows="10" />
                                                        <x-error field="description" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <x-label for="categories" /><span class="text-danger">*</span>
                                                        <x-category-dropdown :categories="$categories" name="categories[]" placeholder="Select Category" id="categories" multiple="true" :selected="old('categories', [])" />
                                                        <x-error field="categories" class="d-block" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <x-label for="brand" />
                                                        <x-category-dropdown :categories="$brands" name="brand" placeholder="Select Brand" id="brand" :selected="old('brand', 0)" />
                                                        <x-error field="brand" class="d-block" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="item-2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Price</small></h4>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <x-label for="price" /><span class="text-danger">*</span>
                                                        <x-input name="price" />
                                                        <x-error field="price" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <x-label for="selling_price" /><span class="text-danger">*</span>
                                                        <x-input name="selling_price" />
                                                        <x-error field="selling_price" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="item-3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Inventory</small></h4>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <x-checkbox name="should_track" value="1" class="custom-control-input" />
                                                            <x-label for="should_track" class="custom-control-label" />
                                                            <x-error field="should_track" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="sku">Product Code</label><span class="text-danger">*</span>
                                                        <x-input name="sku" />
                                                        <x-error field="sku" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group stock-count" @if(!old('should_track', 0)) style="display: none;" @endif>
                                                        <x-label for="stock_count" /><span class="text-danger">*</span>
                                                        <x-input name="stock_count" />
                                                        <x-error field="stock_count" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="item-4" role="tabpanel">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4><small class="border-bottom mb-1">Product Images</small></h4>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <!-- Button to Open the Modal -->
                                                                <label for="base_image" class="d-block"><strong>Base Image</strong></label>
                                                                <button type="button" class="btn single @if(old('base_image_src')) d-none @endif btn-light" data-toggle="modal" data-target="#single-picker" style="height: 150px; width: 150px; background: transparent;">
                                                                    <i class="fa fa-image fa-4x text-secondary"></i>
                                                                </button>
                                                                <img src="{{ old('base_image_src') }}" alt="Base Image" data-toggle="modal" data-target="#single-picker" id="base_image-preview" class="img-thumbnail img-responsive" style="display: {{ old('base_image_src') ? '' : 'none' }}; height: 150px; width: 150px; cursor: pointer;">
                                                                <input type="hidden" name="base_image_src" value="{{ old('base_image_src') }}">
                                                                <input type="hidden" name="base_image" value="{{ old('base_image') }}" class="@error('base_image') is-invalid @enderror" id="base-image" class="form-control">
                                                                @error('base_image')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="additional_images" class="d-block"><strong>Additional Images</strong></label>
                                                                <button type="button" class="btn multiple btn-light" data-toggle="modal" data-target="#multi-picker" style="height: 150px; width: 150px; background: transparent; float: left; margin: 5px;">
                                                                    <i class="fa fa-image fa-4x text-secondary"></i>
                                                                </button>
                                                                <div class="additional_images-previews">
                                                                    @foreach(old('additional_images_srcs', []) as $additional_image)
                                                                        <img src="{{ $additional_image }}" alt="Additional Image" id="additional_image-preview" class="img-thumbnail img-responsive" style="height: 150px; width: 150px; margin: 5px;">
                                                                    <input type="hidden" name="additional_images_srcs[]" value="{{ $additional_image }}" style="margin: 5px;">
                                                                    @endforeach
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <div class="additional-images @error('additional_images') is-invalid @enderror" id="additional-images">
                                                                    @foreach(old('additional_images', []) as $additional_image)
                                                                    <input type="hidden" name="additional_images[]" value="{{ $additional_image }}" style="margin: 5px;">
                                                                    @endforeach
                                                                </div>
                                                                @error('additional_images')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex" style="gap: 1rem;">
                                        <div class="checkbox checkbox-secondary">
                                            <x-checkbox name="is_active" value="1" />
                                            <x-label for="is_active" />
                                            <x-error field="is_active" />
                                        </div>
                                        <button type="submit" class="btn btn-success">Save Product</button>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.images.single-picker', ['selected' => old('base_image', 0)])
@include('admin.images.multi-picker', ['selected' => old('additional_images', [])])
@endsection

@push('js')
<script src="{{ asset('js/tinymce.js') }}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('[name="name"]').keyup(function () {
            $($(this).data('target')).val(slugify($(this).val()));
        });

        $('#should_track').change(function() {
            if($(this).is(':checked')) {
                $('.stock-count').show();
            } else {
                $('.stock-count').hide();
            }
        });

        $('[selector]').select2({
            // tags: true,
        });
    });
</script>
@endpush
