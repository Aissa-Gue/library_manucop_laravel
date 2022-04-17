<?php
$page = ['title' => 'قائمة المؤلفين'];
?>

@extends('layouts.app', $page)

@section('content')
    <form action="{{ Route('authors.index') }}" method="get">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">بحث</legend>

            <div class="row justify-content-md-center">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">رقم المؤلف</span>
                    </div>
                    <input type="text" name="id" class="form-control" placeholder="أدخل رقم المؤلف"
                        value="{{ request('id') }}">

                    <div class="input-group-prepend">
                        <span class="input-group-text">اسم المؤلف</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="أدخل اسم المؤلف"
                        value="{{ request('name') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">بحث</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <!-- </form> -->

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">قائمة المؤلفين</legend>

        <div class="alert alert-warning text-center" role="alert">
            <strong> عدد النتائج = </strong>
            {{ $authors->total() }}
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">رقم المؤلف</th>
                    <th scope="col">اسم المؤلف</th>
                    <th scope="col" class="text-center">عدد الكتب</th>
                    <th scope="col" class="text-center">تفاصيل</th>
                    <th scope="col" class="text-center">تعديل</th>
                    <th scope="col" class="text-center">حذف</th>
                </tr>
            </thead>

            <tbody>
                @forelse($authors as $author)
                @empty
                    <tr>
                        <td class="text-center text-danger fw-bold py-4" colspan="6">
                            <i class="fas fa-exclamation-triangle"></i>
                            لا توجد نتائج مطابقة لـ:
                            <strong class=""> {{ request('id') }} {{ request('name') }}</strong>
                        </td>
                    </tr>
                @endforelse

                @if (session()->has('message'))
                    @include('includes.alert')
                @endif

                @foreach ($authors as $author)
                    <tr>
                        <th scope="row" class="text-center">{{ $author->id }}</th>
                        <td>{{ $author->name }}</td>
                        <td class="text-center">
                            {{ $author->books ? $author->books->count() : 0 }}
                        </td>
                        <td class="text-center">
                            <a class="btn btn-outline-success" href="{{ Route('authors.show', $author->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>

                        <td class="text-center">
                            <a class="btn btn-outline-primary" href="{{ Route('authors.edit', $author->id) }}">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>

                        <td class="text-center">
                            <form action="{{ Route('authors.destroy', $author->id) }}" method="POST">
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
                {{ $authors->links() }}
            </div>
        </div>
    </fieldset>
@endsection
