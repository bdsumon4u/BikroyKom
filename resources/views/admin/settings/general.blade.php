@push('styles')
<style>
    input[type="file"] {
        height: auto;
    }
</style>
@endpush

<div class="tab-pane active" id="item-general" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">General</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="desktop-logo" class="d-block">Desktop Logo ({{ config('services.logo.desktop.width', 260) }}x{{ config('services.logo.desktop.height', 54) }})</label>
                <input type="file" name="logo[desktop]" id="desktop-logo" class="form-control mb-1 @if($logo->desktop ?? '') d-none @endif">
                <img src="{{ asset($logo->desktop ?? '') ?? '' }}" alt="desktop Logo" class="img-responsive d-block" width="{{ config('services.logo.desktop.width', 260) }}" height="{{ config('services.logo.desktop.height', 54) }}" style="@unless($logo->desktop ?? '') display:none; @endunless">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="mobile-logo" class="d-block">Mobile Logo ({{ config('services.logo.mobile.width', 192) }}x{{ config('services.logo.mobile.height', 40) }})</label>
                <input type="file" name="logo[mobile]" id="mobile-logo" class="form-control mb-1 @if($logo->mobile ?? '') d-none @endif">
                <img src="{{ asset($logo->mobile ?? '') ?? '' }}" alt="mobile Logo" class="img-responsiv d-blocke" width="{{ config('services.logo.mobile.width', 192) }}" height="{{ config('services.logo.mobile.height', 40) }}" style="@unless($logo->mobile ?? '') display:none; @endunless">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="favicon-logo" class="d-block">Favicon ({{ config('services.logo.favicon.width', 56) }}x{{ config('services.logo.favicon.height', 56) }})</label>
                <input type="file" name="logo[favicon]" id="favicon-logo" class="form-control mb-1 @if($logo->favicon ?? '') d-none @endif">
                <img src="{{ asset($logo->favicon ?? '') ?? '' }}" alt="Favicon" class="img-responsive d-block" width="{{ config('services.logo.favicon.width', 56) }}" height="{{ config('services.logo.favicon.height', 56) }}" style="@unless($logo->favicon ?? '') display:none; @endunless">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div>