<?php
$page = ['title' => 'إضافة كتاب'];
$subNavs = [
    [
        'text' => 'إضافة مؤلف',
        'icon' => 'fas fa-user-plus',
        'route' => 'authors.create',
    ],
    [
        'text' => 'إضافة كتاب',
        'icon' => 'fas fa-book-medical',
        'route' => 'books.create',
    ],
];

?>
@extends('layouts.app', $page)

@section('content')
    @include('includes.subNavs', $subNavs)

    @if (session()->has('message'))
        @include('includes.alert')
    @endif

    <livewire:books.create-book />

    <script src="{{ URL::asset('js/books.js') }}"></script>
@endsection
