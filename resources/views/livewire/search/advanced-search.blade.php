<?php
$subNavs = [
    [
        'text' => 'بحث سريع',
        'icon' => 'fas fa-search',
        'route' => 'search.quick.manuscripts',
        'request' => 'search/quick/*',
    ],
    [
        'text' => 'بحث متقدم',
        'icon' => 'fas fa-telescope',
        'route' => 'search.advanced.manuscripts',
        'request' => 'search/advanced/*',
    ],
];
?>
<div>
    @extends('layouts.app')

    @section('content')
        @include('includes.subNavs', $subNavs)
    @endsection



</div>
