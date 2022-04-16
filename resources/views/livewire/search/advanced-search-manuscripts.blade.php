<?php

//font styles List
$w_font_styles = ['المبسوط', 'المجوهر', 'المسند (الزمامي)', 'المدمج', 'الثلث المغربي', 'الكوفي المغربي'];
$e_font_styles = ['النسخ', 'الثلث', 'الكوفي', 'التعليق', 'الديواني', 'الرقعة'];
?>
<div>
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <h5 class="my_line"><span>ما يتعلق بالكتاب</span></h5>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="form-floating">
                <input type="text" class="form-select" name="book" id="book" list="books" wire:model="book">
                <label for="book">عنوان الكتاب</label>
                <datalist id="books">
                    @foreach ($books as $book)
                        <option value="{{ $book->title }}" data-id="{{ $book->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-7">
            <div class="form-floating">
                <input type="text" class="form-select" id="author" list="authors" wire:model="author"
                    onchange="getAuthor()">
                <label for="author">المؤلفين</label>
                <datalist id="authors">
                    @foreach ($authors as $author)
                        <option value="{{ $author->name }}" data-id="{{ $author->id }}">
                    @endforeach
                </datalist>
                <!--- List of authors badges -->
                <div id="authorsBadges">
                    @foreach ($authorsArray as $author)
                        <p class="badge rounded-pill bg-success mx-1 p-2 mt-2">
                            {{ $author }}
                            <a wire:click="deleteAuthor('{{ $author }}')"
                                onclick="deleteAuthor('{{ $author }}')" style="cursor: pointer"
                                class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <!--- add author icon -->
        <div class="col-md-1"><br>
            <a style="cursor: pointer" wire:click="pushToAuthors(author_name)" onclick="setAuthors()">
                <i class="fas fa-plus-circle fs-4"></i>
            </a>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-7">
            <div class="form-floating">
                <input type="text" class="form-select" id="subject" list="subjects" wire:model="subject"
                    onchange="getSubject()">
                <label for="subject">المواضيع</label>
                <datalist id="subjects">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->name }}" data-id="{{ $subject->id }}">
                    @endforeach
                </datalist>
                <!--- List of subjects badges -->
                <div id="subjectsBadges">
                    @foreach ($subjectsArray as $subject)
                        <p class="badge rounded-pill bg-success mx-1 p-2 mt-2">
                            {{ $subject }}
                            <a wire:click="deleteSubject('{{ $subject }}')"
                                onclick="deleteSubject('{{ $subject }}')" style="cursor: pointer"
                                class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <!--- add subject icon -->
        <div class="col-md-1"><br>
            <a style="cursor: pointer" wire:click="pushToSubjects(subject_name)" onclick="setSubjects()">
                <i class="fas fa-plus-circle fs-4"></i>
            </a>
        </div>
    </div>


    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <h5 class="my_line"><span>ما يتعلق بالناسخ</span></h5>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="form-floating">
                <input type="text" class="form-select" name="transcriber" id="transcriber" list="transcribers"
                    wire:model="transcriber">
                <label for="transcriber">الناسخ</label>
                <datalist id="transcribers">
                    @foreach ($transcribers as $transcriber)
                        <option value="{{ $transcriber->full_name_descent }}" data-id="{{ $transcriber->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-select" name="transCountry" id="transCountry" list="transCountries"
                    wire:model="transCountry">
                <label for="transCountry">بلد الناسخ</label>
                <datalist id="transCountries">
                    @foreach ($transCountries as $transCountry)
                        <option value="{{ $transCountry->name }}" data-id="{{ $transCountry->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-select" name="transCity" id="transCity" list="transCities"
                    wire:model="transCity">
                <label for="transCity">مدينة الناسخ</label>
                <datalist id="transCities">
                    @foreach ($transCities as $transCity)
                        <option value="{{ $transCity->name }}" data-id="{{ $transCity->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>


    <div class="row justify-content-center mb-3">
        <div class="col-md-9">
            <h5 class="my_line"><span>ما يتعلق بالنسخة</span></h5>
        </div>
    </div>


    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="form-floating">
                <input type="text" class="form-select" name="cabinet" id="cabinet" list="cabinets"
                    wire:model="cabinet">
                <label for="cabinet">الخزانة</label>
                <datalist id="cabinets">
                    @foreach ($cabinets as $cabinet)
                        <option value="{{ $cabinet->name }}" data-id="{{ $cabinet->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-select" name="transcribed_from" id="transcribed_from"
                    list="transcribedFromList" wire:model="transcribed_from">
                <label for="transcribed_from">المنسوخ منه</label>
                <datalist id="transcribedFromList">
                    @foreach ($transcribedFromList as $transcriber)
                        <option value="{{ $transcriber->transcribed_from }}">
                    @endforeach
                </datalist>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-select" name="transcribed_to" id="transcribed_to"
                    list="transcribedToList" wire:model="transcribed_to">
                <label for="transcribed_to">المنسوخ له</label>
                <datalist id="transcribedToList">
                    @foreach ($transcribedToList as $transcriber)
                        <option value="{{ $transcriber->transcribed_to }}">
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="regular_lines" name="regular_lines">
                    <option selected></option>
                    <option value="1">منتظمة</option>
                    <option value="0">غير منتظمة</option>
                </select>
                <label for="floatingSelect">المسطرة</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="is_truncated" name="is_truncated">
                    <option selected></option>
                    <option value="1">تامة</option>
                    <option value="0">مبتورة</option>
                </select>
                <label for="floatingSelect">التمام والبتر</label>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="signed_in" name="signed_in">
                    <option selected></option>
                    <option value="1">موقعة</option>
                    <option value="0">بالمقارنة</option>
                </select>
                <label for="floatingSelect">التوقيع</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="rost_completion" name="rost_completion">
                    <option selected></option>
                    <option value="1">نعم</option>
                    <option value="0">لا</option>
                </select>
                <label for="floatingSelect">الترميم والإتمام</label>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="font" name="font" wire:model="font">
                    <option selected></option>
                    <option value="مغربي">مغربي</option>
                    <option value="مشرقي">مشرقي</option>
                </select>
                <label for="floatingSelect">الخط</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-select" name="font_style" id="font_style" list="fontStyles">
                <label for="font_style">نوع الخط</label>
                <datalist id="fontStyles">
                    @if ($font == 'مغربي')
                        @foreach ($w_font_styles as $fontStyle)
                            <option value="{{ $fontStyle }}">
                        @endforeach
                    @elseif($font == 'مشرقي')
                        @foreach ($e_font_styles as $fontStyle)
                            <option value="{{ $fontStyle }}">
                        @endforeach
                    @endif
                </datalist>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="manuscript_level" name="manuscript_level">
                    <option selected></option>
                    <option value="جيدة">جيدة</option>
                    <option value="حسنة">حسنة</option>
                    <option value="متوسطة">متوسطة</option>
                    <option value="رديئة">رديئة</option>
                </select>
                <label for="floatingSelect">مستوى النسخة من حيث الوضوح والرداءة</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="transcriber_level" name="transcriber_level">
                    <option selected></option>
                    <option value="جيدة">جيدة</option>
                    <option value="حسنة">حسنة</option>
                    <option value="متوسطة">متوسطة</option>
                    <option value="رديئة">رديئة</option>
                </select>
                <label for="floatingSelect">مستوى النسخة من حيث الجودة والضبط</label>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="paper_size" name="paper_size">
                    <option selected></option>
                    <option value="1">القطع الكبير</option>
                    <option value="2">القطع المتوسط</option>
                    <option value="3">القطع الصغير</option>
                </select>
                <label for="floatingSelect">حجم الورق</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="save_status" name="save_status">
                    <option selected></option>
                    <option value="حسنة">حسنة</option>
                    <option value="من حسنة إلى متوسطة">من حسنة إلى متوسطة</option>
                    <option value="متوسطة">متوسطة</option>
                    <option value="من متوسطة إلى رديئة">من متوسطة إلى رديئة</option>
                    <option value="رديئة">رديئة</option>
                </select>
                <label for="floatingSelect">حالة الحفظ</label>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-2">
            <div class="form-floating">
                <input type="number" class="form-control text-center" id="nbr_in_index" name="nbr_in_index">
                <label for="floatingSelect">الرقم في الفهرس</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="number" class="form-control text-center" id="nbr_in_cabinet" name="nbr_in_cabinet">
                <label for="floatingSelect">الرقم في الخزانة</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="manu_type" name="manu_type">
                    <option selected></option>
                    <option value="مج">مجلد</option>
                    <option value="مص">مصحف</option>
                    <option value="دغ">دون غلاف</option>
                </select>
                <label for="floatingSelect">نوع النسخة</label>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-select" name="country" id="country" list="countries"
                    wire:model="country">
                <label for="country">بلد النسخ</label>
                <datalist id="countries">
                    @foreach ($countries as $country)
                        <option value="{{ $country->name }}" data-id="{{ $country->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-floating">
                <input type="number" class="form-control text-center" name="trans_syear" id="trans_syear">
                <label for="trans_syear">فترة النسخ: من (هجري)</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="number" class="form-control text-center" name="trans_eyear" id="trans_eyear">
                <label for="trans_eyear">فترة النسخ: إلى (هجري)</label>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-select" name="city" id="city" list="cities" wire:model="city">
                <label for="city">مدينة النسخ</label>
                <datalist id="cities">
                    @foreach ($cities as $city)
                        <option value="{{ $city->name }}" data-id="{{ $city->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-floating">
                <input type="number" class="form-control text-center" name="trans_syear_m" id="trans_syear_m">
                <label for="trans_syear_m">فترة النسخ: من (ميلادي)</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-floating">
                <input type="number" class="form-control text-center" name="trans_eyear_m" id="trans_eyear_m">
                <label for="trans_eyear_m">فترة النسخ: إلى (ميلادي)</label>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-7">
            <div class="form-floating">
                <input type="text" class="form-select" id="manutype" list="manutypes" wire:model="manutype"
                    onchange="getManutype()">
                <label for="manutype">عمل الناسخ</label>
                <datalist id="manutypes">
                    @foreach ($manutypes as $manutype)
                        <option value="{{ $manutype->name }}" data-id="{{ $manutype->id }}">
                    @endforeach
                </datalist>
                <!--- List of manutypes badges -->
                <div id="manutypesBadges">
                    @foreach ($manutypesArray as $manutype)
                        <p class="badge rounded-pill bg-success mx-1 p-2 mt-2">
                            {{ $manutype }}
                            <a wire:click="deleteManutype('{{ $manutype }}')"
                                onclick="deleteManutype('{{ $manutype }}')" style="cursor: pointer"
                                class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <!--- add manutype icon -->
        <div class="col-md-1"><br>
            <a style="cursor: pointer" wire:click="pushToManutypes(manutype_name)" onclick="setManutypes()">
                <i class="fas fa-plus-circle fs-4"></i>
            </a>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-7">
            <div class="form-floating">
                <input type="text" class="form-select" id="color" list="colors" wire:model="color"
                    onchange="getColor()">
                <label for="color">ألوان الحبر</label>
                <datalist id="colors">
                    @foreach ($colors as $color)
                        <option value="{{ $color->name }}" data-id="{{ $color->id }}">
                    @endforeach
                </datalist>
                <!--- List of colors badges -->
                <div id="colorsBadges">
                    @foreach ($colorsArray as $color)
                        <p class="badge rounded-pill bg-success mx-1 p-2 mt-2">
                            {{ $color }}
                            <a wire:click="deleteColor('{{ $color }}')"
                                onclick="deleteColor('{{ $color }}')" style="cursor: pointer"
                                class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <!--- add color icon -->
        <div class="col-md-1"><br>
            <a style="cursor: pointer" wire:click="pushToColors(color_name)" onclick="setColors()">
                <i class="fas fa-plus-circle fs-4"></i>
            </a>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-7">
            <div class="form-floating">
                <input type="text" class="form-select" id="motif" list="motifs" wire:model="motif"
                    onchange="getMotif()">
                <label for="motif">الزخارف</label>
                <datalist id="motifs">
                    @foreach ($motifs as $motif)
                        <option value="{{ $motif->name }}" data-id="{{ $motif->id }}">
                    @endforeach
                </datalist>
                <!--- List of motifs badges -->
                <div id="motifsBadges">
                    @foreach ($motifsArray as $motif)
                        <p class="badge rounded-pill bg-success mx-1 p-2 mt-2">
                            {{ $motif }}
                            <a wire:click="deleteMotif('{{ $motif }}')"
                                onclick="deleteMotif('{{ $motif }}')" style="cursor: pointer"
                                class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
        <!--- add motif icon -->
        <div class="col-md-1"><br>
            <a style="cursor: pointer" wire:click="pushToMotifs(motif_name)" onclick="setMotifs()">
                <i class="fas fa-plus-circle fs-4"></i>
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary px-5"><i class="fad fa-search"></i> بحث</button>
            <button type="button" class="btn btn-dark px-5" wire:click="resetForm()"><i class="fad fa-times"></i>
                إلغاء</button>
        </div>
    </div>
</div>
