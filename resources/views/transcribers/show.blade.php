<?php
$page = ['title' => 'معلومات الناسخ'];
?>

@extends('layouts.app', $page)

@section('content')

    @if(session()->has('message'))
        @include('includes.alert')
    @endif

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">معلومات الناسخ</legend>
        <div class="row mt-5">
            <div class="col-md-8">
                <dl class="row">
                    <dt class="col-md-auto">الرقم:</dt>
                    <dd class="col-md-auto">{{$transcriber->id}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">الاسم الكامل:</dt>
                    <dd class="col-md-auto">{{$transcriber->full_name}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">اللقب (اسم الشهرة):</dt>
                    <dd class="col-md-auto">{{$transcriber->last_name}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">الكنية:</dt>
                    <dd class="col-md-auto">{{$transcriber->nickname}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">النسب:</dt>
                    <dd class="col-md-auto">
                        {{$transcriber->descent1 ?  $transcriber->descent1 : ''}}
                        {{$transcriber->descent2 ? ' / '.$transcriber->descent2 : ''}}
                        {{$transcriber->descent3 ? ' / '. $transcriber->descent3 : ''}}
                        {{$transcriber->descent4 ? ' / '.$transcriber->descent4 : ''}}
                        {{$transcriber->descent5 ? ' / '.$transcriber->descent5 : ''}}
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto mb-3">صيغ أخرى لاسم الناسخ:</dt>
                    <dd class="col-md-10 offset-1">{{$transcriber->other_name1 ? '- '.$transcriber->other_name1 : ''}}</dd>
                    <dd class="col-md-10 offset-1">{{$transcriber->other_name2 ? '- '.$transcriber->other_name2 : ''}}</dd>
                    <dd class="col-md-10 offset-1">{{$transcriber->other_name3 ? '- '.$transcriber->other_name3 : ''}}</dd>
                    <dd class="col-md-10 offset-1">{{$transcriber->other_name4 ? '- '.$transcriber->other_name4 : ''}}            </dd>
                </dl>
            </div>


            <!--- second column -->
            <div class="col-md-4">
                <dl class="row">
                    <dt class="col-md-auto">المدينة:</dt>
                    <dd class="col-md-auto">{{$transcriber->city ? $transcriber->city->name : ''}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">البلدة:</dt>
                    <dd class="col-md-auto">{{$transcriber->country ? $transcriber->country->name : ''}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">أقدم سنة نسخ:</dt>
                    <dd class="col-md-auto fw-bold text-success">
                        {{$minManu_syear ? $minManu_syear->min_syear .' هجري' : ''}}
                        {{$minManu_syear_m ? ' | '. $minManu_syear_m->min_syear_m .' ميلادي' : ''}}
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">أحدث سنة نسخ:</dt>
                    <dd class="col-md-auto fw-bold text-success">
                        {{$minManu_eyear ? $minManu_eyear->min_eyear .' هجري' : ''}}
                        {{$minManu_eyear_m ? ' | '.$minManu_eyear_m->min_eyear_m .' ميلادي' : ''}}
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">عدد المنسوخات:</dt>
                    <dd class="col-md-auto fw-bold text-danger">{{$transcriber->manuscripts ? $transcriber->manuscripts->count() : 0}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">تاريخ الإضافة:</dt>
                    <dd class="col-md-auto text-success fw-bold">{{$transcriber->created_at}}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-md-auto">تاريخ آخر تعديل:</dt>
                    <dd class="col-md-auto text-primary fw-bold">{{$transcriber->updated_at}}</dd>
                </dl>
            </div>
        </div>


    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">منسوخات الناسخ</legend>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" width="140px" class="text-center">رقم الاستمارة</th>
                    <th scope="col">عنوان الكتاب</th>
                    <th scope="col">النساخ</th>
                </tr>
                </thead>
                <tbody>
                @if ($transcriber->manuscripts && $transcriber->manuscripts->count() > 0)
                    @foreach($transcriber->manuscripts as $manuscript)
                        <tr>
                            <th scope="row" width="140px" class="text-center">{{$manuscript->id}}</th>
                            <td>
                                <a class="text-decoration-none text-dark"
                                   href="{{Route('manuscripts.show',$manuscript->id)}}">{{$manuscript->title}}</a>
                            </td>
                            <td>
                                @foreach($manuscript->transcribers as $transcriber)
                                    <span class="badge rounded-pill bg-primary p-2">
                                    <a href="{{Route('transcribers.show',$transcriber->id)}}"
                                       class="text-decoration-none text-light">{{$transcriber->name}}</a>
                                </span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center fw-bold text-danger p-3">لا زلت لم تدخل استمارات لهذا الناسخ
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </fieldset>
@endsection
