<?php
$page = ['title' => 'إضافة استمارة'];

// days List
$days = array("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");

//months List
$months = array("محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأولى", "جمادى الثانية", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة",);
$months_m = array("جانفي", "فيفري", "مارس", "أفريل", "ماي", "جوان", "جويلية", "أوت", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر");

//font styles List
$w_font_styles = array("المبسوط", "المجوهر", "المسند (الزمامي)", "المدمج", "الثلث المغربي", "الكوفي المغربي",);
$e_font_styles = array("النسخ", "الثلث", "الكوفي", "التعليق", "الديواني", "الرقعة");

//Livewires
$bookLivewire =
    [
        'label' => 'عنوان الكتاب',
        'placeholder' => 'أدخل عنوان الكتاب',
    ];

$cityLivewire =
    [
        'label' => 'المدينة',
        'placeholder' => 'حدد مدينة النسخ',
    ];

$countryLivewire =
    [
        'label' => 'البلد حاليا',
        'placeholder' => 'أدخل بلد النسخ',
    ];

$cabinetLivewire =
    [
        'label' => 'اسم الخزانة',
        'placeholder' => 'حدد اسم الخزانة',
    ];
?>

@extends('layouts.app', $page)

@section('content')

    @if(session()->has('message'))
        @include('includes.alert')
    @endif

    <form action="{{Route('manuscripts.store')}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات الناسخ</legend>

            <livewire:transcriber-search/>

            <!-- add input dynamically -->
            <div class="row justify-content-md-center mt-4">
                <div class="col-md-auto btn btn-sm btn-primary"
                     id="addTranscriber"><i class="fas fa-plus"></i>
                    إضافة ناسخ
                </div>
            </div>

            <!-- END add input dynamically -->
        </fieldset>


        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات النسخة</legend>

            <div class="row">
                <div class="col-md-9">
                    <livewire:book-search :bookLivewire="$bookLivewire"/>
                    @error('book_id')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="book_part" class="form-label">الجزء</label>
                    <input type="number" class="form-control text-center @error('book_part') is-invalid @enderror"
                           name="book_part" id="book_part"
                           placeholder="أدخل جزء الكتاب"
                           value="{{old('book_part')}}">
                    @error('book_part')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2" id="transDate_exact">
                <div class="col-md-2">
                    <label for="trans_day" class="form-label">تاريخ النسخ</label>
                    <select name="trans_day" id="trans_day"
                            class="form-select @error('trans_day') is-invalid @enderror">
                        <option value="" selected>-أدخل اليوم-</option>
                        @for($i = 0; $i <= 6; $i++)
                            <option value="{{$i+1}}" @if(old('trans_day')== $i+1) selected @endif>
                                {{$days[$i]}}
                            </option>
                        @endfor
                    </select>
                    @error('trans_day')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="trans_day_nbr" class="form-label">&nbsp;</label>
                    <select name="trans_day_nbr" id="trans_day_nbr"
                            class="form-select @error('trans_day_nbr') is-invalid @enderror">
                        <option value="" selected>- أدخل اليوم -</option>
                        @for($i = 1; $i <= 31; $i++)
                            <option value="{{$i}}" @if(old('trans_day_nbr')== $i) selected @endif>
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                    @error('trans_day_nbr')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="trans_month" class="form-label">&nbsp;</label>
                    <select name="trans_month" id="trans_month"
                            class="form-select @error('trans_month') is-invalid @enderror">
                        <option value="" selected>-أدخل الشهر-</option>
                        @for($i = 0; $i <= 11; $i++)
                            <option value="{{$i+1}}" @if(old('trans_month')== $i+1) selected @endif>
                                {{$months[$i]}}
                            </option>
                        @endfor
                    </select>
                    @error('trans_month')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="trans_syear" class="form-label">&nbsp;</label>
                    <input type="number" class="form-control @error('trans_syear') is-invalid @enderror"
                           name="trans_syear" id="trans_syear"
                           placeholder="أدخل السنة"
                           value="{{old('trans_syear')}}">
                    @error('trans_syear')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2 mt-2">
                    <label for="date_type" class="form-label">&nbsp;</label>
                    <p>[هجري]</p>
                </div>
            </div>

            <!-- START Miladi date -->
            <div class="row" id="transDate_exact_m">
                <div class="offset-2 col-md-2">
                    <select name="trans_day_nbr_m" id="trans_day_nbr"
                            class="form-select @error('trans_day_nbr_m') is-invalid @enderror">
                        <option value="" selected>- أدخل اليوم -</option>
                        @for($i = 1; $i <= 31; $i++)
                            <option value="{{$i}}" @if(old('trans_day_nbr_m')== $i) selected @endif>
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                    @error('trans_day_nbr_m')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <select name="trans_month_m" id="trans_month"
                            class="form-select @error('trans_month_m') is-invalid @enderror">
                        <option value="" selected>-أدخل الشهر-</option>
                        @for($i = 0; $i <= 11; $i++)
                            <option value="{{$i+1}}" @if(old('trans_month_m')== $i+1) selected @endif>
                                {{$months_m[$i]}}
                            </option>
                        @endfor
                    </select>
                    @error('trans_month_m')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control @error('trans_syear_m') is-invalid @enderror"
                           name="trans_syear_m" id="trans_syear"
                           placeholder="أدخل السنة"
                           value="{{old('trans_syear_m')}}">
                    @error('trans_syear_m')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2 mt-2">
                    <p>[ميلادي]</p>
                </div>
            </div>
            <!-- END miladi date -->

            <!--Hijri date range-->
            <div class="row mt-2" id="transDate_range">
                <div class="col-md-auto">
                    <label for="trans_syear" class="form-label">تاريخ النسخ [أدخل نطاق]</label>
                    <input type="number" class="form-control @error('trans_syear') is-invalid @enderror"
                           name="trans_syear" id="trans_date"
                           placeholder="من سنة"
                           value="{{old('trans_syear')}}">
                    @error('trans_syear')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-auto">
                    <label for="trans_eyear" class="form-label">&nbsp;</label>
                    <input type="number" class="form-control @error('trans_eyear') is-invalid @enderror"
                           name="trans_eyear" id="trans_date"
                           placeholder="إلى سنة"
                           value="{{old('trans_eyear')}}">
                    @error('trans_eyear')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2 mt-2">
                    <label for="date_type" class="form-label">&nbsp;</label>
                    <p>[هجري]</p>
                </div>
            </div>
            <!--END Hijri date range -->

            <!--miladi date range-->
            <div class="row" id="transDate_range_m">
                <div class="col-md-auto">
                    <input type="number" class="form-control @error('trans_syear_m') is-invalid @enderror"
                           name="trans_syear_m" id="trans_date"
                           placeholder="من سنة"
                           value="{{old('trans_syear_m')}}">
                    @error('trans_syear_m')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-auto">
                    <input type="number" class="form-control @error('trans_eyear_m') is-invalid @enderror"
                           name="trans_eyear_m" id="trans_date"
                           placeholder="إلى سنة"
                           value="{{old('trans_eyear_m')}}">
                    @error('trans_eyear_m')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-2 mt-2">
                    <p>[ميلادي]</p>
                </div>
            </div>
            <!--END miladi date range -->

            <div class="mb-2">
                <button type="button" class="btn btn-sm btn-primary rounded-pill" id="hide_Exact">تاريخ
                    محدد
                </button>
                <button type="button" class="btn btn-sm btn-primary rounded-pill" id="hide_range">فترة
                    زمنية
                </button>
            </div>


            <div class="row mt-2">
                <div class="col-md-5">
                    <label for="trans_place" class="form-label">مكان النسخ</label>
                    <input name="trans_place" class="form-control @error('trans_place') is-invalid @enderror"
                           id="trans_place"
                           placeholder="أدخل مكان النسخ"
                           value="{{old('trans_place')}}">
                    @error('trans_place')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <livewire:city-search :cityLivewire="$cityLivewire"/>
                    @error('city_id')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <livewire:country-search :countryLivewire="$countryLivewire"/>
                    @error('country_id')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label class="form-label">موقعة أو بالمقارنة؟</label>
                    <select name="signed_in" id="signed_in"
                            class="form-select @error('signed_in') is-invalid @enderror">
                        <option value="" selected>-حدد خيار-</option>
                        <option value="1" @if(old('signed_in')== '1') selected @endif>موقعة</option>
                        <option value="0" @if(old('signed_in')== '0') selected @endif>بالمقارنة</option>
                    </select>
                    @error('signed_in')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="nbr_in_index" class="form-label">الرقم في الفهرس</label>
                    <input name="nbr_in_index"
                           class="form-control @error('nbr_in_index') is-invalid @enderror text-center"
                           id="nbr_in_index"
                           type="number"
                           placeholder="أدخل الرقم في الفهرس"
                           value="{{old('nbr_in_index')}}">
                    @error('nbr_in_index')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-7">
                    <livewire:cabinet-search :cabinetLivewire="$cabinetLivewire"/>
                    @error('cabinet_id')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-auto">
                    <label for="nbr_in_cabinet" class="form-label">الرقم في الخزانة</label>
                    <input type="number" class="form-control @error('nbr_in_cabinet') is-invalid @enderror text-center"
                           name="nbr_in_cabinet" id="nbr_in_cabinet"
                           placeholder="أدخل الرقم في الخزانة"
                           value="{{old('nbr_in_cabinet')}}">
                    @error('nbr_in_cabinet')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-auto">
                    <label for="manu_type" class="form-label">نوع النسخة</label>
                    <select name="manu_type" id="manu_type"
                            class="form-select @error('manu_type') is-invalid @enderror">
                        <option value="" selected>-اختر نوع النسخة-</option>
                        <option value="مج" @if(old('manu_type')== 'مج') selected @endif>مجلد</option>
                        <option value="مص" @if(old('manu_type')== 'مص') selected @endif>مصحف</option>
                        <option value="دغ" @if(old('manu_type')== 'دغ') selected @endif>دون غلاف</option>
                    </select>
                    @error('manu_type')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <h5 class="my_line"><span>الوصف المادي</span></h5>

            <div class="row mt-2">
                <div class="col-md-2">
                    <label for="font" class="form-label">الخط</label>
                    <select name="font" id="font" class="form-select @error('font') is-invalid @enderror">
                        <option value="" selected>- اختر خط -</option>
                        <option value="مغربي" @if(old('font')== 'مغربي') selected @endif>مغربي</option>
                        <option value="مشرقي" @if(old('font')== 'مشرقي') selected @endif>مشرقي</option>
                    </select>
                    @error('font')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="font_style" class="form-label">نوع الخط</label>
                    <select name="font_style" id="font_style"
                            class="form-select @error('font_style') is-invalid @enderror">
                        <option value="" selected>- اختر نوع الخط -</option>
                        @foreach ($w_font_styles as $w_font_style)
                            <option value="{{$w_font_style}}" @if(old('font_style') == $w_font_style) selected @endif>
                                {{$w_font_style}}
                            </option>
                        @endforeach
                    </select>
                    @error('font_style')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-auto">
                    <label for="transcriber_level" class="form-label">مستوى النسخة من حيث الوضوح والرداءة</label>
                    <select name="transcriber_level" id="transcriber_level"
                            class="form-select @error('transcriber_level') is-invalid @enderror">
                        <option value="" selected>- حدد مستوى -</option>
                        <option value="جيدة" @if(old('transcriber_level') == 'جيدة') selected @endif>جيدة</option>
                        <option value="حسنة" @if(old('transcriber_level') == 'حسنة') selected @endif>حسنة</option>
                        <option value="متوسطة" @if(old('transcriber_level') == 'متوسطة') selected @endif>متوسطة</option>
                        <option value="رديئة" @if(old('transcriber_level') == 'رديئة') selected @endif>رديئة</option>
                    </select>
                    @error('transcriber_level')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="paper_size" class="form-label">مقاس الورق</label>
                    <select name="paper_size" id="paper_size"
                            class="form-select @error('paper_size') is-invalid @enderror">
                        <option value="" selected>- اختر مقاس الورق -</option>
                        <option value="1" @if(old('paper_size') == 1) selected @endif>القطع الكبير</option>
                        <option value="2" @if(old('paper_size') == 2) selected @endif>القطع المتوسط</option>
                        <option value="3" @if(old('paper_size') == 3) selected @endif>القطع الصغير</option>
                    </select>
                    @error('paper_size')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="size_notes" class="form-label">ملاحظات على المقاس</label>
                    <input type="text" class="form-control @error('size_notes') is-invalid @enderror" name="size_notes"
                           id="size_notes"
                           placeholder="أدخل ملاحظات المقاس"
                           value="{{old('size_notes')}}">
                    @error('size_notes')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="regular_lines" class="form-label">المسطرة</label>
                    <select name="regular_lines" id="regular_lines"
                            class="form-select @error('regular_lines') is-invalid @enderror">
                        <option value="" selected>- حدد خيار -</option>
                        <option value="1" @if(old('regular_lines') == '1') selected @endif>منتظمة</option>
                        <option value="0" @if(old('regular_lines') == '0') selected @endif>غير منتظمة</option>
                    </select>
                    @error('regular_lines')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="lines_notes" class="form-label">ملاحظات على المسطرة</label>
                    <input type="text" class="form-control @error('lines_notes') is-invalid @enderror"
                           name="lines_notes" id="lines_notes"
                           placeholder="أدخل ملاحظات المسطرة"
                           value="{{old('lines_notes')}}">
                    @error('lines_notes')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="is_truncated" class="form-label">التمام والبتر</label>
                    <select name="is_truncated" id="is_truncated"
                            class="form-select @error('is_truncated') is-invalid @enderror">
                        <option value="" selected>- حدد خيار -</option>
                        <option value="1" @if(old('is_truncated') == '1') selected @endif>تامة</option>
                        <option value="0" @if(old('is_truncated') == '0') selected @endif>مبتورة</option>
                    </select>
                    @error('is_truncated')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="truncation_notes" class="form-label">مكان البتر</label>
                    <input type="text" class="form-control @error('truncation_notes') is-invalid @enderror"
                           name="truncation_notes" id="truncation_notes"
                           placeholder="أدخل مكان البتر"
                           value="{{old('truncation_notes')}}">
                    @error('truncation_notes')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="nbr_of_papers" class="form-label">عدد الصفحات</label>
                    <input name="nbr_of_papers"
                           class="form-control @error('nbr_of_papers') is-invalid @enderror text-center"
                           id="nbr_of_papers"
                           type="number"
                           placeholder="أدخل عدد الصفحات"
                           value="{{old('nbr_of_papers')}}">
                    @error('nbr_of_papers')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="save_status" class="form-label">حالة الحفظ</label>
                    <select name="save_status" id="save_status"
                            class="form-select @error('save_status') is-invalid @enderror">
                        <option value="" selected>- حدد مستوى -</option>
                        <option value="حسنة" @if(old('save_status') == 'حسنة') selected @endif>حسنة</option>
                        <option value="متوسطة" @if(old('save_status') == 'متوسطة') selected @endif>متوسطة</option>
                        <option value="رديئة" @if(old('save_status') == 'رديئة') selected @endif>رديئة</option>
                        <option value="من حسنة إلى متوسطة"
                                @if(old('save_status') == 'من حسنة إلى متوسطة') selected @endif>من حسنة إلى متوسطة
                        </option>
                        <option value="من متوسطة إلى رديئة"
                                @if(old('save_status') == 'من متوسطة إلى رديئة') selected @endif>من متوسطة إلى رديئة
                        </option>

                    </select>
                    @error('save_status')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-5">
                    <label for="motif_ids" class="form-label">الزخارف المستعملة</label>
                    <select class="form-select @error('motif_ids.*') is-invalid @enderror" name="motif_ids[]"
                            id="motif_ids" multiple>
                        <option>حدد زخرفة</option>
                        @foreach($motifs as $motif)
                            <option value="{{$motif->id}}">{{$motif->name}}</option>
                        @endforeach
                    </select>
                    @error('motif_ids.*')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-5">
                    <label for="color_ids" class="form-label">ألوان الحبر المستعملة</label>
                    <select class="form-select @error('color_ids.*') is-invalid @enderror" name="color_ids[]"
                            id="color_ids"
                            multiple>
                        <option>حدد لون</option>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}">{{$color->name}}</option>
                        @endforeach
                    </select>
                    @error('color_ids.*')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>


            <h5 class="my_line"><span>عمل الناسخ ومستوى النسخة</span></h5>

            <div class="row mt-2">
                <div class="col-md-5">
                    <label for="manutype_ids" class="form-label">عمل الناسخ عدا نقل المحتوى</label>
                    <select class="form-select @error('manutype_ids.*') is-invalid @enderror" name="manutype_ids[]"
                            id="manutype_ids" multiple>
                        <option>حدد خيار</option>
                        @foreach($manutypes as $manutype)
                            <option value="{{$manutype->id}}">{{$manutype->name}}</option>
                        @endforeach
                    </select>
                    @error('manutype_ids.*')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-auto">
                    <label for="manuscript_level" class="form-label">مستوى النسخة من حيث الجودة والضبط</label>
                    <select name="manuscript_level" id="manuscript_level"
                            class="form-select @error('manuscript_level') is-invalid @enderror">
                        <option value="" selected>- حدد مستوى -</option>
                        <option value="جيدة" @if(old('manuscript_level') == 'جيدة') selected @endif>جيدة</option>
                        <option value="حسنة" @if(old('manuscript_level') == 'حسنة') selected @endif>حسنة</option>
                        <option value="متوسطة" @if(old('manuscript_level') == 'متوسطة') selected @endif>متوسطة</option>
                        <option value="رديئة" @if(old('manuscript_level') == 'رديئة') selected @endif>رديئة</option>
                    </select>
                    @error('manuscript_level')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <h5 class="my_line"><span>الملاحظات</span></h5>

            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="transcribed_from" class="form-label">الأصل المنسوخ منه</label>
                    <input type="text" class="form-control @error('transcribed_from') is-invalid @enderror"
                           name="transcribed_from" id="transcribed_from"
                           placeholder="أدخل الأصل المنسوخ منه"
                           value="{{old('transcribed_from')}}">
                    @error('transcribed_from')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="transcribed_to" class="form-label">المنسوخ له</label>
                    <input type="text" class="form-control @error('transcribed_to') is-invalid @enderror"
                           name="transcribed_to" id="transcribed_to"
                           placeholder="أدخل المنسوخ له بأوصافه"
                           value="{{old('transcribed_to')}}">
                    @error('transcribed_to')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="rost_completion" class="form-label">ترميم وإتمام</label>
                    <select name="rost_completion" id="rost_completion"
                            class="form-select @error('rost_completion') is-invalid @enderror">
                        <option value="" selected>- اختر خيار -</option>
                        <option value="1" @if(old('rost_completion') == '1') selected @endif>نعم</option>
                        <option value="0" @if(old('rost_completion') == '0') selected @endif>لا</option>
                    </select>
                    @error('rost_completion')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-7">
                    <label for="notes" class="form-label">ملاحظات أخرى</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" rows="3"
                              placeholder="أدخل ملاحظات أخرى">{{old('notes')}}</textarea>
                    @error('notes')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">إضافة الاستمارة</button>
                </div>
            </div>
        </fieldset>
    </form>

    <script>
        //************ add Transcriber Info JS ************//
        $(document).ready(function () {
            $('#transcriber1').select2();
            $('#fontMatcher1').select2();
            $('#transcriber1').val(null).trigger('change');//delete selection
            $('#fontMatcher1').val(null).trigger('change');//delete selection

            //set default value to null for other transcribers
            $('#transcriber2').val(null).trigger('change');//delete selection
            $('#fontMatcher2').val(null).trigger('change');//delete selection

            $('#transcriber3').val(null).trigger('change');//delete selection
            $('#fontMatcher3').val(null).trigger('change');//delete selection

            $('#transcriber4').val(null).trigger('change');//delete selection
            $('#fontMatcher4').val(null).trigger('change');//delete selection
        });
        var a = 2;

        function displayNewTranscriber(transcriber) {
            //var transcriberInfo = $('#transcriberInfo').clone();
            //transcriberInfo.appendTo('#transcriberBlock');
            if (a == 2 || transcriber == 2) {
                $('#transcriberInfo2').removeClass('d-none');
                $('#transcriber2').select2();
                $('#fontMatcher2').select2();
            }
            if (a == 3 || transcriber == 3) {
                $('#transcriberInfo3').removeClass('d-none');
                $('#transcriber3').select2();
                $('#fontMatcher3').select2();
            }
            if (a == 4 || transcriber == 4) {
                $('#transcriberInfo4').removeClass('d-none');
                $('#transcriber4').select2();
                $('#fontMatcher4').select2();
            }
            // delete add icon
            if (a == 4 || transcriber == 4) $("#addTranscriber").remove();
        }

        $("#addTranscriber").click(function () {
            displayNewTranscriber();
            a++;
        });


        //************ Switch between transDate range/exact ************//
        $("#transDate_range").hide();
        $("#transDate_range_m").hide();

        function hideExact() {
            $("#transDate_exact").show(400);
            $("#transDate_exact_m").show(400);
            $("#transDate_range").hide(400);
            $("#transDate_range_m").hide(400);

            $("#transDate_range input").val(null);
            $("#transDate_range_m input").val(null);
        }

        function hide_range() {
            $("#transDate_range").show(400);
            $("#transDate_range_m").show(400);
            $("#transDate_exact").hide(400);
            $("#transDate_exact_m").hide(400);

            $("#transDate_exact input").val(null);
            $("#transDate_exact select").prop('selectedIndex', 0);
            $("#transDate_exact_m input").val(null);
            $("#transDate_exact_m select").prop('selectedIndex', 0);
        }

        $(document).ready(function () {
            $("#hide_Exact").click(function () {
                hideExact();
            });
            $("#hide_range").click(function () {
                hide_range();
            });
        });

        //************ motifs ************//
        $(document).ready(function () {
            $('#motif_ids').select2();
            $('#motif_ids').val(null).trigger('change');//delete selection
        });

        //************ colors ************//
        $(document).ready(function () {
            $('#color_ids').select2();
            $('#color_ids').val(null).trigger('change');//delete selection
        });

        //************ manutypes ************//
        $(document).ready(function () {
            $('#manutype_ids').select2();
            $('#manutype_ids').val(null).trigger('change');//delete selection
        });
    </script>


    <!-- restore old input values when validation failed --->
    <script>
        $(document).ready(function () {
            //***** 1st transcriber
            @if(old('transcriber_id1'))
            $('#transcriber1').val('{{old('transcriber_id1')}}');
            $('#transcriber1').trigger('change');
            @endif
            @if(old('name_in_manu1'))
            $('#name_in_manu1').val('{{old('name_in_manu1')}}');
            @endif
            @if(old('fontMatchers1'))
            $('#fontMatcher1').val(
                <?php
                echo '[';
                foreach (old('fontMatchers1') as $fontMatcher) {
                    echo $fontMatcher . ',';
                }
                echo ']';
                ?>
            );
            $('#fontMatcher1').trigger('change');
            @endif

            //***** 2nd transcriber
            @if(old('transcriber_id2'))
            $('#transcriber2').val('{{old('transcriber_id2')}}');
            $('#transcriber2').trigger('change');
            @endif
            @if(old('name_in_manu2'))
            $('#name_in_manu2').val('{{old('name_in_manu2')}}');
            @endif
            @if(old('fontMatchers2'))
            $('#fontMatcher2').val(
                <?php
                echo '[';
                foreach (old('fontMatchers2') as $fontMatcher) {
                    echo $fontMatcher . ',';
                }
                echo ']';
                ?>
            );
            $('#fontMatcher2').trigger('change');
            @endif

            //***** 3rd transcriber
            @if(old('transcriber_id3'))
            $('#transcriber3').val('{{old('transcriber_id3')}}');
            $('#transcriber3').trigger('change');
            @endif
            @if(old('name_in_manu3'))
            $('#name_in_manu3').val('{{old('name_in_manu3')}}');
            @endif
            @if(old('fontMatchers3'))
            $('#fontMatcher3').val(
                <?php
                echo '[';
                foreach (old('fontMatchers3') as $fontMatcher) {
                    echo $fontMatcher . ',';
                }
                echo ']';
                ?>
            );
            $('#fontMatcher3').trigger('change');
            @endif

            //***** 4th transcriber
            @if(old('transcriber_id4'))
            $('#transcriber4').val('{{old('transcriber_id4')}}');
            $('#transcriber4').trigger('change');
            @endif
            @if(old('name_in_manu4'))
            $('#name_in_manu4').val('{{old('name_in_manu4')}}');
            @endif
            @if(old('fontMatchers4'))
            $('#fontMatcher4').val(
                <?php
                echo '[';
                foreach (old('fontMatchers4') as $fontMatcher) {
                    echo $fontMatcher . ',';
                }
                echo ']';
                ?>
            );
            $('#fontMatcher4').trigger('change');
            @endif

            //***** Book title
            @if(old('book_id'))
            $('#book').val('{{old('book_id')}}');
            $('#book').trigger('change');
            @endif

            //***** City
            @if(old('city_id'))
            $('#city').val('{{old('city_id')}}');
            $('#city').trigger('change');
            @endif

            //***** Country
            @if(old('country_id'))
            $('#country').val('{{old('country_id')}}');
            $('#country').trigger('change');
            @endif

            //***** Cabinet
            @if(old('cabinet_id'))
            $('#cabinet').val('{{old('cabinet_id')}}');
            $('#cabinet').trigger('change');
            @endif

            //***** Manutypes
            @if(old('manutype_ids'))
            $('#manutype_ids').val(
                <?php
                echo '[';
                foreach (old('manutype_ids') as $fontMatcher) {
                    echo $fontMatcher . ',';
                }
                echo ']';
                ?>
            );
            $('#manutype_ids').trigger('change');
            @endif

            //***** Motifs
            @if(old('motif_ids'))
            $('#motif_ids').val(
                <?php
                echo '[';
                foreach (old('motif_ids') as $fontMatcher) {
                    echo $fontMatcher . ',';
                }
                echo ']';
                ?>
            );
            $('#motif_ids').trigger('change');
            @endif

            //***** Colors
            @if(old('color_ids'))
            $('#color_ids').val(
                <?php
                echo '[';
                foreach (old('color_ids') as $fontMatcher) {
                    echo $fontMatcher . ',';
                }
                echo ']';
                ?>
            );
            $('#color_ids').trigger('change');
            @endif
        });
    </script>


    <!-- display hidden inputs if has errors after validation -->
    <!-- transcribers -->
    @if(old('transcriber_id2'))
        <script> displayNewTranscriber(2) </script>;
    @endif
    @if(old('transcriber_id3'))
        <script> displayNewTranscriber(3) </script>;
    @endif
    @if(old('transcriber_id4'))
        <script> displayNewTranscriber(4) </script>;
    @endif

    <!-- cop date -->
    @if(old('trans_day') or old('trans_day_nbr') or old('trans_month') or old('trans_day_nbr_m') or old('trans_month_m') and !(old('trans_eyear') or old('trans_eyear_m')))
        <script> hideExact() </script>;
    @elseif(old('trans_eyear') or old('trans_eyear_m'))
        <script> hide_range() </script>;
    @endif

@endsection
