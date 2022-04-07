<?php
$page = ['title' => 'تعديل معلومات الكتاب'];

?>
@extends('layouts.app', $page)

@section('content')
    @if (session()->has('message'))
        @include('includes.alert')
    @endif

    <livewire:books.edit-book :bookInfo="$bookInfo" />

    <script src="{{ URL::asset('js/books.js') }}"></script>
@endsection
