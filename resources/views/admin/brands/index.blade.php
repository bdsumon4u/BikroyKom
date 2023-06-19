@extends('layouts.light.master')
@section('title', 'Brands')

@section('breadcrumb-title')
<h3>Brands</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Brands</li>
@endsection


@push('styles')
<style>
    .nav-tabs .nav-item .nav-link {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .formatted-categories ul {
        list-style: none;
        padding: 0;
    }
    .formatted-categories ul li {
        background-color: #f3f3f3;
        padding: 5px 10px;
        margin-bottom: 2px;
    }
    .formatted-categories ul li:hover {
        background-color: aliceblue;
    }
    .formatted-categories ul li:hover a {
        text-decoration: none;
    }
    .formatted-categories ul li:hover,
    .formatted-categories ul li.active,
    .formatted-categories ul li.active a {
        color: deeppink;
        text-decoration: none;
    }
    .select2 {
        width: 100% !important;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center mb-3">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm mb-5">
            <div class="card-header p-3"><strong>All</strong> <small><i>Brands</i></small></div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-7">
                        <div class="formatted-categories mb-3">
                            @if($brands->isEmpty())
                            <div class="alert alert-danger py-2"><strong>No Brands Found.</strong></div>
                            @else
                            <x-categories.tree :categories="$brands" />
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="nav-tabs-boxed">
                            <div class="card rounded-0 shadow-sm">
                                <div class="card-header p-3">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#create-brand"
                                                role="tab" aria-controls="create-brand" aria-selected="false">Create</a>
                                        </li>
                                        @if(request('active_id'))
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#edit-brand"
                                                role="tab" aria-controls="edit-brand" aria-selected="false">Edit</a>
                                        </li>
                                        <li class="nav-item ml-auto">
                                            <x-form action="{{ route('admin.brands.destroy', request('active_id', 0)) }}" method="delete">
                                                <button type="submit" class="nav-link btn btn-danger btn-square delete-action">Delete</button>
                                            </x-form>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="card-body p-3">
                                    @if($message = Session::get('success'))
                                    <div class="alert alert-info py-2"><strong>{{ $message }}</strong></div>
                                    @endif
                                    @php $active = App\Brand::find(request('active_id')) @endphp
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="create-brand" role="tabpanel">
                                            <p class="text-info">Create Brand</p>
                                            <form action="{{ route('admin.brands.store') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="create-name">Name</label>
                                                    <input type="text" name="name" value="{{ old('name') }}" id="create-name" data-target="#create-slug" class="form-control @error('name') is-invalid @enderror">
                                                    @error('name')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="create-slug">Slug</label>
                                                    <input type="text" name="slug" value="{{ old('slug') }}" id="create-slug" class="form-control @error('slug') is-invalid @enderror">
                                                    @error('slug')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success d-block ml-auto"><i class="fa fa-check"></i> Submit</button>
                                            </form>
                                        </div>
                                        @if(request('active_id'))
                                        <div class="tab-pane" id="edit-brand" role="tabpanel">
                                            <p class="text-info">Edit Brand</p>
                                            <form action="{{ route('admin.brands.update', request('active_id', 0)) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="edit-name">Name</label><span class="text-danger">*</span>
                                                    <input type="text" name="name" value="{{ old('name', $active->name) }}" id="edit-name" data-target="#edit-slug" class="form-control @error('name') is-invalid @enderror">
                                                    @error('name')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="edit-slug">Slug</label><span class="text-danger">*</span>
                                                    <input type="text" name="slug" value="{{ old('slug', $active->slug) }}" id="edit-slug" class="form-control @error('slug') is-invalid @enderror">
                                                    @error('slug')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success d-block ml-auto"><i class="fa fa-check"></i> Submit</button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('[name="name"]').keyup(function () {
            $($(this).data('target')).val(slugify($(this).val()));
        });
    });
</script>
@endpush