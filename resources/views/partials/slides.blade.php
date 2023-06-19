@push('styles')
<style>
    @media (max-width: 767px) {
        .block-slideshow__body, .block-slideshow__slide {
            height: 180px !important;
        }
        .block-slideshow__slide-image--mobile {
            background-size: cover;
        }
    }

    .block-slideshow__body {
        margin: 0 !important;
    }
    .block-slideshow__slide-content {
        right: 46px;
    }
    @media (max-width: 767px) {
        .block-slideshow__slide-content {
            right: 5%;
        }
    }
</style>
@endpush
<div class="block-slideshow block-slideshow--layout--with-departments block">
    <div id="slideshow-container">
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
                <div class="block-slideshow__body">
                    <div class="owl-carousel">
                        @foreach($slides as $slide)
                        <a class="block-slideshow__slide" href="{{ $slide->btn_href ?? '#' }}">
                            <div class="w-100 h-100 block-slideshow__slide-image block-slideshow__slide-image--desktop">
                                <img class="img-responsive" height="{{ config('services.slides.desktop.1') }}" src="{{ asset($slide->desktop_src) }}" alt="">
                            </div>
                            <div class="w-100 h-100 block-slideshow__slide-image block-slideshow__slide-image--mobile">
                                <img class="img-responsive" height="{{ config('services.slides.mobile.1') }}" src="{{ asset($slide->mobile_src) }}" alt="">
                            </div>
                            <div class="block-slideshow__slide-content">
                                <div class="container px-5">
                                    <div class="block-slideshow__slide-title">{!! $slide->title !!}</div>
                                    <div class="block-slideshow__slide-text">{!! $slide->text !!}</div>
                                    @if($slide->btn_href && $slide->btn_name)
                                        <div class="block-slideshow__slide-button">
                                            <span class="btn btn-primary btn-lg">{{ $slide->btn_name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            // var width = $(window).width();
            // $('#slideshow-container').css('max-width', width)
            // $('.owl-item').css({
            //     width: width,
            //     // maxWidth: width
            // })
            // $('.block-slideshow .owl-carousel').owlCarousel().trigger('refresh.owl.carousel');
        })
    </script>
@endpush
