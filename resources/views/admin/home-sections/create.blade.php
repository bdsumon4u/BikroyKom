@extends('layouts.light.master')
@section('title', 'Create Home Section')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">
@endpush

@push('styles')
<style>
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

@section('breadcrumb-title')
<h3>Create Home Section</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Create Home Section</li>
@endsection

@section('content')
<div class="row mb-5 justify-content-center">
    <div class="col-md-8">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">Add New <strong>Section</strong></div>
            <div class="card-body p-3">
                <x-form :action="route('admin.home-sections.store')" method="POST">
                    <div class="form-group">
                        <x-label for="title" />
                        <x-input name="title" />
                        <x-error field="title" />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="type" />
                                <select selector name="type" id="type" class="form-control">
                                    <option value="pure-grid">Pure Grid</option>
                                    <!-- <option value="carousel-grid">Carousel Grid</option> -->
                                </select>
                                <x-error field="type" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="order" />
                                <x-input type="number" name="order" />
                                <x-error field="order" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="categories" /><span class="text-danger">*</span>
                                <x-category-dropdown :categories="$categories" name="categories[]" placeholder="Select Category" id="categories" multiple="true" :selected="old('categories')" />
                                <x-error field="categories" class="d-block" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <x-label for="rows" />
                                <x-input type="number" name="data[rows]" />
                                <x-error field="data.rows" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <x-label for="cols" /><span>(4 or 5)</span>
                                <x-input type="number" name="data[cols]" />
                                <x-error field="data.cols" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>
                </x-form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $('[selector]').select2({
            // tags: true,
        });
    });
</script>
@endpush