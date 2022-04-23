<?php
$page = ['title' => 'معلومات الاستمارة'];
$i = 0;
?>

@extends('layouts.app', $page)

@section('content')
    @if (session()->has('message'))
        @include('includes.alert')
    @endif

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">معلومات الناسخ</legend>
        <div class="row justify-content-end">
            <div class="col-md-auto">
                <form action="{{ Route('manuscripts.destroy', $manuscript->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a class="btn text-primary fs-5" href="{{ Route('manuscripts.edit', $manuscript->id) }}"><i
                            class="fas fa-edit"></i></a>
                    <button class="btn text-danger fs-5" type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        @foreach ($manuscript->transcribers as $transcriber)
            <section class="manuscripts_show">
                @if ($manuscript->transcribers->count() > 1)
                    <h5 class="my_line"><span>{{ 'الناسخ ' . ++$i }}</span></h5>
                @endif
                <div class="row mb-2">
                    <div class="col-md-auto">
                        <h5 class="text-dark">الرقم: </h5>
                    </div>
                    <div class="col-md-1">
                        <p>{{ $transcriber->id }}</p>
                    </div>
                    <div class="col-md-auto">
                        <h5 class="text-dark">الاسم الكامل: </h5>
                    </div>
                    <div class="col-md-7">
                        <p>{{ $transcriber->full_name }}</p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-auto">
                        <h5 class="text-dark">الاسم الوارد في النسخة: </h5>
                    </div>
                    <div class="col-md-auto">
                        <p>{{ $transcriber->pivot->name_in_manu }}</p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-auto">
                        <h5 class="text-dark">النسبة (1): </h5>
                    </div>
                    <div class="col-md-2">
                        @if ($transcriber->descent1)
                            <p>{{ $transcriber->descent1 }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                    <div class="col-md-auto">
                        <h5 class="text-dark">النسبة (2): </h5>
                    </div>
                    <div class="col-md-2">
                        @if ($transcriber->descent2)
                            <p>{{ $transcriber->descent2 }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                    <div class="col-md-auto">
                        <h5 class="text-dark">النسبة (3): </h5>
                    </div>
                    <div class="col-md-2">
                        @if ($transcriber->descent3)
                            <p>{{ $transcriber->descent3 }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-auto">
                        <h5 class="text-dark">النسبة (4): </h5>
                    </div>
                    <div class="col-md-2">
                        @if ($transcriber->descent4)
                            <p>{{ $transcriber->descent4 }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>

                    <div class="col-md-auto">
                        <h5 class="text-dark">النسبة (5): </h5>
                    </div>
                    <div class="col-md-2">
                        @if ($transcriber->descent5)
                            <p>{{ $transcriber->descent5 }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-auto">
                        <h5 class="text-dark">اللقب (اسم الشهرة): </h5>
                    </div>
                    <div class="col-md-3">
                        @if ($transcriber->last_name)
                            <p>{{ $transcriber->last_name }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                    <div class="col-md-auto">
                        <h5 class="text-dark">الكنية (5): </h5>
                    </div>
                    <div class="col-md-2">
                        @if ($transcriber->nickname)
                            <p>{{ $transcriber->nickname }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-auto">
                        <h5 class="text-dark">بلد الناسخ: </h5>
                    </div>
                    <div class="col-md-4">
                        @if ($transcriber->country)
                            <p>{{ $transcriber->country->name }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                    <div class="col-md-auto">
                        <h5 class="text-dark">مدينة الناسخ: </h5>
                    </div>
                    <div class="col-md-4">
                        @if ($transcriber->city)
                            <p>{{ $transcriber->city->name }}</p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                </div>

                @if ($transcriber->other_name1)
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <h5 class="text-dark">صيغ أخرى لاسم الناسخ: </h5>
                        </div>
                        <div class="col-md-auto">
                            <p>{{ $transcriber->other_name1 }}</p>
                        </div>
                    </div>
                @endif

                @if ($transcriber->other_name2)
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="text-dark"></h5>
                        </div>
                        <div class="col-md-auto">
                            <p>{{ $transcriber->other_name2 }}</p>
                        </div>
                    </div>
                @endif

                @if ($transcriber->other_name3)
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="text-dark"></h5>
                        </div>
                        <div class="col-md-auto">
                            <p>{{ $transcriber->other_name3 }}</p>
                        </div>
                    </div>
                @endif

                @if ($transcriber->other_name4)
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="text-dark"></h5>
                        </div>
                        <div class="col-md-auto">
                            <p>{{ $transcriber->other_name4 }}</p>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-dark"> النساخ المشابهين في الخط: </h5>
                    </div>
                    <div class="col-md-auto">
                        @if ($fontMatchers->count() == 0)
                            <p class="text-success">/ / /</p>
                        @else
                            @foreach ($fontMatchers as $fontMatcher)
                                @if ($transcriber->id == $fontMatcher->transcriber_id)
                                    <p>{{ $fontMatcher->transcriber2->full_name }}{{ $fontMatcher->transcriber2->descent1 ? ' ' . $fontMatcher->transcriber2->descent1 : '' }}{{ $fontMatcher->transcriber2->descent2 ? ' ' . $fontMatcher->transcriber2->descent2 : '' }}{{ $fontMatcher->transcriber2->descent3 ? ' ' . $fontMatcher->transcriber2->descent3 : '' }}{{ $fontMatcher->transcriber2->descent4 ? ' ' . $fontMatcher->transcriber2->descent4 : '' }}{{ $fontMatcher->transcriber2->descent5 ? ' ' . $fontMatcher->transcriber2->descent5 : '' }}{{ $fontMatcher->transcriber2->last_name ? ' ' . $fontMatcher->transcriber2->last_name : '' }}{{ $fontMatcher->transcriber2->nickname ? ' (' . $fontMatcher->transcriber2->nickname . ')' : '' }}
                                    </p>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
        @endforeach
        </section>
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">معلومات النسخة</legend>
        <section class="manuscripts_show">
            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">الرقم: </h5>
                </div>
                <div class="col-md-1">
                    <p>{{ $manuscript->id }}</p>
                </div>
                <div class="col-md-auto">
                    <h5 class="text-dark">عنوان الكتاب: </h5>
                </div>
                <div class="col-md-auto">
                    <p>{{ $manuscript->book->title }}</p>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">المؤلفين: </h5>
                </div>

                @if (!$manuscript->book->authors)
                    <div class="col-md-auto">
                        <p class="text-success">/ / /</p>
                    </div>
                @else
                    @php $i = 0 @endphp
                    @foreach ($manuscript->book->authors as $author)
                        @php $i++ @endphp
                        @if ($i == 1)
                            <div class="col-md-10">
                                <p>{{ $author->name }}</p>
                            </div>
                        @else
                            <div class="col-md-2">
                                <p class="text-success"></p>
                            </div>
                            <div class="col-md-10">
                                <p>{{ $author->name }}</p>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">المواضيع: </h5>
                </div>

                @if (!$manuscript->book->subjects)
                    <div class="col-md-auto">
                        <p class="text-success">/ / /</p>
                    </div>
                @else
                    @foreach ($manuscript->book->subjects as $subject)
                        <div class="col-md-auto">
                            <p>{{ $subject->name . ' /' }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="row mb-2">
                @if ($manuscript->trans_eyear === null)
                    <div class="col-md-2">
                        <h5 class="text-dark">تاريخ النسخ: </h5>
                    </div>
                    <div class="col-md-auto">
                        @if ($manuscript->trans_day_nbr or $manuscript->trans_month or $manuscript->trans_syear)
                            <p>
                                @switch($manuscript->trans_day)
                                    @case(1)
                                        {{ 'السبت' }}
                                    @break

                                    @case(2)
                                        {{ 'الأحد' }}
                                    @break

                                    @case(3)
                                        {{ 'الإثنين' }}
                                    @break

                                    @case(4)
                                        {{ 'الثلاثاء' }}
                                    @break

                                    @case(5)
                                        {{ 'الأربعاء' }}
                                    @break

                                    @case(6)
                                        {{ 'الخميس' }}
                                    @break

                                    @case(7)
                                        {{ 'الجمعة' }}
                                    @break
                                @endswitch
                                {{ ' ' . $manuscript->trans_day_nbr . ' ' }}
                                @switch($manuscript->trans_month)
                                    @case(1)
                                        {{ 'محرم' }}
                                    @break

                                    @case(2)
                                        {{ 'صفر' }}
                                    @break

                                    @case(3)
                                        {{ 'ربيع الأول' }}
                                    @break

                                    @case(4)
                                        {{ 'ربيع الثاني' }}
                                    @break

                                    @case(5)
                                        {{ 'جمادى الأولى' }}
                                    @break

                                    @case(6)
                                        {{ 'جمادى الثانية' }}
                                    @break

                                    @case(7)
                                        {{ 'رجب' }}
                                    @break

                                    @case(8)
                                        {{ 'شعبان' }}
                                    @break

                                    @case(9)
                                        {{ 'رمضان' }}
                                    @break

                                    @case(10)
                                        {{ 'شوال' }}
                                    @break

                                    @case(11)
                                        {{ 'ذو القعدة' }}
                                    @break

                                    @case(12)
                                        {{ 'ذو الحجة' }}
                                    @break
                                @endswitch
                                {{ ' ' . $manuscript->trans_syear . ' / ' . 'هجري' }}
                            </p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                @else
                    <div class="col-md-2">
                        <h5 class="text-dark">فترة النسخ: </h5>
                    </div>
                    <div class="col-md-auto">
                        <p>
                            {{ ' من سنة: ' . $manuscript->trans_syear . ' إلى سنة: ' . $manuscript->trans_eyear . ' / ' . 'هجري' }}
                        </p>
                    </div>
                @endif
            </div>

            <div class="row mb-2">
                @if ($manuscript->trans_eyear_m == null)
                    <div class="col-md-2">
                        <h5 class="text-dark"></h5>
                    </div>
                    <div class="col-md-auto">
                        @if ($manuscript->trans_day_nbr_m or $manuscript->trans_month_m or $manuscript->trans_syear_m)
                            <p>
                                @switch($manuscript->trans_day)
                                    @case(1)
                                        {{ 'السبت' }}
                                    @break

                                    @case(2)
                                        {{ 'الأحد' }}
                                    @break

                                    @case(3)
                                        {{ 'الإثنين' }}
                                    @break

                                    @case(4)
                                        {{ 'الثلاثاء' }}
                                    @break

                                    @case(5)
                                        {{ 'الأربعاء' }}
                                    @break

                                    @case(6)
                                        {{ 'الخميس' }}
                                    @break

                                    @case(7)
                                        {{ 'الجمعة' }}
                                    @break
                                @endswitch
                                {{ ' ' . $manuscript->trans_day_nbr_m . ' ' }}

                                @switch($manuscript->trans_month_m)
                                    @case(1)
                                        {{ 'جانفي' }}
                                    @break

                                    @case(2)
                                        {{ 'فيفري' }}
                                    @break

                                    @case(3)
                                        {{ 'مارس' }}
                                    @break

                                    @case(4)
                                        {{ 'أفريل' }}
                                    @break

                                    @case(5)
                                        {{ 'ماي' }}
                                    @break

                                    @case(6)
                                        {{ 'جوان' }}
                                    @break

                                    @case(7)
                                        {{ 'جويلية' }}
                                    @break

                                    @case(8)
                                        {{ 'أوت' }}
                                    @break

                                    @case(9)
                                        {{ 'سبتمبر' }}
                                    @break

                                    @case(10)
                                        {{ 'أكتوبر' }}
                                    @break

                                    @case(11)
                                        {{ 'نوفمبر' }}
                                    @break

                                    @case(12)
                                        {{ 'ديسمبر' }}
                                    @break
                                @endswitch

                                {{ ' ' . $manuscript->trans_syear_m . ' / ' . 'ميلادي' }}
                            </p>
                        @else
                            <p class="text-success">/ / /</p>
                        @endif
                    </div>
                @else
                    <div class="col-md-2">
                        <h5 class="text-dark"></h5>
                    </div>
                    <div class="col-md-auto">
                        <p>
                            {{ ' من سنة: ' . $manuscript->trans_syear_m . ' إلى سنة: ' . $manuscript->trans_eyear_m . ' / ' . 'ميلادي' }}
                        </p>
                    </div>
                @endif
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">مكان النسخ: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->trans_place)
                        <p>{{ $manuscript->trans_place }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-dark">المدينة: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->city)
                        <p>{{ $manuscript->city->name }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-dark">البلد حاليا: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->country)
                        <p>{{ $manuscript->country->name }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">النسخة: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->signed_in)
                        <p>{{ $manuscript->signed_in ? 'موقعة' : 'بالمقارنة' }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">اسم الخزانة: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->cabinet)
                        <p>{{ $manuscript->cabinet->name }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-dark">الرقم في الخزانة: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->nbr_in_cabinet or $manuscript->manu_type)
                        <p>
                            {{ $manuscript->paper_size . '/ ' . $manuscript->nbr_in_cabinet }}
                            @if ($manuscript->manutype != 'مج')
                                {{ ' ' . $manuscript->manu_type }}
                            @endif
                        </p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto mt-2">
                    <h5 class="text-dark">الرقم في الفهرس: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->nbr_in_index)
                        <p>{{ $manuscript->nbr_in_index }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <h5 class="my_line"><span>الوصف المادي</span></h5>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">الخط: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->font)
                        <p>{{ $manuscript->font }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>

                <div class="col-md-auto">
                    <h5 class="text-dark">نوعه: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->font_style)
                        <p>{{ $manuscript->font_style }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">مستوى النسخة من حيث الوضوح والرداءة: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->manuscript_level)
                        <p>{{ $manuscript->manuscript_level }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">مقاس الورق: </h5>
                </div>
                <div class="col-md-2">
                    @if ($manuscript->paper_size)
                        <p>
                            @switch($manuscript->paper_size)
                                @case(1)
                                    {{ 'القطع الكبير' }}
                                @break

                                @case(2)
                                    {{ 'القطع المتوسط' }}
                                @break

                                @case(3)
                                    {{ 'القطع الصغير' }}
                                @break
                            @endswitch
                        </p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>

                <div class="col-md-auto">
                    <h5 class="text-dark">ملاحظات على المقاس: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->size_notes)
                        <p>{{ $manuscript->size_notes }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">المسطرة: </h5>
                </div>
                <div class="col-md-2">
                    @if ($manuscript->regular_lines !== null)
                        <p>{{ $manuscript->regular_lines ? 'منتظمة' : 'غير منتظمة' }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>

                <div class="col-md-auto">
                    <h5 class="text-dark">ملاحظات على المسطرة: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->lines_notes)
                        <p>{{ $manuscript->lines_notes }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">التمام والبتر: </h5>
                </div>
                <div class="col-md-2">
                    @if ($manuscript->is_not_truncated !== null)
                        <p>{{ $manuscript->is_not_truncated ? 'تامة' : 'مبتورة' }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>

                <div class="col-md-auto">
                    <h5 class="text-dark">مكان البتر: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->truncation_notes)
                        <p>{{ $manuscript->truncation_notes }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>


            <div class="row mb-2">
                <div class="col-md-2">
                    <h5 class="text-dark">عدد الصفحات: </h5>
                </div>
                <div class="col-md-2">
                    @if ($manuscript->nbr_of_papers)
                        <p>{{ $manuscript->nbr_of_papers . ' صفحة' }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-dark">حالة الحفظ: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->save_status)
                        <p>{{ $manuscript->save_status }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>


            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">الزخارف المستعملة: </h5>
                </div>
                @if ($manuscript->motifs->count() == 0)
                    <div class="col-md-auto">
                        <p class="text-success">/ / /</p>
                    </div>
                @else
                    <div class="col-md-auto">
                        <p>
                            @foreach ($manuscript->motifs as $motif)
                                {{ $motif->name . ' / ' }}
                            @endforeach
                        </p>
                    </div>
                @endif
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">ألوان الحبر المستعملة: </h5>
                </div>
                @if ($manuscript->colors->count() == 0)
                    <div class="col-md-auto">
                        <p class="text-success">/ / /</p>
                    </div>
                @else
                    <div class="col-md-auto">
                        <p>
                            @foreach ($manuscript->colors as $color)
                                {{ $color->name . ' / ' }}
                            @endforeach
                        </p>
                    </div>
                @endif
            </div>


            <h5 class="my_line"><span>عمل الناسخ ومستوى النسخة</span></h5>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">عمل الناسخ عدا نقل المحتوى: </h5>
                </div>
                @if ($manuscript->manutypes->count() == 0)
                    <div class="col-md-auto">
                        <p class="text-success">/ / /</p>
                    </div>
                @else
                    <div class="col-md-auto">
                        <p>
                            @foreach ($manuscript->manutypes as $manutype)
                                {{ $manutype->name . ' / ' }}
                            @endforeach
                        </p>
                    </div>
                @endif
            </div>


            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">مستوى النسخة من حيث الجودة والضبط: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->transcriber_level)
                        <p>{{ $manuscript->transcriber_level }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>


            <h5 class="my_line"><span>الملاحظات</span></h5>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">الأصل المنسوخ منه: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->transcribed_from)
                        <p>{{ $manuscript->transcribed_from }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">المنسوخ له: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->transcribed_to)
                        <p>{{ $manuscript->transcribed_to }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>


            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">ترميم وإتمام: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->rost_completion !== null)
                        <p>{{ $manuscript->rost_completion ? 'نعم' : 'لا' }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-dark">ملاحظات أخرى: </h5>
                </div>
                <div class="col-md-auto">
                    @if ($manuscript->notes)
                        <p>{{ $manuscript->notes }}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>
        </section>
    </fieldset>
@endsection
