<style>
    #navigation li {
        margin: 0px 10px;
    }

    #navigation ul {
        background-color: rgba(21, 82, 213, 0.1);
        padding: 2px 0;
        border-radius: 25px;
        width: 28vw;
        margin: auto;
    }

    #navigation .nav-link.active {
        border-radius: 25px;
    }
</style>

<div id="navigation">
    <ul class="nav nav-pills mb-4 fw-bold justify-content-center">
        @foreach($subNavs as $subNav)
            <li class="nav-item">
                <a class="nav-link {{Route::is($subNav['route']) ? 'active' : ''}}" href="{{Route($subNav['route'])}}">
                    <i class="{{$subNav['icon']}}"></i>
                    {{ $subNav['text'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
