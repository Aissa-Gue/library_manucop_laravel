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

        <div class="row justify-content-center mb-3 ">
            <div class="col-md-8">
                <ul class="nav nav-pills bg-white py-1">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('search.quick.manuscripts') }}">الاستمارت</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ Route('search.quick.transcribers') }}">النساخ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ Route('search.quick.books') }}">الكتب</a>
                    </li>
                    <div class="offset-6">
                        <a class="btn btn-outline-success" href="{{ Route('search.results') }}">نتائج البحث</a>
                    </div>
                </ul>
            </div>
        </div>
        <livewire:search.advanced />
    @endsection

</div>
