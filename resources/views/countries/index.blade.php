<?php
$page = ['title' => 'قائمة البلدان'];

?>
@extends('layouts.app', $page)

@section('content')
    @include('countries.create')

    @if(session()->has('message'))
        @include('includes.alert')
    @endif

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">قائمة البلدان</legend>

        <form action="{{Route('countries.index')}}" method="get">
            <div class="row justify-content-md-center">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">رقم البلد</span>
                    </div>
                    <input type="text" name="id" class="form-control"
                           placeholder="أدخل رقم البلد" value="{{request('id')}}">

                    <div class="input-group-prepend">
                        <span class="input-group-text">اسم البلد</span>
                    </div>
                    <input type="text" name="name" class="form-control"
                           placeholder="أدخل اسم البلد" value="{{request('name')}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">بحث</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- </form> -->


        <div class="alert alert-warning text-center mt-3" role="alert">
            <strong> عدد النتائج = </strong>
            {{$countries->total()}}
        </div>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="text-center">رقم البلد</th>
                <th scope="col">اسم البلد</th>
                <th scope="col" class="text-center">عدد المنسوخات</th>
                <th scope="col" class="text-center">عدد الناسخين</th>
                <th scope="col" class="text-center">تعديل</th>
                <th scope="col" class="text-center">حذف</th>
            </tr>
            </thead>

            <tbody>
            @forelse($countries as $country)
            @empty
                <tr>
                    <td class="text-center text-danger fw-bold py-4" colspan="7">
                        <i class="fas fa-exclamation-triangle"></i>
                        لا توجد نتائج مطابقة لـ:
                        <strong class=""> {{request('id')}} {{request('name')}}</strong>
                    </td>
                </tr>
            @endforelse

            @foreach($countries as $country)
                <tr>
                    <th scope="row" class="text-center">{{$country->id}}</th>
                    <td>{{$country->name}}</td>
                    <td class="text-center">
                        {{$country->manuscripts ? $country->manuscripts->count() : 0}}
                    </td>
                    <td class="text-center">
                        {{$country->transcribers ? $country->transcribers->count() : 0}}
                    </td>

                    <td class="text-center">
                        <a class="btn btn-outline-primary" data-bs-toggle="modal"
                           data-bs-target="#editCountry{{$country->id}}">
                            <i class="fas fa-pen"></i>
                        </a>
                    </td>
                    @include('countries.edit',$country)

                    <td class="text-center">
                        <a class="btn btn-outline-danger"
                           href="#"
                           onclick="confirm('هل أنت متأكد؟');
                           event.preventDefault();
                           document.getElementById('delete').submit();">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                    <form id="delete" action="{{ Route('countries.destroy',$country->id) }}" method="POST"
                          class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row justify-content-center fixed-bottom">
            <div class="offset-2 col-md-auto">
                {{$countries->links()}}
            </div>
        </div>
    </fieldset>
@endsection
