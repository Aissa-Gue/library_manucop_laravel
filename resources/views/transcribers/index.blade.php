<?php
$page = ['title' => 'قائمة النساخ'];
?>

@extends('layouts.app', $page)

@section('content')
    <form action="{{Route('transcribers.index')}}" method="get">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">بحث</legend>

            <div class="row justify-content-md-center mb-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">رقم الناسخ</span>
                    </div>
                    <input type="text" name="id" class="form-control"
                           placeholder="أدخل رقم الناسخ" value="{{request('id')}}">

                    <div class="input-group-prepend">
                        <span class="input-group-text">اسم الناسخ</span>
                    </div>
                    <input type="text" name="full_name" class="form-control"
                           placeholder="أدخل اسم الناسخ" value="{{request('full_name')}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">بحث</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>

    <!-- </form> -->
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">قائمة النساخ</legend>

        <div class="alert alert-warning text-center" role="alert">
            <strong> عدد النتائج = </strong>
            {{$transcribers->total()}}
        </div>

        @if(session()->has('message'))
            @include('includes.alert')
        @endif

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="text-center">رقم الناسخ</th>
                <th scope="col">الاسم</th>
                <th scope="col">اللقب</th>
                <th scope="col" class="text-center">عدد المنسوخات</th>
                <th scope="col" class="text-center">تفاصيل</th>
                <th scope="col" class="text-center">تعديل</th>
                <th scope="col" class="text-center">حذف</th>
            </tr>
            </thead>

            <tbody>
            @forelse($transcribers as $transcriber)
            @empty
                <tr>
                    <td class="text-center text-danger fw-bold py-4" colspan="7">
                        <i class="fas fa-exclamation-triangle"></i>
                        لا توجد نتائج مطابقة لـ:
                        <strong class=""> {{request('id')}} {{request('full_name')}}</strong>
                    </td>
                </tr>
            @endforelse

            @foreach($transcribers as $transcriber)
                <tr>
                    <th scope="row" class="text-center">{{$transcriber->id}}</th>
                    <td>{{$transcriber->full_name}}</td>
                    <td>{{$transcriber->last_name}}</td>
                    <td class="text-center">
                        {{$transcriber->manuscripts ? $transcriber->manuscripts->count() : 0}}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-outline-success"
                           href="{{Route('transcribers.show',$transcriber->id)}}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>

                    <td class="text-center">
                        <a class="btn btn-outline-primary"
                           href="{{Route('transcribers.edit',$transcriber->id)}}">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>

                    <td class="text-center">
                        <a class="btn btn-outline-danger"
                           href="#"
                           onclick="confirm('هل أنت متأكد؟');
                           event.preventDefault();
                           document.getElementById('delete').submit();">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <form id="delete" action="{{ Route('transcribers.destroy',$transcriber->id) }}" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row justify-content-center fixed-bottom">
            <div class="offset-2 col-md-auto">
                {{$transcribers->links()}}
            </div>
        </div>
    </fieldset>
@endsection
