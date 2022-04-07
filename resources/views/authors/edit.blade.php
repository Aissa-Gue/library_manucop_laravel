<?php
$page = ['title' => 'تعديل معلومات المؤلف'];
?>

@extends('layouts.app', $page)

@section('content')
    <form action="{{ Route('authors.update', $author->id) }}" method="post">
        @csrf
        @method('PUT')
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات المؤلف</legend>

            <div class="row mb-2">
                <div class="col-md-2">
                    <label for="author" class="form-label">رقم المؤلف</label>
                    <input class="form-control text-center" id="author" value="{{ $author->id }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <label for="author" class="form-label">اسم المؤلف</label>
                    <input name="name" class="form-control @error('name') is-invalid @enderror" id="author"
                        value="{{ old('name') ?? $author->name }}" placeholder="أدخل اسم المؤلف">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> تعديل </button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
