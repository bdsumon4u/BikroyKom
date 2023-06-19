<div class="tab-pane" id="item-3" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Delivery</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Delivery Charge</label>
                <div class="row borderr py-2">
                    <div class="col-md-6 pr-0">
                        <label for="products_page-rows">Inside Dhaka</label>
                        <x-input name="delivery_charge[inside_dhaka]" id="delivery_charge-inside_dhaka" :value="$delivery_charge->inside_dhaka ?? config('services.shipping')['Inside Dhaka']" />
                        <x-error field="delivery_charge.inside_dhaka" />
                    </div>
                    <div class="col-md-6 pl-0">
                        <label for="products_page-cols">Outside Dhaka</label>
                        <x-input name="delivery_charge[outside_dhaka]" id="delivery_charge-outside_dhaka" :value="$delivery_charge->outside_dhaka ?? config('services.shipping')['Outside Dhaka']" />
                        <x-error field="delivery_charge.outside_dhaka" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="delivery-text">Delivery Text</label>
                <x-textarea editor name="delivery_text" id="delivery-text">{!! $delivery_text ?? '' !!}</x-textarea>
                <x-error field="delivery_text" />
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div>

@push('js')
    <script src="{{ asset('js/tinymce.js') }}"></script>
@endpush
