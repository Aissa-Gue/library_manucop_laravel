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
@extends('layouts.app')

@section('content')
    @include('includes.subNavs', $subNavs)

    <div class="row justify-content-center mb-3 ">
        <div class="col-md-8">
            <ul class="nav nav-pills py-1 fw-bold" style="background: #0d6dfd38">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('search.quick.manuscripts') ? 'active' : '' }}"
                        href="{{ Route('search.quick.manuscripts') }}"><i class="fas fa-scroll-old"></i> الاستمارت</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('search.quick.transcribers') ? 'active' : '' }}"
                        href="{{ Route('search.quick.transcribers') }}"><i class="fas fa-feather-alt"></i> النساخ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('search.quick.books') ? 'active' : '' }}"
                        href="{{ Route('search.quick.books') }}"><i class="fas fa-books"></i> الكتب</a>
                </li>
                {{-- <div class="offset-6">
                        <a class="btn btn-outline-success" href="{{ Route('search.results') }}">نتائج البحث</a>
                    </div> --}}
            </ul>
        </div>
    </div>
    @if (Route::is('search.quick.manuscripts'))
        <livewire:search.quick-search-manuscripts />
    @elseif (Route::is('search.quick.transcribers'))
        <livewire:search.quick-search-transcribers />
    @elseif (Route::is('search.quick.books'))
        <div class="row">
            <form id="quickSearchForm" action="{{ Route('search.quick.bookSearch') }}" method="get">
                <livewire:search.quick-search-books />
                <div id="hiddenInputsSubject"></div>
                <div id="hiddenInputsAuthor"></div>
            </form>
        </div>
    @endif

    <script src="{{ URL::asset('js/quickSearch.js') }}"></script>
@endsection
