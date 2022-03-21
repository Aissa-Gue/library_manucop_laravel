<?php
$page = ['title' => 'إضافة كتاب'];
$subNavs = [
    [
        'text' => 'إضافة مؤلف',
        'icon' => 'fas fa-user',
        'route' => 'authors.create',
    ],
    [
        'text' => 'إضافة كتاب',
        'icon' => 'fas fa-user',
        'route' => 'books.create',
    ],
];

$authorLivewire =
    [
        'label' => 'المؤلفين',
        'placeholder' => 'حدد مؤلف',
    ];

$subjectLivewire =
    [
        'label' => 'مواضيع الكتاب',
        'placeholder' => 'حدد موضوع',
    ];
?>
@extends('layouts.app', $page)

@section('content')
    @include('includes.subNavs',$subNavs)

    <form action="{{Route('books.store')}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات الكتاب</legend>
            <div class="row mb-1">
                <div class="col-md-8">
                    <label for="book" class="form-label">عنوان الكتاب</label>
                    <input name="title" class="form-control @error('title') is-invalid @enderror" id="book" placeholder="أدخل عنوان الكتاب">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <!-- authors list -->
            <div class="row mb-1">
                <div id="authors_row" class="col-md-7">
                    <livewire:author-search :authorLivewire="$authorLivewire"/>
                    @error('authors.*')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- subjects list -->
                <div id="subjects_row" class="col-md-7">
                    <livewire:subject-search :subjectLivewire="$subjectLivewire"/>
                    @error('subjects.*')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">إضافة الكتاب</button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
