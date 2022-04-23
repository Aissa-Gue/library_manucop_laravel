<?php
$page = ['title' => 'قائمة المدن'];

?>
@extends('layouts.app', $page)

@section('content')
    @include('cities.create')

    @if (session()->has('message'))
        @include('includes.alert')
    @endif

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">قائمة المدن</legend>

        <form action="{{ Route('cities.index') }}" method="get">
            <div class="row justify-content-md-center">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">رقم المدينة</span>
                    </div>
                    <input type="text" name="id" class="form-control" placeholder="أدخل رقم المدينة"
                        value="{{ request('id') }}">

                    <div class="input-group-prepend">
                        <span class="input-group-text">اسم المدينة</span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="أدخل اسم المدينة"
                        value="{{ request('name') }}">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> البلد</span>
                    </div>
                    <input type="text" name="country" class="form-control" placeholder="أدخل اسم البلد"
                        value="{{ request('country') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">بحث</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- </form> -->


        <div class="alert alert-warning text-center mt-3" role="alert">
            <strong> عدد النتائج = </strong>
            {{ $cities->total() }}
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">رقم المدينة</th>
                    <th scope="col">اسم المدينة</th>
                    <th scope="col">البلد</th>
                    <th scope="col" class="text-center">عدد المنسوخات</th>
                    <th scope="col" class="text-center">عدد الناسخين</th>
                    <th scope="col" class="text-center">تعديل</th>
                    <th scope="col" class="text-center">حذف</th>
                </tr>
            </thead>

            <tbody>
                @forelse($cities as $city)
                @empty
                    <tr>
                        <td class="text-center text-danger fw-bold py-4" colspan="7">
                            <i class="fas fa-exclamation-triangle"></i>
                            لا توجد نتائج مطابقة لـ:
                            <strong class=""> {{ request('id') }} {{ request('name') }}</strong>
                        </td>
                    </tr>
                @endforelse

                @foreach ($cities as $city)
                    <tr>
                        <th scope="row" class="text-center">{{ $city->id }}</th>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->country->name }}</td>
                        <td class="text-center">
                            {{ $city->manuscripts ? $city->manuscripts->count() : 0 }}
                        </td>
                        <td class="text-center">
                            {{ $city->transcribers ? $city->transcribers->count() : 0 }}
                        </td>
                        <td class="text-center">
                            <a class="btn btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#editCity{{ $city->id }}">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                        @include('cities.edit', $city)

                        <td class="text-center">
                            <form action="{{ Route('cities.destroy', $city->id) }}" method="POST">
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
                {{ $cities->links() }}
            </div>
        </div>
    </fieldset>
@endsection
