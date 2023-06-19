<div class="tab-pane" id="item-2" role="tabpanel">
    <div class="row">
        <div class="col-sm-12">
            <h4><small class="border-bottom mb-1">Social</small></h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-facebook"></i></span>
                </div>
                <x-input name="social[facebook][link]" :value="$social->facebook->link ?? ''" />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[facebook][display]" {{ old('social.facebook.display', $social->facebook->display ?? false) ? 'checked' : '' }}>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-twitter"></i></span>
                </div>
                <x-input name="social[twitter][link]" :value="$social->twitter->link ?? ''" />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[twitter][display]" {{ old('social.twitter.display', $social->twitter->display ?? false) ? 'checked' : '' }}>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                </div>
                <x-input name="social[instagram][link]" :value="$social->instagram->link ?? ''" />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[instagram][display]" {{ old('social.instagram.display', $social->instagram->display ?? false) ? 'checked' : '' }}>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                </div>
                <x-input name="social[youtube][link]" :value="$social->youtube->link ?? ''" />
                <div class="input-group-append">
                    <span class="input-group-text">
                        <input type="checkbox" name="social[youtube][display]" {{ old('social.youtube.display', $social->youtube->display ?? false) ? 'checked' : '' }}>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</div>