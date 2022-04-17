<?php
$page = ['title' => 'معلومات المؤلف'];
?>

@extends('layouts.app', $page)

@section('content')

    @if (session()->has('message'))
        @include('includes.alert')
    @endif

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">معلومات المؤلف</legend>
        <div class="row justify-content-end">
            <div class="col-md-auto">
                <form action="{{ Route('authors.destroy', $author->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn text-primary fs-5" href="{{ Route('authors.edit', $author->id) }}"><i
                            class="fas fa-edit"></i></a>
                    <button class="btn text-danger fs-5" type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        <dl class="row">
            <dt class="col-md-auto">الرقم:</dt>
            <dd class="col-md-auto">{{ $author->id }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-md-auto">الاسم:</dt>
            <dd class="col-md-auto">{{ $author->name }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-md-auto">عدد الكتب:</dt>
            <dd class="col-md-auto fw-bold text-danger">{{ $author->books ? $author->books->count() : 0 }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-md-auto">تاريخ الإضافة:</dt>
            <dd class="col-md-auto text-success fw-bold">{{ $author->created_at }}</dd>
        </dl>
        <dl class="row">
            <dt class="col-md-auto">تاريخ آخر تعديل:</dt>
            <dd class="col-md-auto text-primary fw-bold">{{ $author->updated_at }}</dd>
        </dl>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">كتب المؤلف</legend>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="140px" class="text-center">رقم الكتاب</th>
                        <th scope="col">عنوان الكتاب</th>
                        {{-- <th scope="col">المؤلفين</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if ($author->books && $author->books->count() > 0)
                        @foreach ($author->books as $book)
                            <tr>
                                <th scope="row" width="140px" class="text-center">{{ $book->id }}</th>
                                <td>
                                    <a class="text-decoration-none text-dark"
                                        href="{{ Route('books.show', $book->id) }}">{{ $book->title }}</a>
                                </td>
                                {{-- <td>
                                    @foreach ($book->authors as $author)
                                        <span class="badge rounded-pill bg-primary p-2">
                                            <a href="{{ Route('authors.show', $author->id) }}"
                                                class="text-decoration-none text-light">{{ $author->name }}</a>
                                        </span>
                                    @endforeach
                                </td> --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="text-center fw-bold text-danger p-3">لا زلت لم تدخل كتب لهذا المؤلف
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </fieldset>
@endsection
