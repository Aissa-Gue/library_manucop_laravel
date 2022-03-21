<?php
$page = ['title' => 'قائمة الاستمارات'];
?>

@extends('layouts.app', $page)

@section('content')
    <form action="{{Route('manuscripts.index')}}" method="get">
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">بحث</legend>

            <div class="row justify-content-md-center mb-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">رقم الاستمارة</span>
                    </div>
                    <input type="text" name="id" class="form-control"
                           placeholder="أدخل رقم الاستمارة" value="{{request('id')}}">

                    <div class="input-group-prepend">
                        <span class="input-group-text">عنوان الكتاب</span>
                    </div>
                    <input type="text" name="title" class="form-control"
                           placeholder="أدخل عنوان الكتاب" value="{{request('title')}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">بحث</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>

    <!-- </form> -->
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">قائمة الاستمارات</legend>

        <div class="alert alert-warning text-center" role="alert">
            <strong> عدد النتائج = </strong>
            {{$manuscripts->total()}}
        </div>

        @if(session()->has('message'))
            @include('includes.alert')
        @endif

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="text-center">رقم الاستمارة</th>
                <th scope="col">عنوان الكتاب</th>
                <th scope="col" class="text-center">عدد النساخ</th>
                <th scope="col" class="text-center">تفاصيل</th>
                <th scope="col" class="text-center">تعديل</th>
                <th scope="col" class="text-center">حذف</th>
            </tr>
            </thead>

            <tbody>
            @forelse($manuscripts as $manuscript)
            @empty
                <tr>
                    <td class="text-center text-danger fw-bold py-4" colspan="6">
                        <i class="fas fa-exclamation-triangle"></i>
                        لا توجد نتائج مطابقة لـ:
                        <strong class=""> {{request('id')}} {{request('title')}}</strong>
                    </td>
                </tr>
            @endforelse

            @foreach($manuscripts as $manuscript)
                <tr>
                    <th scope="row" class="text-center">{{$manuscript->id}}</th>
                    <td>{{$manuscript->book->title}}</td>
                    <td class="text-center">
                        {{$manuscript->transcribers ? $manuscript->transcribers->count() : 0}}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-outline-success"
                           href="{{Route('manuscripts.show',$manuscript->id)}}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>

                    <td class="text-center">
                        <a class="btn btn-outline-primary"
                           href="{{Route('manuscripts.edit',$manuscript->id)}}">
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
                        <form id="delete" action="{{ Route('manuscripts.destroy',$manuscript->id) }}" method="POST" class="d-none">
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
                {{$manuscripts->links()}}
            </div>
        </div>
    </fieldset>
@endsection
