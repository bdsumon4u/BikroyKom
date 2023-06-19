@extends('layouts.light.master')
@section('title', 'Home Sections')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endpush

@section('breadcrumb-title')
<h3>Home Sections</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Home Sections</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Individual column searching (text inputs) </h5>
               <span>The searching functionality provided by DataTables is useful for quickly search through the information in the table - however the search is global, and you may wish to present controls that search on specific columns.</span>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered">
                     <thead>
                        <tr>
                           <th>Order</th>
                           <th>Title</th>
                           <th>Type</th>
                           <th width="10">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($sections as $section)
                        <tr>
                           <td>{{ $section->order }}</td>
                           <td>{{ $section->title }}</td>
                           <td>{{ $section->type }}</td>
                           <td>
                              <x-form :action="route('admin.home-sections.destroy', $section)" method="delete" class="d-flex justify-content-between">
                                 <a href="{{ route('admin.home-sections.edit', $section) }}" class="btn btn-primary">Edit</a>
                                 <button type="submit" class="btn btn-danger">
                                    Delete
                                 </button>
                              </x-form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@push('js')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/product-list-custom.js')}}"></script>
@endpush
