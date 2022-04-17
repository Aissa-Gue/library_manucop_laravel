<?php
$page = ['title' => 'قائمة الكتب'];
?>

@extends('layouts.app', $page)

@section('content')
    <form action="{{ Route('books.index') }}" method="get">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">بحث</legend>

            <div class="row justify-content-md-center mb-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">رقم الكتاب</span>
                    </div>
                    <input type="text" name="id" class="form-control" placeholder="أدخل رقم الكتاب"
                        value="{{ request('id') }}">

                    <div class="input-group-prepend">
                        <span class="input-group-text">عنوان الكتاب</span>
                    </div>
                    <input type="text" name="title" class="form-control" placeholder="أدخل عنوان الكتاب"
                        value="{{ request('title') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">بحث</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>

    <!-- </form> -->
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">قائمة الكتب</legend>

        <div class="alert alert-warning text-center" role="alert">
            <strong> عدد النتائج = </strong>
            {{ $books->total() }}
        </div>

        @if (session()->has('message'))
            @include('includes.alert')
        @endif

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">رقم الكتاب</th>
                    <th scope="col">عنوان الكتاب</th>
                    <th scope="col" class="text-center">عدد المنسوخات</th>
                    <th scope="col" class="text-center">تفاصيل</th>
                    <th scope="col" class="text-center">تعديل</th>
                    <th scope="col" class="text-center">حذف</th>
                </tr>
            </thead>

            <tbody>
                @forelse($books as $book)
                @empty
                    <tr>
                        <td class="text-center text-danger fw-bold py-4" colspan="6">
                            <i class="fas fa-exclamation-triangle"></i>
                            لا توجد نتائج مطابقة لـ:
                            <strong class=""> {{ request('id') }} {{ request('title') }}</strong>
                        </td>
                    </tr>
                @endforelse

                @foreach ($books as $book)
                    <tr>
                        <th scope="row" class="text-center">{{ $book->id }}</th>
                        <td>{{ $book->title }}</td>
                        <td class="text-center">
                            {{ $book->manuscripts ? $book->manuscripts->count() : 0 }}
                        </td>
                        <td class="text-center">
                            <a class="btn btn-outline-success" href="{{ Route('books.show', $book->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>

                        <td class="text-center">
                            <a class="btn btn-outline-primary" href="{{ Route('books.edit', $book->id) }}">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>

                        <td class="text-center">
                            <form action="{{ Route('books.destroy', $book->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" type="submit"
                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row justify-content-center fixed-bottom">
            <div class="offset-2 col-md-auto">
                {{ $books->links() }}
            </div>
        </div>
    </fieldset>
@endsection
