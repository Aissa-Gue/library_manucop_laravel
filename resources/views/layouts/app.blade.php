<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('img/favicon.ico') }}" />

    <title>المكتبة المركزية | برنامج المخطوطات</title>

    @include('includes.requirements')
</head>

<body class="my_bg">
    @include('includes.navbar')

    <div class="container-fluid my_mt">
        <div class="row">
            <div class="d-none d-lg-block">
                @include('includes.sidebar')
            </div>
            <div class="my_fixed_content mt-3">
                @if (isset($page['title']))
                    <div class="alert alert-primary text-center mb-4" role="alert">
                        <h4>{{ $page['title'] }}</h4>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>
