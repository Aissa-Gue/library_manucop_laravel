<?php
$page = ['title' => 'إضافة استمارة'];
?>

@extends('layouts.app', $page)

@section('content')
    @if (session()->has('message'))
        @include('includes.alert')
    @endif

    <link href="{{ asset('/css/progressBar.css') }}" rel="stylesheet">
    {{-- manuscript livewire controller --}}
    <livewire:manuscripts.create-manuscript />

    <script src="{{ URL::asset('js/manuscripts.js') }}"></script>
@endsection
