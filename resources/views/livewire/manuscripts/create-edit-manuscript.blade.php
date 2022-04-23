<?php
// days List
$days = ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];

//months List
$months = ['محرم', 'صفر', 'ربيع الأول', 'ربيع الثاني', 'جمادى الأولى', 'جمادى الثانية', 'رجب', 'شعبان', 'رمضان', 'شوال', 'ذو القعدة', 'ذو الحجة'];
$months_m = ['جانفي', 'فيفري', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويلية', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];

//font styles List
$w_font_styles = ['المبسوط', 'المجوهر', 'المسند (الزمامي)', 'المدمج', 'الثلث المغربي', 'الكوفي المغربي'];
$e_font_styles = ['النسخ', 'الثلث', 'الكوفي', 'التعليق', 'الديواني', 'الرقعة'];

?>

<div>

    {{-- progress bar --}}
    <div class="row justify-content-center bg-white-trans">
        <div class="col-11 text-center">
            <form id="form">
                <ul id="progressbar">
                    <li class="@if ($currentStep >= 1) active @endif" id="step1">
                        <strong>معلومات النساخ</strong>
                    </li>
                    <li class="@if ($currentStep >= 2) active @endif" id="step2">
                        <strong>معلومات النسخة</strong>
                    </li>
                    <li class="@if ($currentStep >= 3) active @endif" id="step3">
                        <strong>الوصف المادي</strong>
                    </li>
                    <li class="@if ($currentStep >= 4) active @endif" id="step4">
                        <strong>عمل الناسخ ومستوى النسخة</strong>
                    </li>
                    <li class="@if ($currentStep >= 5) active @endif" id="step5">
                        <strong>الملاحظات</strong>
                    </li>
                </ul>
            </form>
        </div>
    </div>


    <form wire:submit.prevent="@if ($manuComp['is_update'] == true) update() @else store() @endif" method="post">

        {{-- STEP 1 --}}


        <div class="step-one bg-white-trans @if ($currentStep != 1) d-none @endif">
            <h5 class="my_line"><span>الناسخ الأول</span></h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transcriber1" class="form-label">اسم الناسخ (من القائمة)</label>
                        <input type='text' placeholder='حدد اسم الناسخ' class='form-select' list='transcribers1'
                            wire:model="transcriber1" id="transcriber1" name="transcriber1_name"
                            wire:change="setTranscriberId(1, transcriber1_id)">

                        <datalist id="transcribers1">
                            @foreach ($transcribers1 as $transcriber1)
                                <option
                                    value="{{ $transcriber1->full_name }}{{ $transcriber1->descent1 ? ' ' . $transcriber1->descent1 : '' }}{{ $transcriber1->descent2 ? ' ' . $transcriber1->descent2 : '' }}{{ $transcriber1->descent3 ? ' ' . $transcriber1->descent3 : '' }}{{ $transcriber1->descent4 ? ' ' . $transcriber1->descent4 : '' }}{{ $transcriber1->descent5 ? ' ' . $transcriber1->descent5 : '' }}{{ $transcriber1->last_name ? ' ' . $transcriber1->last_name : '' }}{{ $transcriber1->nickname ? ' ' . $transcriber1->nickname : '' }}"
                                    data-id="{{ $transcriber1->id }}">
                            @endforeach
                        </datalist>

                        <span class="text-danger">
                            @error('transcriber1_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_in_manu1" class="form-label">اسم الناسخ الوارد في
                            النسخة</label>
                        <input name="name_in_manu1" wire:model="name_in_manu1"
                            class="form-control @error('name_in_manu1') is-invalid @enderror" id="name_in_manu1"
                            placeholder="أدخل اسم الناسخ 1 كما ورد في النسخة">
                        <span class="text-danger">
                            @error('name_in_manu1')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="fontMatcher1" class="form-label">الناسخ المشابه له في
                            الخط</label>
                        <input type="text" placeholder='حدد اسم الناسخ المشابه له في الخط'
                            class='form-select multidatalist' list='fontMatchers1' wire:model="fontMatcher1"
                            id="fontMatcher1" onchange="getFontMatcher1()">

                        <datalist id="fontMatchers1">
                            @foreach ($fontMatchers1 as $fontMatcher1)
                                <option
                                    value="{{ $fontMatcher1->full_name }}{{ $fontMatcher1->descent1 ? ' ' . $fontMatcher1->descent1 : '' }}{{ $fontMatcher1->descent2 ? ' ' . $fontMatcher1->descent2 : '' }}{{ $fontMatcher1->descent3 ? ' ' . $fontMatcher1->descent3 : '' }}{{ $fontMatcher1->descent4 ? ' ' . $fontMatcher1->descent4 : '' }}{{ $fontMatcher1->descent5 ? ' ' . $fontMatcher1->descent5 : '' }}{{ $fontMatcher1->last_name ? ' ' . $fontMatcher1->last_name : '' }}{{ $fontMatcher1->nickname ? ' ' . $fontMatcher1->nickname : '' }}"
                                    data-id="{{ $fontMatcher1->id }}">
                            @endforeach
                        </datalist>

                        <span class="text-danger">
                            @error('transcriber1_matchers')
                                {{ $message }}
                            @enderror
                            @error('transcriber1_matchers.*.id')
                                {{ $message }}
                            @enderror
                        </span>

                        <!--- List of fontMatchers badges -->
                        <div id="transcriber1FontMatchersBadges">
                            @foreach ($transcriber1_matchers as $transcriber1_matcher)
                                <p class="badge rounded-pill bg-success mx-1 p-2 mt-2">
                                    {{ $transcriber1_matcher['name'] }}
                                    <a wire:click="deleteFontMatcher(1, '{{ $transcriber1_matcher['id'] }}')"
                                        style="cursor: pointer" class="text-white text-decoration-none mx-1"> <i
                                            class="fas fa-times"></i>
                                    </a>
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--- add fontMatcher icon -->
                <div class="col-md-auto"><br><br>
                    <a style="cursor: pointer"
                        wire:click="pushToTranscriberMatchers(1,fontMatcher1['id'], fontMatcher1['name'])">
                        <i class="fas fa-plus-circle fs-4"></i>
                    </a>
                </div>
            </div>
            <!--end row-->

            <div class="@if ($nbrOfTranscribers < 2) d-none @endif">
                <h5 class="my_line"><span>الناسخ الثاني</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transcriber2" class="form-label">اسم الناسخ (من القائمة)</label>
                            <input type='text' placeholder='حدد اسم الناسخ' class='form-select' list='transcribers2'
                                wire:model="transcriber2" id="transcriber2" name="transcriber2_name"
                                wire:change="setTranscriberId(2, transcriber2_id)">

                            <datalist id="transcribers2">
                                @foreach ($transcribers2 as $transcriber2)
                                    <option
                                        value="{{ $transcriber2->full_name }}{{ $transcriber2->descent1 ? ' ' . $transcriber2->descent1 : '' }}{{ $transcriber2->descent2 ? ' ' . $transcriber2->descent2 : '' }}{{ $transcriber2->descent3 ? ' ' . $transcriber2->descent3 : '' }}{{ $transcriber2->descent4 ? ' ' . $transcriber2->descent4 : '' }}{{ $transcriber2->descent5 ? ' ' . $transcriber2->descent5 : '' }}{{ $transcriber2->last_name ? ' ' . $transcriber2->last_name : '' }}{{ $transcriber2->nickname ? ' ' . $transcriber2->nickname : '' }}"
                                        data-id="{{ $transcriber2->id }}">
                                @endforeach
                            </datalist>
                            <span class="text-danger">
                                @error('transcriber2_id')
                                    {{ $message }}
                                @enderror
                            </span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_in_manu2" class="form-label">اسم الناسخ الوارد في
                                النسخة</label>
                            <input name="name_in_manu2" wire:model="name_in_manu2"
                                class="form-control @error('name_in_manu2') is-invalid @enderror" id="name_in_manu2"
                                placeholder="أدخل اسم الناسخ 2 كما ورد في النسخة">
                            <span class="text-danger">
                                @error('name_in_manu2')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="fontMatcher2" class="form-label">الناسخ المشابه له في
                                الخط</label>
                            <input type="text" placeholder='حدد اسم الناسخ المشابه له في الخط'
                                class='form-select multidatalist' list='fontMatchers2' wire:model="fontMatcher2"
                                id="fontMatcher2" onchange="getFontMatcher2()">
                            <datalist id="fontMatchers2">
                                @foreach ($fontMatchers2 as $fontMatcher2)
                                    <option
                                        value="{{ $fontMatcher2->full_name }}{{ $fontMatcher2->descent1 ? ' ' . $fontMatcher2->descent1 : '' }}{{ $fontMatcher2->descent2 ? ' ' . $fontMatcher2->descent2 : '' }}{{ $fontMatcher2->descent3 ? ' ' . $fontMatcher2->descent3 : '' }}{{ $fontMatcher2->descent4 ? ' ' . $fontMatcher2->descent4 : '' }}{{ $fontMatcher2->descent5 ? ' ' . $fontMatcher2->descent5 : '' }}{{ $fontMatcher2->last_name ? ' ' . $fontMatcher2->last_name : '' }}{{ $fontMatcher2->nickname ? ' ' . $fontMatcher2->nickname : '' }}"
                                        data-id="{{ $fontMatcher2->id }}">
                                @endforeach
                            </datalist>

                            <span class="text-danger">
                                @error('transcriber2_matchers')
                                    {{ $message }}
                                @enderror
                                @error('transcriber2_matchers.*.id')
                                    {{ $message }}
                                @enderror
                            </span>
                            <!--- List of fontMatchers badges -->
                            <div id="transcriber2FontMatchersBadges">
                                @foreach ($transcriber2_matchers as $transcriber2_matcher)
                                    <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                        {{ $transcriber2_matcher['name'] }}
                                        <a wire:click="deleteFontMatcher(2, '{{ $transcriber2_matcher['id'] }}')"
                                            style="cursor: pointer" class="text-white text-decoration-none mx-1"> <i
                                                class="fas fa-times"></i>
                                        </a>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--- add fontMatcher icon -->
                    <div class="col-md-auto"><br><br>
                        <a style="cursor: pointer"
                            wire:click="pushToTranscriberMatchers(2,fontMatcher2['id'], fontMatcher2['name'])">
                            <i class="fas fa-plus-circle fs-4"></i>
                        </a>
                    </div>
                </div>
                <!--end row-->
            </div>

            <div class="@if ($nbrOfTranscribers < 3) d-none @endif">
                <h5 class="my_line"><span>الناسخ الثالث</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transcriber3" class="form-label">اسم الناسخ (من القائمة)</label>
                            <input type='text' placeholder='حدد اسم الناسخ' class='form-select' list='transcribers3'
                                wire:model="transcriber3" id="transcriber3" name="transcriber3_name"
                                wire:change="setTranscriberId(3, transcriber3_id)">

                            <datalist id="transcribers3">
                                @foreach ($transcribers3 as $transcriber3)
                                    <option
                                        value="{{ $transcriber3->full_name }}{{ $transcriber3->descent1 ? ' ' . $transcriber3->descent1 : '' }}{{ $transcriber3->descent2 ? ' ' . $transcriber3->descent2 : '' }}{{ $transcriber3->descent3 ? ' ' . $transcriber3->descent3 : '' }}{{ $transcriber3->descent4 ? ' ' . $transcriber3->descent4 : '' }}{{ $transcriber3->descent5 ? ' ' . $transcriber3->descent5 : '' }}{{ $transcriber3->last_name ? ' ' . $transcriber3->last_name : '' }}{{ $transcriber3->nickname ? ' ' . $transcriber3->nickname : '' }}"
                                        data-id="{{ $transcriber3->id }}">
                                @endforeach
                            </datalist>
                            <span class="text-danger">
                                @error('transcriber3_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_in_manu3" class="form-label">اسم الناسخ الوارد في
                                النسخة</label>
                            <input name="name_in_manu3" wire:model="name_in_manu3"
                                class="form-control @error('name_in_manu3') is-invalid @enderror" id="name_in_manu3"
                                placeholder="أدخل اسم الناسخ 3 كما ورد في النسخة">
                            <span class="text-danger">
                                @error('name_in_manu3')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="fontMatcher3" class="form-label">الناسخ المشابه له في
                                الخط</label>
                            <input type="text" placeholder='حدد اسم الناسخ المشابه له في الخط'
                                class='form-select multidatalist' list='fontMatchers3' wire:model="fontMatcher3"
                                id="fontMatcher3" onchange="getFontMatcher3()">
                            <datalist id="fontMatchers3">
                                @foreach ($fontMatchers3 as $fontMatcher3)
                                    <option
                                        value="{{ $fontMatcher3->full_name }}{{ $fontMatcher3->descent1 ? ' ' . $fontMatcher3->descent1 : '' }}{{ $fontMatcher3->descent2 ? ' ' . $fontMatcher3->descent2 : '' }}{{ $fontMatcher3->descent3 ? ' ' . $fontMatcher3->descent3 : '' }}{{ $fontMatcher3->descent4 ? ' ' . $fontMatcher3->descent4 : '' }}{{ $fontMatcher3->descent5 ? ' ' . $fontMatcher3->descent5 : '' }}{{ $fontMatcher3->last_name ? ' ' . $fontMatcher3->last_name : '' }}{{ $fontMatcher3->nickname ? ' ' . $fontMatcher3->nickname : '' }}"
                                        data-id="{{ $fontMatcher3->id }}">
                                @endforeach
                            </datalist>

                            <span class="text-danger">
                                @error('transcriber3_matchers')
                                    {{ $message }}
                                @enderror
                                @error('transcriber3_matchers.*.id')
                                    {{ $message }}
                                @enderror
                            </span>
                            <!--- List of fontMatchers badges -->
                            <div id="transcriber3FontMatchersBadges">
                                @foreach ($transcriber3_matchers as $transcriber3_matcher)
                                    <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                        {{ $transcriber3_matcher['name'] }}
                                        <a wire:click="deleteFontMatcher(3, '{{ $transcriber3_matcher['id'] }}')"
                                            style="cursor: pointer" class="text-white text-decoration-none mx-1"> <i
                                                class="fas fa-times"></i>
                                        </a>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--- add fontMatcher icon -->
                    <div class="col-md-auto"><br><br>
                        <a style="cursor: pointer"
                            wire:click="pushToTranscriberMatchers(3,fontMatcher3['id'], fontMatcher3['name'])">
                            <i class="fas fa-plus-circle fs-4"></i>
                        </a>
                    </div>
                </div>
                <!--end row-->
            </div>

            <div class="@if ($nbrOfTranscribers < 4) d-none @endif">
                <h5 class="my_line"><span>الناسخ الرابع</span></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transcriber4" class="form-label">اسم الناسخ (من القائمة)</label>
                            <input type='text' placeholder='حدد اسم الناسخ' class='form-select' list='transcribers4'
                                wire:model="transcriber4" id="transcriber4" name="transcriber4_name"
                                wire:change="setTranscriberId(4, transcriber4_id)">

                            <datalist id="transcribers4">
                                @foreach ($transcribers4 as $transcriber4)
                                    <option
                                        value="{{ $transcriber4->full_name }}{{ $transcriber4->descent1 ? ' ' . $transcriber4->descent1 : '' }}{{ $transcriber4->descent2 ? ' ' . $transcriber4->descent2 : '' }}{{ $transcriber4->descent3 ? ' ' . $transcriber4->descent3 : '' }}{{ $transcriber4->descent4 ? ' ' . $transcriber4->descent4 : '' }}{{ $transcriber4->descent5 ? ' ' . $transcriber4->descent5 : '' }}{{ $transcriber4->last_name ? ' ' . $transcriber4->last_name : '' }}{{ $transcriber4->nickname ? ' ' . $transcriber4->nickname : '' }}"
                                        data-id="{{ $transcriber4->id }}">
                                @endforeach
                            </datalist>
                            <span class="text-danger">
                                @error('transcriber4_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_in_manu4" class="form-label">اسم الناسخ الوارد في
                                النسخة</label>
                            <input name="name_in_manu4" wire:model="name_in_manu4"
                                class="form-control @error('name_in_manu4') is-invalid @enderror" id="name_in_manu4"
                                placeholder="أدخل اسم الناسخ 4 كما ورد في النسخة">
                            <span class="text-danger">
                                @error('name_in_manu4')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label for="fontMatcher4" class="form-label">الناسخ المشابه له في
                                الخط</label>
                            <input type="text" placeholder='حدد اسم الناسخ المشابه له في الخط'
                                class='form-select multidatalist' list='fontMatchers4' wire:model="fontMatcher4"
                                id="fontMatcher4" onchange="getFontMatcher4()">
                            <datalist id="fontMatchers4">
                                @foreach ($fontMatchers4 as $fontMatcher4)
                                    <option
                                        value="{{ $fontMatcher4->full_name }}{{ $fontMatcher4->descent1 ? ' ' . $fontMatcher4->descent1 : '' }}{{ $fontMatcher4->descent2 ? ' ' . $fontMatcher4->descent2 : '' }}{{ $fontMatcher4->descent3 ? ' ' . $fontMatcher4->descent3 : '' }}{{ $fontMatcher4->descent4 ? ' ' . $fontMatcher4->descent4 : '' }}{{ $fontMatcher4->descent5 ? ' ' . $fontMatcher4->descent5 : '' }}{{ $fontMatcher4->last_name ? ' ' . $fontMatcher4->last_name : '' }}{{ $fontMatcher4->nickname ? ' ' . $fontMatcher4->nickname : '' }}"
                                        data-id="{{ $fontMatcher4->id }}">
                                @endforeach
                            </datalist>

                            <span class="text-danger">
                                @error('transcriber4_matchers')
                                    {{ $message }}
                                @enderror
                                @error('transcriber4_matchers.*.id')
                                    {{ $message }}
                                @enderror
                            </span>
                            <!--- List of fontMatchers badges -->
                            <div id="transcriber4FontMatchersBadges">
                                @foreach ($transcriber4_matchers as $transcriber4_matcher)
                                    <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                        {{ $transcriber4_matcher['name'] }}
                                        <a wire:click="deleteFontMatcher(4, '{{ $transcriber4_matcher['id'] }}')"
                                            style="cursor: pointer" class="text-white text-decoration-none mx-1"> <i
                                                class="fas fa-times"></i>
                                        </a>
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--- add fontMatcher icon -->
                    <div class="col-md-auto"><br><br>
                        <a style="cursor: pointer"
                            wire:click="pushToTranscriberMatchers(4,fontMatcher4['id'], fontMatcher4['name'])">
                            <i class="fas fa-plus-circle fs-4"></i>
                        </a>
                    </div>
                </div>
                <!--end row-->
            </div>

            @if ($nbrOfTranscribers <= 4)
                <!-- add/remove input dynamically -->
                <div class="row justify-content-md-center mt-4">
                    @if ($nbrOfTranscribers > 1)
                        <a wire:click="decreaseNbrOfTranscribers()" class="col-md-auto btn btn-sm btn-danger mx-2"
                            id="addTranscriber"><i class="fas fa-times"></i>
                            إزالة الناسخ
                        </a>
                    @endif
                    @if ($nbrOfTranscribers < 4)
                        <a wire:key="time()" wire:click="increaseNbrOfTranscribers()"
                            class="col-md-auto btn btn-sm btn-primary" id="addTranscriber"><i
                                class="fas fa-plus"></i>
                            إضافة ناسخ
                        </a>
                    @endif
                </div>
            @endif
            <!-- END add/remove input dynamically -->
        </div>


        {{-- STEP 2 --}}




        <div class="step-two bg-white-trans @if ($currentStep != 2) d-none @endif">
            <div class="row">
                <div class="col-md-9">
                    <label for="book" class="form-label">عنوان الكتاب</label>
                    <input type='text' placeholder='حدد عنوان الكتاب' class='form-select' list='books' wire:model="book"
                        id="book" name="book_name" wire:change="setBookId(book_id)">
                    <datalist id="books">
                        @foreach ($books as $book)
                            <option value="{{ $book->title }}" data-id="{{ $book->id }}">
                        @endforeach
                    </datalist>

                    @error('book_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="book_part" class="form-label">الجزء</label>
                    <input type="number" wire:model="book_part"
                        class="form-control text-center @error('book_part') is-invalid @enderror" name="book_part"
                        id="book_part" placeholder="أدخل جزء الكتاب">
                    @error('book_part')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2" id="transDate_exact">
                <div class="col-md-2">
                    <label for="trans_day" class="form-label">تاريخ النسخ</label>
                    <select wire:model="trans_day" name="trans_day" id="trans_day"
                        class="form-select @error('trans_day') is-invalid @enderror">
                        <option selected>-أدخل اليوم-</option>
                        @for ($i = 0; $i <= 6; $i++)
                            <option value="{{ $i + 1 }}">
                                {{ $days[$i] }}
                            </option>
                        @endfor
                    </select>
                    @error('trans_day')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="trans_day_nbr" class="form-label">&nbsp;</label>
                    <select wire:model="trans_day_nbr" name="trans_day_nbr" id="trans_day_nbr"
                        class="form-select @error('trans_day_nbr') is-invalid @enderror">
                        <option selected>- أدخل اليوم -</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('trans_day_nbr')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="trans_month" class="form-label">&nbsp;</label>
                    <select wire:model="trans_month" name="trans_month" id="trans_month"
                        class="form-select @error('trans_month') is-invalid @enderror">
                        <option selected>-أدخل الشهر-</option>
                        @for ($i = 0; $i <= 11; $i++)
                            <option value="{{ $i + 1 }}">
                                {{ $months[$i] }}
                            </option>
                        @endfor
                    </select>
                    @error('trans_month')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="trans_syear" class="form-label">&nbsp;</label>
                    <input wire:model="trans_syear" type="number"
                        class="form-control @error('trans_syear') is-invalid @enderror" name="trans_syear"
                        id="trans_syear" placeholder="أدخل السنة">
                    @error('trans_syear')
                        <div class="invalid-feedback">
                            {{ $message }}
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
                    <select wire:model="trans_day_nbr_m" name="trans_day_nbr_m" id="trans_day_nbr"
                        class="form-select @error('trans_day_nbr_m') is-invalid @enderror">
                        <option selected>- أدخل اليوم -</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('trans_day_nbr_m')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <select wire:model="trans_month_m" name="trans_month_m" id="trans_month"
                        class="form-select @error('trans_month_m') is-invalid @enderror">
                        <option selected>-أدخل الشهر-</option>
                        @for ($i = 0; $i <= 11; $i++)
                            <option value="{{ $i + 1 }}">
                                {{ $months_m[$i] }}
                            </option>
                        @endfor
                    </select>
                    @error('trans_month_m')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <input wire:model="trans_syear_m" type="number"
                        class="form-control @error('trans_syear_m') is-invalid @enderror" name="trans_syear_m"
                        id="trans_syear_m" placeholder="أدخل السنة">
                    @error('trans_syear_m')
                        <div class="invalid-feedback">
                            {{ $message }}
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
                    <input wire:model="trans_syear" type="number"
                        class="form-control @error('trans_syear') is-invalid @enderror" name="trans_syear"
                        id="trans_syear" placeholder="من سنة">
                    @error('trans_syear')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-auto">
                    <label for="trans_eyear" class="form-label">&nbsp;</label>
                    <input wire:model="trans_eyear" type="number"
                        class="form-control @error('trans_eyear') is-invalid @enderror" name="trans_eyear"
                        id="trans_eyear" placeholder="إلى سنة">
                    @error('trans_eyear')
                        <div class="invalid-feedback">
                            {{ $message }}
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
                    <input wire:model="trans_syear_m" type="number"
                        class="form-control @error('trans_syear_m') is-invalid @enderror" name="trans_syear_m"
                        id="trans_syear_m" placeholder="من سنة">
                    @error('trans_syear_m')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-auto">
                    <input wire:model="trans_eyear_m" type="number"
                        class="form-control @error('trans_eyear_m') is-invalid @enderror" name="trans_eyear_m"
                        id="trans_eyear_m" placeholder="إلى سنة">
                    @error('trans_eyear_m')
                        <div class="invalid-feedback">
                            {{ $message }}
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
                    <input wire:model="trans_place" name="trans_place"
                        class="form-control @error('trans_place') is-invalid @enderror" id="trans_place"
                        placeholder="أدخل مكان النسخ">
                    @error('trans_place')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="country" class="form-label">البلد حاليا</label>
                    <input type='text' class="form-select" placeholder="حدد بلد النسخ" id="country" list="countries"
                        wire:model="country" name="country_name" wire:change="setCountryId(country_id)">

                    <datalist id="countries">
                        @foreach ($countries as $country)
                            <option value="{{ $country->name }}" data-id="{{ $country->id }}">
                        @endforeach
                    </datalist>

                    @error('country_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="city" class="form-label">المدينة</label>
                    <input type='text' placeholder='حدد مدينة النسخ' class='form-select' list='cities' wire:model="city"
                        id="city" name="city_name" wire:change="setCityId(city_id)">

                    <datalist id="cities">
                        @foreach ($cities as $city)
                            <option value="{{ $city->name }}" data-id="{{ $city->id }}">
                        @endforeach
                    </datalist>
                    @error('city_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label class="form-label">موقعة أو بالمقارنة؟</label>
                    <select wire:model="signed_in" name="signed_in" id="signed_in"
                        class="form-select @error('signed_in') is-invalid @enderror">
                        <option selected>-حدد خيار-</option>
                        <option value="1">موقعة</option>
                        <option value="0">بالمقارنة
                        </option>
                    </select>
                    @error('signed_in')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="nbr_in_index" class="form-label">الرقم في الفهرس</label>
                    <input wire:model="nbr_in_index" name="nbr_in_index"
                        class="form-control @error('nbr_in_index') is-invalid @enderror text-center" id="nbr_in_index"
                        type="number" placeholder="أدخل الرقم في الفهرس">
                    @error('nbr_in_index')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-7">
                    <label for="cabinet" class="form-label">اسم الخزانة</label>
                    <input type='text' placeholder='حدد اسم الخزانة' class='form-select' list='cabinets'
                        wire:model="cabinet" id="cabinet" name="cabinet_name" wire:change="setCabinetId(cabinet_id)">
                    <datalist id="cabinets">
                        @foreach ($cabinets as $cabinet)
                            <option value="{{ $cabinet->name }}" data-id="{{ $cabinet->id }}">
                        @endforeach
                    </datalist>

                    @error('cabinet_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-auto">
                    <label for="nbr_in_cabinet" class="form-label">الرقم في الخزانة</label>
                    <input wire:model="nbr_in_cabinet" type="number"
                        class="form-control @error('nbr_in_cabinet') is-invalid @enderror text-center"
                        name="nbr_in_cabinet" id="nbr_in_cabinet" placeholder="أدخل الرقم في الخزانة">
                    @error('nbr_in_cabinet')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-auto">
                    <label for="manu_type" class="form-label">نوع النسخة</label>
                    <select wire:model="manu_type" name="manu_type" id="manu_type"
                        class="form-select @error('manu_type') is-invalid @enderror">
                        <option selected>-اختر نوع النسخة-</option>
                        <option value="مج">مجلد</option>
                        <option value="مص">مصحف</option>
                        <option value="دغ">دون غلاف
                        </option>
                    </select>
                    @error('manu_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- STEP 3 --}}


        <div class="step-three bg-white-trans @if ($currentStep != 3) d-none @endif">
            <div class="row mt-2">
                <div class="col-md-2">
                    <label for="font" class="form-label">الخط</label>
                    <select wire:model="font" name="font" id="font"
                        class="form-select @error('font') is-invalid @enderror">
                        <option selected>- اختر خط -</option>
                        <option value="مغربي">مغربي
                        </option>
                        <option value="مشرقي">مشرقي
                        </option>
                    </select>
                    @error('font')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="font_style" class="form-label">نوع الخط</label>
                    <select wire:model="font_style" name="font_style" id="font_style"
                        class="form-select @error('font_style') is-invalid @enderror">
                        <option selected>- اختر نوع الخط -</option>
                        @if ($font == 'مغربي')
                            @foreach ($w_font_styles as $w_font_style)
                                <option value="{{ $w_font_style }}"> {{ $w_font_style }} </option>
                            @endforeach
                        @elseif($font == 'مشرقي')
                            @foreach ($e_font_styles as $e_font_style)
                                <option value="{{ $e_font_style }}"> {{ $e_font_style }} </option>
                            @endforeach
                        @endif

                    </select>
                    @error('font_style')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-auto">
                    <label for="transcriber_level" class="form-label">مستوى النسخة من حيث الوضوح
                        والرداءة</label>
                    <select wire:model="transcriber_level" name="transcriber_level" id="transcriber_level"
                        class="form-select @error('transcriber_level') is-invalid @enderror">
                        <option selected>- حدد مستوى -</option>
                        <option value="جيدة">جيدة
                        </option>
                        <option value="حسنة">حسنة
                        </option>
                        <option value="متوسطة">متوسطة
                        </option>
                        <option value="رديئة">رديئة
                        </option>
                    </select>
                    @error('transcriber_level')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="paper_size" class="form-label">مقاس الورق</label>
                    <select wire:model="paper_size" name="paper_size" id="paper_size"
                        class="form-select @error('paper_size') is-invalid @enderror">
                        <option selected>- اختر مقاس الورق -</option>
                        <option value="1">القطع الكبير
                        </option>
                        <option value="2">القطع المتوسط
                        </option>
                        <option value="3">القطع الصغير
                        </option>
                    </select>
                    @error('paper_size')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="size_notes" class="form-label">ملاحظات على المقاس</label>
                    <input wire:model="size_notes" type="text"
                        class="form-control @error('size_notes') is-invalid @enderror" name="size_notes"
                        id="size_notes" placeholder="أدخل ملاحظات المقاس">
                    @error('size_notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="regular_lines" class="form-label">المسطرة</label>
                    <select wire:model="regular_lines" name="regular_lines" id="regular_lines"
                        class="form-select @error('regular_lines') is-invalid @enderror">
                        <option selected>- حدد خيار -</option>
                        <option value="1">منتظمة
                        </option>
                        <option value="0">غير منتظمة
                        </option>
                    </select>
                    @error('regular_lines')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="lines_notes" class="form-label">ملاحظات على المسطرة</label>
                    <input wire:model="lines_notes" type="text"
                        class="form-control @error('lines_notes') is-invalid @enderror" name="lines_notes"
                        id="lines_notes" placeholder="أدخل ملاحظات المسطرة">
                    @error('lines_notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="is_not_truncated" class="form-label">التمام والبتر</label>
                    <select wire:model="is_not_truncated" name="is_not_truncated" id="is_not_truncated"
                        class="form-select @error('is_not_truncated') is-invalid @enderror">
                        <option selected>- حدد خيار -</option>
                        <option value="1">تامة</option>
                        <option value="0">مبتورة
                        </option>
                    </select>
                    @error('is_not_truncated')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="truncation_notes" class="form-label">مكان البتر</label>
                    <input wire:model="truncation_notes" type="text"
                        class="form-control @error('truncation_notes') is-invalid @enderror" name="truncation_notes"
                        id="truncation_notes" placeholder="أدخل مكان البتر">
                    @error('truncation_notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="nbr_of_papers" class="form-label">عدد الصفحات</label>
                    <input wire:model="nbr_of_papers" name="nbr_of_papers"
                        class="form-control @error('nbr_of_papers') is-invalid @enderror text-center"
                        id="nbr_of_papers" type="number" placeholder="أدخل عدد الصفحات">
                    @error('nbr_of_papers')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="save_status" class="form-label">حالة الحفظ</label>
                    <select wire:model="save_status" name="save_status" id="save_status"
                        class="form-select @error('save_status') is-invalid @enderror">
                        <option selected>- حدد مستوى -</option>
                        <option value="حسنة">حسنة
                        </option>
                        <option value="متوسطة">متوسطة
                        </option>
                        <option value="رديئة">رديئة
                        </option>
                        <option value="من حسنة إلى متوسطة">
                            من حسنة إلى متوسطة
                        </option>
                        <option value="من متوسطة إلى رديئة">
                            من متوسطة إلى رديئة
                        </option>

                    </select>
                    @error('save_status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-5">
                    <label for="motif_ids" class="form-label">الزخارف المستعملة</label>
                    <input wire:model="motif" list="motifs" type="text" placeholder="حدد زخرفة"
                        class="form-select multidatalist" id="motif" onchange="getMotif()">
                    <datalist id="motifs">
                        @foreach ($motifs as $motif)
                            <option value="{{ $motif->name }}" data-id="{{ $motif->id }}">
                        @endforeach
                    </datalist>

                    <span class="text-danger">
                        @error('motifsArray')
                            {{ $message }}
                        @enderror
                        @error('motifsArray.*.id')
                            {{ $message }}
                        @enderror
                    </span>
                    <!--- List of motifs badges -->
                    <div id="motifsBadges">
                        @foreach ($motifsArray as $motif)
                            <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                {{ $motif['name'] }}
                                <a wire:click="deleteMotif('{{ $motif['id'] }}')" style="cursor: pointer"
                                    class="text-white text-decoration-none mx-1">
                                    <i class="fas fa-times"></i>
                                </a>
                            </p>
                        @endforeach
                    </div>
                </div>
                <!--- add motif icon -->
                <div class="col-md-auto"><br><br>
                    <a wire:click="pushToMotifs(motif['id'], motif['name'])" style="cursor: pointer">
                        <i class="fas fa-plus-circle fs-4"></i>
                    </a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-5">
                    <label for="color_ids" class="form-label">ألوان الحبر المستعملة</label>
                    <input wire:model="color" type="text" placeholder='حدد لون' class='form-select multidatalist'
                        list='colors' id="color" onchange="getColor()">
                    <datalist id="colors">
                        @foreach ($colors as $color)
                            <option value="{{ $color->name }}" data-id="{{ $color->id }}">
                        @endforeach
                    </datalist>

                    <span class="text-danger">
                        @error('colorsArray')
                            {{ $message }}
                        @enderror
                        @error('colorsArray.*.id')
                            {{ $message }}
                        @enderror
                    </span>
                    <!--- List of colors badges -->
                    <div id="colorsBadges">
                        @foreach ($colorsArray as $color)
                            <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                {{ $color['name'] }}
                                <a wire:click="deleteColor('{{ $color['id'] }}')" style="cursor: pointer"
                                    class="text-white text-decoration-none mx-1">
                                    <i class="fas fa-times"></i>
                                </a>
                            </p>
                        @endforeach
                    </div>
                </div>
                <!--- add color icon -->
                <div class="col-md-auto"><br><br>
                    <a wire:click="pushToColors(color['id'], color['name'])" style="cursor: pointer">
                        <i class="fas fa-plus-circle fs-4"></i>
                    </a>
                </div>
            </div>
        </div>


        {{-- STEP 4 --}}


        <div class="step-four bg-white-trans @if ($currentStep != 4) d-none @endif">
            <div class="row mt-2">
                <div class="col-md-5">
                    <label for="manutype_ids" class="form-label">عمل الناسخ عدا نقل المحتوى</label>
                    <input wire:model="manutype" type="text" placeholder='حدد خيار' class='form-select multidatalist'
                        list='manutypes' id="manutype" onchange="getManutype()">
                    <datalist id="manutypes">
                        @foreach ($manutypes as $manutype)
                            <option value="{{ $manutype->name }}" data-id="{{ $manutype->id }}">
                        @endforeach
                    </datalist>

                    <span class="text-danger">
                        @error('manutypesArray')
                            {{ $message }}
                        @enderror
                        @error('manutypesArray.*.id')
                            {{ $message }}
                        @enderror
                    </span>
                    <!--- List of manutypes badges -->
                    <div id="manutypesBadges">
                        @foreach ($manutypesArray as $manutype)
                            <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                {{ $manutype['name'] }}
                                <a wire:click="deleteManutype('{{ $manutype['id'] }}')" style="cursor: pointer"
                                    class="text-white text-decoration-none mx-1">
                                    <i class="fas fa-times"></i>
                                </a>
                            </p>
                        @endforeach
                    </div>
                </div>
                <!--- add manutype icon -->
                <div class="col-md-auto"><br><br>
                    <a wire:click="pushToManutypes(manutype['id'], manutype['name'])" style="cursor: pointer">
                        <i class="fas fa-plus-circle fs-4"></i>
                    </a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-auto">
                    <label for="manuscript_level" class="form-label">مستوى النسخة من حيث الجودة
                        والضبط</label>
                    <select wire:model="manuscript_level" name="manuscript_level" id="manuscript_level"
                        class="form-select @error('manuscript_level') is-invalid @enderror">
                        <option selected>- حدد مستوى -</option>
                        <option value="جيدة">جيدة
                        </option>
                        <option value="حسنة">حسنة
                        </option>
                        <option value="متوسطة">متوسطة
                        </option>
                        <option value="رديئة">رديئة
                        </option>
                    </select>
                    @error('manuscript_level')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>


        {{-- STEP 5 --}}


        <div class="step-five bg-white-trans @if ($currentStep != 5) d-none @endif">
            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="transcribed_from" class="form-label">الأصل المنسوخ منه</label>
                    <input wire:model="transcribed_from" type="text"
                        class="form-control @error('transcribed_from') is-invalid @enderror" name="transcribed_from"
                        id="transcribed_from" placeholder="أدخل الأصل المنسوخ منه">
                    @error('transcribed_from')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-8">
                    <label for="transcribed_to" class="form-label">المنسوخ له</label>
                    <div class="row mb-3 mt-2">
                        <div class="col-md-auto">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_to_himself" value="1"
                                    wire:model="is_to_himself" role="switch" id="is_to_himself">
                                <label class="form-check-label" for="is_to_himself"> نسخها لنفسه</label>
                            </div>
                        </div>
                    </div>

                    <input wire:model="transcribed_to" type="text"
                        class="form-control @error('transcribed_to') is-invalid @enderror @if ($is_to_himself == 1) d-none @endif"
                        name="transcribed_to" id="transcribed_to" placeholder="أدخل المنسوخ له بأوصافه">

                    @error('transcribed_to')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="rost_completion" class="form-label">ترميم وإتمام</label>
                    <select wire:model="rost_completion" name="rost_completion" id="rost_completion"
                        class="form-select @error('rost_completion') is-invalid @enderror">
                        <option selected>- اختر خيار -</option>
                        <option value="1">نعم</option>
                        <option value="0">لا</option>
                    </select>
                    @error('rost_completion')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-7">
                    <label for="notes" class="form-label">ملاحظات أخرى</label>
                    <textarea wire:model="notes" class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes"
                        rows="3" placeholder="أدخل ملاحظات أخرى"></textarea>
                    @error('notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="action-buttons d-flex justify-content-between bg-white-trans py-2 mt-3">

            @if ($currentStep == 1)
                <div></div>
            @endif

            @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4 || $currentStep == 5)
                <button type="button" class="btn btn-md btn-secondary" wire:click="decreaseStep()">
                    <i class="fad fa-chevron-double-right"></i> السابق
                </button>
            @endif

            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3 || $currentStep == 4)
                <button type="button" class="btn btn-md btn-success" wire:click="increaseStep()">التالي
                    <i class="fad fa-chevron-double-left"></i>
                </button>
            @endif

            @if ($currentStep == 5)
                <button type="submit" class="btn btn-md {{ $manuComp['btn_color'] }}"><i
                        class="{{ $manuComp['btn_icon'] }}"></i>
                    {{ $manuComp['btn_title'] }}</button>
            @endif
        </div>
    </form>
</div>
