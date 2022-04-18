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
        <h4><i class="fas fa-user-shield fs-5"></i> إدارة المستخدمين </h4>
        <hr>
        <div class="col-md-12 mb-2">

            <div class="col-auto text">
                <button data-bs-toggle="modal" data-bs-target="#createUser" class="btn btn-success"><i
                        class="fas fa-plus"></i> إضافة مستخدم </button>
                @include('settings.users.create')
            </div>
        </div>

        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاسم</th>
                        <th scope="col">اسم المستخدم</th>
                        <th scope="col">نوع الحساب</th>
                        <th scope="col" class="text-center">تعديل</th>
                        <th scope="col" class="text-center">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->is_admin == 1 ? 'مسؤول' : 'مستخدم' }}</td>
                            <td class="text-center">
                                <a class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#editUser{{ $user->id }}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            </td>
                            @include('settings.users.edit', $user)

                            <td class="text-center">
                                <form action="{{ Route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit"
                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
