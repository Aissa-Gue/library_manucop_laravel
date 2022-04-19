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

    <div class="row">
        <form id="advancedSearchForm" action="{{ Route('search.advanced.manuSearch') }}" method="get">
            <livewire:search.advanced-search-manuscripts />
            <div id="hiddenInputsSubject"></div>
            <div id="hiddenInputsAuthor"></div>
            <div id="hiddenInputsTranscriber"></div>
            <div id="hiddenInputsManutype"></div>
            <div id="hiddenInputsColor"></div>
            <div id="hiddenInputsMotif"></div>
            <div id="hiddenInputsCabinet"></div>

        </form>
    </div>
    <script src="{{ URL::asset('js/advancedSearch.js') }}"></script>
@endsection
