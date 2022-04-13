<link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('img/favicon.ico') }}" />
<!-- jquery-->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
     integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>-->
<script src="{{ URL::asset('requirements/jquery-3.6.0.slim.min.js') }}"></script>

<!-- bootstrap-5.0.2 -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">-->
<link rel="stylesheet" href="{{ URL::asset('requirements/bootstrap-5.0.2-dist/css/bootstrap.rtl.css') }}">

<!--Fontawesome_pro_v6-->
<!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>-->
<link rel="stylesheet" href="{{ URL::asset('requirements/Fontawesome_pro_v6/css/all.css') }}">

<!--Apex charts-->
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
<script src="{{ URL::asset('requirements/apexCharts/apexcharts.js') }}"></script>


<!-- FONTS -->
<link href="{{ URL::asset('css/fonts.css') }}" rel="stylesheet">

<!-- MY CSS -->
<link href="{{ URL::asset('css/side-nav-bar.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/print.css') }}" rel="stylesheet">

<!-- JavaScript bootstrap-5.0.2 Bundle with Popper -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>-->
<script src="{{ URL::asset('requirements/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>

@livewireStyles
