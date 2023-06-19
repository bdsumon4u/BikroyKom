<div class="block block-products-carousel">
    <div class="container">
        @if($title ?? null)
        <div class="block-header">
            <h3 class="block-header__title">
                @isset($section)
                <a href="{{ route('home-sections.products', $section) }}" style="color:inherit;">{{ $title }}</a>
                @else
                {{ $title }}
                @endisset
            </h3>
            <div class="block-header__divider"></div>
            @isset($section)
            <a href="{{ route('products.index', ['section' => $section->id]) }}" class="btn btn-sm ml-0 block-header__arrows-list">
                View All
            </a>
            @endisset
        </div>
        @endif
        <div class="products-view__list products-list" data-layout="grid-{{ $cols ?? 5 }}-full" data-with-features="false">
            <div class="products-list__body">
                @foreach($products as $product)
                <div class="products-list__item">
                    <div class="product-card" data-id="{{ $product->id }}" data-max="{{ $product->should_track ? $product->stock_count : -1 }}">
                        @exp($in_stock = !$product->should_track || $product->stock_count > 0)
                        <div class="product-card__badges-list">
                            @if(! $in_stock)
                            <div class="product-card__badge product-card__badge--sale">Sold</div>
                            @endif
                            @if($product->price != $product->selling_price)
                            <div class="product-card__badge product-card__badge--sale">-{{ round(($product->price - $product->selling_price) * 100 / $product->price, 0, PHP_ROUND_HALF_UP) }}%</div>
                            @endif
                        </div>
                        <div class="product-card__image">
                            <a href="{{ route('products.show', $product) }}">
                                <img src="{{ $product->base_image->src }}" alt="Base Image">
                            </a>
                        </div>
                        <div class="product-card__info">
                            <div class="product-card__name">
                                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                            </div>
                        </div>
                        <div class="product-card__actions">
                            <div class="product-card__availability">Availability:
                                @if(! $product->should_track)
                                <span class="text-success">In Stock</span>
                                @else
                                <span class="text-{{ $product->stock_count ? 'success' : 'danger' }}">{{ $product->stock_count }} In Stock</span>
                                @endif
                            </div>
                            <div class="product-card__prices {{$product->selling_price == $product->price ? '' : 'has-special'}}">
                                @if($product->selling_price == $product->price)
                                {!!  theMoney($product->price)  !!}
                                @else
                                <span class="product-card__new-price">{!!  theMoney($product->selling_price)  !!}</span>
                                <span class="product-card__old-price">{!!  theMoney($product->price)  !!}</span>
                                @endif
                            </div>
                            <div class="product-card__buttons">
                                @exp($available = !$product->should_track || $product->stock_count > 0)
                                <button class="btn btn-primary product-card__addtocart" type="button" {{ $available ? '' : 'disabled' }}>Add To Cart</button>
                                <button class="btn btn-primary product-card__ordernow" type="button" {{ $available ? '' : 'disabled' }}>Order Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
