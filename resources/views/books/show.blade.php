<?php
$page = ['title' => 'معلومات الكتاب'];
?>

@extends('layouts.app', $page)

@section('content')

    @if(session()->has('message'))
        @include('includes.alert')
    @endif

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">معلومات الكتاب</legend>
        <dl class="row mt-5">
            <dt class="col-md-auto">الرقم:</dt>
            <dd class="col-md-auto">{{$book->id}}</dd>
        </dl>
        <dl class="row">
            <dt class="col-md-auto">العنوان:</dt>
            <dd class="col-md-auto">{{$book->title}}</dd>
        </dl>
        <dl class="row">
            <dt class="col-md-12">المؤلفين:</dt>
            @foreach($book->authors as $author)
                <dd class="col-md-11 offset-1">{{$author->name}}</dd>
            @endforeach
        </dl>
        <dl class="row">
            <dt class="col-md-auto">المواضيع:</dt>
            @foreach($book->subjects as $subject)
                <dd class="badge rounded-pill bg-primary mx-1 p-2 col-md-auto">{{$subject->name}}</dd>
            @endforeach
        </dl>
        <dl class="row">
            <dt class="col-md-auto">تاريخ الإضافة:</dt>
            <dd class="col-md-auto text-success fw-bold">{{$book->created_at}}</dd>
        </dl>
        <dl class="row">
            <dt class="col-md-auto">تاريخ آخر تعديل:</dt>
            <dd class="col-md-auto text-primary fw-bold">{{$book->updated_at}}</dd>
        </dl>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">منسوخات الكتاب</legend>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" width="140px" class="text-center">رقم الاستمارة</th>
                    <th scope="col">قائمة النساخ</th>
                </tr>
                </thead>

                <tbody>
                @if (is_array($book->manuscripts) || is_object($book->manuscripts))
                    @foreach($book->manuscripts as $manuscript)
                        <tr>
                            <th scope="row" width="140px" class="text-center">
                                <a href="{{Route('manuscripts.show',$manuscript->id)}}" class="text-decoration-none text-dark">{{$manuscript->id}}</a>
                            </th>
                            <td>
                                @foreach($manuscript->transcribers as $transcriber)
                                    <span class="badge rounded-pill bg-primary p-2">
                                        <a href="{{Route('transcribers.show',$transcriber->id)}}" class="text-decoration-none text-light">{{$transcriber->name}}</a>
                                    </span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="text-center fw-bold text-danger p-3">لا توجد منسوخات لهذا الكتاب حاليا
                        </td>
                    </tr>
                @endif
                </tbody>

            </table>
        </div>
    </fieldset>
@endsection
