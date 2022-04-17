<?php
$page = ['title' => 'الإعدادات'];
$subNavs = [
    [
        'text' => 'قاعدة البيانات',
        'icon' => 'fas fa-database',
        'route' => 'settings.index',
        'request' => 'settings/database',
    ],
    [
        'text' => 'المستخدمين',
        'icon' => 'fas fa-user-shield',
        'route' => 'users.index',
        'request' => 'settings/users',
    ],
];
?>

@extends('layouts.app')

@section('content')
    @include('includes.subNavs', $subNavs)

    @if (session()->has('message'))
        @include('includes.alert')
    @endif

    <div class="row mt-3">
        <div class="col-md-12">
            <h4><i class="fas fa-server fs-5"></i> إدارة قاعدة البيانات</h4>
            <hr>

            <form method="post" action="{{ Route('importDB') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row mb-3">
                    <div class="input-group">
                        <label class="col-md-3">إستيراد نسخة احتياطية (SQL)</label>
                        <div class="custom-file col-md-4">
                            <input type="file" class="form-control" name="db" accept=".sql" id="db" required>
                        </div>
                        <button type="submit" name="importDb" class="btn btn-primary"><i class="fas fa-upload"></i>
                            إستيراد</button>
                    </div>
                </div>
            </form>

            <!-- Third row -->
            <div class="form-group row mb-3">
                <label class="col-md-3">استخراج قاعدة البيانات</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <a href="{{ Route('exportDB') }}" class="btn btn-success"><i class="fas fa-download"></i>
                            استخراج</a>
                    </div>
                </div>
            </div>
            <!-- END Third row -->
            <!-- Forth row -->
            <div class="form-group row mb-3">
                <label class="col-md-3">حذف قاعدة البيانات</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <form action="{{ Route('dropDB') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('احذر ! سيتم حذف جميع البيانات نهائيا !')">
                                <i class="fas fa-trash-alt"></i> حـــــذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Forth row -->
        </div>
    </div>
@endsection
