<?php
$page = ['title' => 'إضافة ناسخ'];

$cityLivewire = [
    'label' => 'المدينة',
    'placeholder' => 'أدخل مدينة الناسخ',
];

$countryLivewire = [
    'label' => 'البلد',
    'placeholder' => 'أدخل بلد الناسخ',
];
?>

@extends('layouts.app', $page)

@section('content')
    <form action="{{ Route('transcribers.store') }}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات الناسخ</legend>

            <div class="row">
                <div class="col-md-8">
                    <label for="full_name" class="form-label">اسم الناسخ</label>
                    <input name="full_name" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                        placeholder="أدخل اسم الناسخ">
                    @error('full_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-2">
                    <label for="descent1" class="form-label">النسبة</label>
                    <input name="descent1" class="form-control @error('descent1') is-invalid @enderror" id="descent1"
                        placeholder="أدخل النسبة 1">
                    @error('descent1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- add input dynamically -->
                <div id="addDescent" class="form-group col-md-auto" style="cursor: pointer; margin-top: 37px;">
                    <i class="fal fa-plus-circle fs-4 text-secondary"></i>
                </div>
                <!-- END add input dynamically -->
            </div>

            <div class="row mt-2">
                <div class="col-md-2">
                    <label for="last_name" class="form-label">اللقب (اسم الشهرة)</label>
                    <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                        placeholder="أدخل لقب الناسخ">
                    @error('last_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="nickname" class="form-label">الكنية</label>
                    <input name="nickname" class="form-control @error('nickname') is-invalid @enderror" id="nickname"
                        placeholder="أدخل كنية الناسخ">
                    @error('nickname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="city_id" value="" id="city_id_hidden">

                    <livewire:city-search :cityLivewire="$cityLivewire" />

                    @error('city_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <input type="hidden" name="country_id" id="country_id_hidden" value="">

                    <livewire:country-search :countryLivewire="$countryLivewire" />

                    @error('country_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="other_name1" class="form-label">صيغ أخرى لاسم الناسخ</label>
                    <input name="other_name1" class="form-control @error('other_name1') is-invalid @enderror"
                        id="other_name1" placeholder="أدخل الصيغة 1">
                    @error('other_name1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- add input dynamically -->
                <div id="addOther_name" class="col-md-auto" style="cursor: pointer; margin-top: 37px;">
                    <i class="fal fa-plus-circle fs-4 text-secondary"></i>
                </div>
                <!-- END add input dynamically -->
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> إضافة</button>
                </div>
            </div>
        </fieldset>
    </form>
    <script src="{{ URL::asset('js/transcribers.js') }}"></script>
@endsection
