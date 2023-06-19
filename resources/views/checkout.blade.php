@extends('layouts.yellow.master')

@section('title', 'Checkout')

@section('content')

@include('partials.page-header', [
    'paths' => [
        url('/')                => 'Home',
        route('products.index') => 'Products',
        route('cart')           => 'Cart',
    ],
    'active' => 'Checkout',
    'page_title' => 'Checkout'
])

<div class="checkout block">
    <div class="container">
        <x-form :action="route('checkout')" method="POST">
            @php $user = optional(auth('user')->user()) @endphp
            <div class="row">
                <div class="col-12 col-md-8 pr-1">
                    <div class="card mb-lg-0">
                        <div class="card-body p-3">
                            <h3 class="card-title">Billing details</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <x-input name="name" placeholder="Name *" :value="$user->name" />
                                    <x-error field="name" />
                                </div>
                                <div class="form-group col-md-6">
                                    <x-input name="phone" placeholder="Phone Number *" :value="$user->phone_number ?? ''" />
                                    <x-error field="phone" />
                                </div>
                            </div>
                            <div class="form-row" style="display: none;">
                                <div class="form-group col-md-12">
                                    <x-input type="email" name="email" placeholder="Email" :value="$user->email" />
                                    <x-error field="email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="d-block">Delivery Area <span class="text-danger">*</span></label>
                                @php $dcharge = setting('delivery_charge') @endphp
                                <div class="form-control @error('shipping') is-invalid @enderror h-auto">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="inside-dhaka" name="shipping" value="Inside Dhaka" data-val="{{ $dcharge->inside_dhaka ?? config('services.shipping.Inside Dhaka') }}">
                                        <label class="custom-control-label" for="inside-dhaka">Inside Dhaka</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="outside-dhaka" name="shipping" value="Outside Dhaka" data-val="{{ $dcharge->outside_dhaka ?? config('services.shipping.Outside Dhaka') }}">
                                        <label class="custom-control-label" for="outside-dhaka">Outside Dhaka</label>
                                    </div>
                                </div>
                                <x-error field="shipping" />
                            </div>
                            <div class="form-group">
                                <x-textarea name="address" placeholder="Address *">{{ $user->address }}</x-textarea>
                                <x-error field="address" />
                            </div>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body p-1">
                            <h4 class="p-2">Product Overview</h4>
                            @include('partials.cart-table')
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 pl-1 mt-4 mt-lg-0">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h3 class="card-title">Your Order</h3>
                            <div class="ordered-products"></div>
                            <table class="checkout__totals">
                                <tbody class="checkout__totals-subtotals">
                                    <tr>
                                        <th>Subtotal</th>
                                        <td class="checkout-subtotal">{!!  theMoney(0)  !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td class="shipping">{!!  theMoney(0)  !!}</td>
                                    </tr>
                                </tbody>
                                <tfoot class="checkout__totals-footer">
                                    <tr>
                                        <th>Total</th>
                                        <td>{!!  theMoney(0)  !!}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="checkout__agree form-group">
                                <div class="form-check">
                                    <span class="form-check-input input-check">
                                        <span class="input-check__body">
                                            <input class="input-check__input" type="checkbox" id="checkout-terms" checked>
                                            <span class="input-check__box"></span>
                                            <svg class="input-check__icon" width="9px" height="7px">
                                                <use xlink:href="{{ asset('strokya/images/sprite.svg#check-9x7') }}"></use>
                                            </svg>
                                        </span>
                                    </span>
                                    <label class="form-check-label" for="checkout-terms">I agree to the <span class="text-info" target="_blank" href="javascript:void(0);">terms and conditions</span>*</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger btn-xl btn-block">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </x-form>
    </div>
</div>
@endsection