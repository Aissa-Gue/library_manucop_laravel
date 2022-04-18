<link href="{{ URL::asset('css/subNav.css') }}" rel="stylesheet">

<div id="navigation">
    <ul class="nav nav-pills mb-4 fw-bold justify-content-center">
        @foreach ($subNavs as $subNav)
            <li class="nav-item">
                <a class="nav-link {{ Request::is($subNav['request']) ? 'active' : '' }}"
                    href="{{ Route($subNav['route']) }}">
                    <i class="{{ $subNav['icon'] }}"></i>
                    {{ $subNav['text'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
