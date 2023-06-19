<div class="tab-pane" id="item-services" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Services</small></h4>
        </div>
    </div>

    <div class="row">
        @foreach(config('services.services', []) as $num => $icon)
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend mr-1">
                    <span class="input-group-text">
                        <svg width="24px" height="24px"><use xlink:href="{{ asset($icon) }}"></use></svg>
                    </span>
                </div>
                <div class="" style="flex: 1;">
                    <div class="form-group mb-1">
                        <label for="" class="ml-1">Title</label>
                        <x-input name="services[{{ $num }}][title]" :value="$services->$num->title ?? ''" />
                    </div>
                    <div class="form-group mt-2 mb-0">
                        <label for="" class="ml-1">Detail</label>
                        <x-input name="services[{{ $num }}][detail]" :value="$services->$num->detail ?? ''" />
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div>
