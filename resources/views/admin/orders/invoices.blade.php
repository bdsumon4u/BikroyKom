<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{asset($logo->favicon ?? '')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset($logo->favicon ?? '')}}" type="image/x-icon">
    <title>{{ $company->name ?? '' }} - @yield('title')</title>
    @include('layouts.light.css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/print.css')}}">
    <style>
    .invoice th,
    .invoice td {
        padding: 0.25rem;
    }
@media print {
    html, body {
        /* height:100vh; */
        margin: 0 !important;
        padding: 0 !important;
        /* overflow: hidden; */
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
    }
    .invoice {
        page-break-after: avoid;
        padding-top: 3rem;
        min-height: 50vh;
        height: 50%;
    }
    .page-break {
        page-break-after: always;
        border-top: 2px dashed #000;
    }
    .page-body p {
        font-size: 16px !important;
    }
}
</style>
  </head>
  <body class="light-only" main-theme-layout="ltr">
    @foreach ($orders as $order)
        <div class="invoice {{ ($loop->index & 1) ? 'page-break' : 'pb-5' }}">
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
        </div>
    @endforeach
    @include('layouts.light.js')
    <script>
        window.onload = function () {
            window.print();
        }
    </script>
  </body>
</html>
