<?php
$page = ['title' => 'تعديل معلومات الناسخ'];

$cityLivewire = [
    'label' => 'المدينة',
    'placeholder' => 'أدخل مدينة الناسخ',
];

$countryLivewire = [
    'label' => 'البلد',
    'placeholder' => 'أدخل بلد الناسخ',
];
?>

@extends('layouts.app', $page)

@section('content')
    {{-- transcriber livewire controller --}}
    <livewire:transcribers.edit-transcriber :transcriber="$transcriber" />
    <script src="{{ URL::asset('js/transcribers.js') }}"></script>
@endsection
