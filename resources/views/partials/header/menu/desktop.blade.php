<div class="nav-panel__nav-links nav-links ml-auto">
    <ul class="nav-links__list">
        @foreach($menuItems as $item)
        <li class="nav-links__item">
            <a href="{{ url($item->href) }}">
                <span>{{ $item->name }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>