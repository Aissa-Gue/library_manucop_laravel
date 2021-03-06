<?php
$page = ['title' => 'إضافة مؤلف'];
$subNavs = [
    [
        'text' => 'إضافة مؤلف',
        'icon' => 'fas fa-user-plus',
        'route' => 'authors.create',
        'request' => 'authors/*',
    ],
    [
        'text' => 'إضافة كتاب',
        'icon' => 'fas fa-book-medical',
        'route' => 'books.create',
        'request' => 'books/*',
    ],
];
?>
@extends('layouts.app', $page)

@section('content')
    @include('includes.subNavs', $subNavs)

    <form action="{{ Route('authors.store') }}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات المؤلف</legend>

            <div class="row">
                <div class="col-md-7">
                    <label for="author" class="form-label">اسم المؤلف</label>
                    <input name="name" class="form-control @error('name') is-invalid @enderror" id="author"
                        placeholder="أدخل اسم المؤلف">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> إضافة </button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
