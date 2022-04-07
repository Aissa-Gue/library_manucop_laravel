<?php
$page = ['title' => 'تعديل معلومات الناسخ'];

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
    <form action="{{ Route('transcribers.update', $transcriber->id) }}" method="post">
        @csrf
        @method('PUT')
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات الناسخ</legend>

            <div class="row">
                <div class="col-md-2">
                    <label for="id" class="form-label">الرقم</label>
                    <input class="form-control text-center" id="id" value="{{ $transcriber->id }}" readonly>
                </div>
                <div class="col-md-8">
                    <label for="full_name" class="form-label">اسم الناسخ</label>
                    <input name="full_name" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                        value="{{ old('full_name') ?? $transcriber->full_name }}" placeholder="أدخل اسم الناسخ">
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
                        value="{{ old('descent1') ?? $transcriber->descent1 }}" placeholder="أدخل النسبة 1">
                    @error('descent1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if ($transcriber->descent2 != null)
                    <script>
                        var a = 3
                    </script>
                    <div class="col-md-2">
                        <label for="descent2" class="form-label">النسبة</label>
                        <input name="descent2" class="form-control @error('descent2') is-invalid @enderror" id="descent2"
                            value="{{ old('descent2') ?? $transcriber->descent2 }}" placeholder="أدخل النسبة 2">
                        @error('descent2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                @if ($transcriber->descent3 != null)
                    <script>
                        var a = 4
                    </script>
                    <div class="col-md-2">
                        <label for="descent3" class="form-label">النسبة</label>
                        <input name="descent3" class="form-control @error('descent3') is-invalid @enderror" id="descent3"
                            value="{{ old('descent3') ?? $transcriber->descent3 }}" placeholder="أدخل النسبة 3">
                        @error('descent3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                @if ($transcriber->descent4 != null)
                    <script>
                        var a = 5
                    </script>
                    <div class="col-md-2">
                        <label for="descent4" class="form-label">النسبة</label>
                        <input name="descent4" class="form-control @error('descent4') is-invalid @enderror" id="descent4"
                            value="{{ old('descent4') ?? $transcriber->descent4 }}" placeholder="أدخل النسبة 4">
                        @error('descent4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                @if ($transcriber->descent5 != null)
                    <script>
                        var a = 6
                    </script>
                    <div class="col-md-2">
                        <label for="descent5" class="form-label">النسبة</label>
                        <input name="descent5" class="form-control @error('descent5') is-invalid @enderror" id="descent5"
                            value="{{ old('descent5') ?? $transcriber->descent5 }}" placeholder="أدخل النسبة 5">
                        @error('descent5')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
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
                        value="{{ old('last_name') ?? $transcriber->last_name }}" placeholder="أدخل لقب الناسخ">
                    @error('last_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="nickname" class="form-label">الكنية</label>
                    <input name="nickname" class="form-control @error('nickname') is-invalid @enderror" id="nickname"
                        value="{{ old('nickname') ?? $transcriber->nickname }}" placeholder="أدخل كنية الناسخ">
                    @error('nickname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="city_id" value="{{ old('city_id') ?? $transcriber->city_id }}"
                        id="city_id_hidden">

                    <livewire:city-search :cityLivewire="$cityLivewire" />
                    @if (old('city_id'))
                        <script>
                            $(document).ready(function() {
                                $('#city').val('{{ old('city_name') }}');
                            });
                        </script>
                    @elseif($transcriber->city)
                        <script>
                            $(document).ready(function() {
                                $('#city').val('{{ $transcriber->city->name }}');
                            });
                        </script>
                    @endif
                    @error('city_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <input type="hidden" name="country_id" id="country_id_hidden"
                        value="{{ old('country_id') ?? $transcriber->country_id }}">

                    <livewire:country-search :countryLivewire="$countryLivewire" />
                    @if (old('country_id'))
                        <script>
                            $(document).ready(function() {
                                $('#country').val('{{ old('country_name') }}');
                            });
                        </script>
                    @elseif($transcriber->country)
                        <script>
                            $(document).ready(function() {
                                $('#country').val('{{ $transcriber->country->name }}');
                            });
                        </script>
                    @endif
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
                        id="other_name1" placeholder="أدخل الصيغة 1"
                        value="{{ old('other_name1') ?? $transcriber->other_name1 }}">
                    @error('other_name1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if ($transcriber->other_name2 != null)
                    <script>
                        var b = 3
                    </script>
                    <div class="col-md-8">
                        <input name="other_name2" class="form-control mt-2 @error('other_name2') is-invalid @enderror"
                            id="other_name2" placeholder="أدخل الصيغة 2"
                            value="{{ old('other_name2') ?? $transcriber->other_name2 }}">
                        @error('other_name2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                @if ($transcriber->other_name3 != null)
                    <script>
                        var b = 4
                    </script>
                    <div class="col-md-8">
                        <input name="other_name3" class="form-control mt-2 @error('other_name3') is-invalid @enderror"
                            id="other_name3" placeholder="أدخل الصيغة 3"
                            value="{{ old('other_name3') ?? $transcriber->other_name3 }}">
                        @error('other_name3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                @if ($transcriber->other_name4 != null)
                    <script>
                        var b = 5
                    </script>
                    <div class="col-md-8">
                        <input name="other_name4" class="form-control mt-2 @error('other_name4') is-invalid @enderror"
                            id="other_name4" placeholder="أدخل الصيغة 4"
                            value="{{ old('other_name4') ?? $transcriber->other_name4 }}">
                        @error('other_name4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                <!-- add input dynamically -->
                <div id="addOther_name" class="col-md-auto" style="cursor: pointer; margin-top: 37px;">
                    <i class="fal fa-plus-circle fs-4 text-secondary"></i>
                </div>
                <!-- END add input dynamically -->
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> تعديل </button>
                </div>
            </div>
        </fieldset>
    </form>
    <script src="{{ URL::asset('js/transcribers.js') }}"></script>
@endsection
