@extends('layouts.light.master')
@section('title', 'Invoice')

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/print.css')}}">
@endpush

@push('styles')
<style>
    .invoice th,
    .invoice td {
        padding: 0.5rem;
    }
@media print {
    html, body {
        height:100vh;
        margin: 0 !important;
        padding: 0 !important;
        overflow: hidden;
    }
    .main-nav {
        display: none !important;
        width: 0 !important;
    }
    .print-edit-buttons,
    .footer {
        display: none !important;
    }
    .page-body {
        font-size: 20px;
        margin-top: 0 !important;
        margin-left: 0 !important;
        page-break-after: always;
    }
    .page-body p {
        font-size: 16px !important;
    }
    .only-print {
        display: block;
        padding-top: 2rem;
    }
}
</style>
@endpush

@section('breadcrumb-title')
<h3>Invoice</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.orders.index') }}">Orders</a>
</li>
<li class="breadcrumb-item">Invoice</li>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice">
                    <div>
                        <div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="media">
                                        <div class="media-left">
                                            <img class="media-object" src="{{asset($logo->mobile)}}" alt="" width="180" height="54">
                                        </div>
                                        <div class="media-body m-l-20">
                                            <h4 class="media-heading">{{ $company->name }}</h4>
                                            <p>@if($company->email){{ $company->email }}<br>@endif<span class="digits">{{ $company->phone }}</span></p>
                                        </div>
                                    </div>
                                    <!-- End Info-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-md-right">
                                        <h3>Invoice #<span class="digits -counter-">{{ $order->id }}</span></h3>
                                        <p>
                                            Ordered At: {{ $order->created_at->format('M') }}<span class="digits"> {{ $order->created_at->format('d, Y') }}</span>
                                            <br> Invoiced At: {{ date('M') }}<span class="digits"> {{ date('d, Y') }}</span>
                                        </p>
                                    </div>
                                    <!-- End Title-->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- End InvoiceTop-->
                        <div class="row">
                            <div class="col-md-7">
                                <div class="media">
                                    <div class="media-body m-l-20">
                                        <h6 class="media-heading">Customer Information:</h6>
                                        <div><b>Name:</b> {{ $order->name }}</div>
                                        <div><b>Address:</b> {{ $order->address }}</div>
                                        <div>
                                            @if($order->email)
                                                <span><b>Email:</b> {{ $order->email }}</span>
                                                <br>
                                            @endif
                                            <span><b>Phone:</b> {{ $order->phone }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="text-md-right" id="project">
                                    <h6>Note</h6>
                                    <p>{{ $order->note ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Invoice Mid-->
                        <div>
                            <div class="table-responsive invoice-table" id="table">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="100">Image</th>
                                            <th>Name</th>
                                            <th width="95">Price</th>
                                            <th width="10">Quantity</th>
                                            <th width="95">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ $product->image }}" width="100" height="100" alt="">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->quantity * $product->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-right" colspan="4">Subtotal</th>
                                        <th class="text-right">{{ $order->data->subtotal }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="4">Delivery Charge</th>
                                        <th class="text-right">{{ $order->data->shipping_cost }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="4">Advanced</th>
                                        <th class="text-right">{{ $advanced = $order->data->advanced ?? 0 }}</th>
                                    </tr>
                                    @php($total = $order->data->shipping_cost + $order->data->subtotal)
{{--                                        <tr>--}}
{{--                                            <th colspan="4">Total</th>--}}
{{--                                            <th>{{ $total }}</th>--}}
{{--                                        </tr>--}}
                                    <tr>
                                        <th class="text-right" colspan="4">Discount</th>
                                        <th class="text-right">{{ $discount = $order->data->discount ?? 0 }}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="4">Payable</th>
                                        <th class="text-right">{{ $total - $advanced - $discount }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- End Table-->
                        </div>
                        <!-- End InvoiceBot-->
                    </div>
                    <div class="col-sm-12 print-edit-buttons text-center mt-3">
                        <button class="btn btn btn-primary mr-2" type="button" onclick="myFunction()">Print</button>
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-success">Edit</a>
                    </div>
                    <!-- End Invoice-->
                    <!-- End Invoice Holder-->
                </div>
            </div>
            <div class="card-footer d-print-none">
                <h5 class="text-center">Old Orders</h5>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Product</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $order->created_at->format('d-M-Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $order->note }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/js/print.js')}}"></script>
@endpush
