<?php
$page = ['title' => 'معلومات الاستمارة'];
$i = 0;
?>

@extends('layouts.app', $page)

@section('content')
    <fieldset class="scheduler-border">
        <legend class="scheduler-border mb-3">معلومات الناسخ</legend>
        @foreach($manuscript->transcribers as $transcriber)
            @if($manuscript->transcribers->count() > 1)
                <h5 class="my_line"><span>{{'الناسخ ' . ++$i}}</span></h5>
            @endif

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-danger">الرقم: </h5>
                </div>
                <div class="col-md-1">
                    <p>{{$transcriber->id}}</p>
                </div>
                <div class="col-md-auto">
                    <h5 class="text-danger">الاسم الكامل: </h5>
                </div>
                <div class="col-md-7">
                    <p>{{$transcriber->full_name}}</p>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-danger">الاسم الوارد في النسخة: </h5>
                </div>
                <div class="col-md-auto">
                    <p>{{$transcriber->name_in_manu}}</p>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-danger">النسبة (1): </h5>
                </div>
                <div class="col-md-2">
                    @if($transcriber->descent1)
                        <p>{{$transcriber->descent1}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-danger">النسبة (2): </h5>
                </div>
                <div class="col-md-2">
                    @if($transcriber->descent2)
                        <p>{{$transcriber->descent2}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-danger">النسبة (3): </h5>
                </div>
                <div class="col-md-2">
                    @if($transcriber->descent3)
                        <p>{{$transcriber->descent3}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-danger">النسبة (4): </h5>
                </div>
                <div class="col-md-2">
                    @if($transcriber->descent4)
                        <p>{{$transcriber->descent4}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>

                <div class="col-md-auto">
                    <h5 class="text-danger">النسبة (5): </h5>
                </div>
                <div class="col-md-2">
                    @if($transcriber->descent5)
                        <p>{{$transcriber->descent5}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-danger">اللقب (اسم الشهرة): </h5>
                </div>
                <div class="col-md-3">
                    @if($transcriber->last_name)
                        <p>{{$transcriber->last_name}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-danger">الكنية (5): </h5>
                </div>
                <div class="col-md-2">
                    @if($transcriber->nickname)
                        <p>{{$transcriber->nickname}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-auto">
                    <h5 class="text-danger">بلد الناسخ: </h5>
                </div>
                <div class="col-md-4">
                    @if($transcriber->country)
                        <p>{{$transcriber->country->name}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
                <div class="col-md-auto">
                    <h5 class="text-danger">مدينة الناسخ: </h5>
                </div>
                <div class="col-md-4">
                    @if($transcriber->city)
                        <p>{{$transcriber->city->name}}</p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>
            </div>

            @if($transcriber->other_name1)
                <div class="row mb-2">
                    <div class="col-md-3">
                        <h5 class="text-danger">صيغ أخرى لاسم الناسخ: </h5>
                    </div>
                    <div class="col-md-auto">
                        <p>{{$transcriber->other_name1}}</p>
                    </div>
                </div>
            @endif

            @if($transcriber->other_name2)
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-danger"></h5>
                    </div>
                    <div class="col-md-auto">
                        <p>{{$transcriber->other_name2}}</p>
                    </div>
                </div>
            @endif

            @if($transcriber->other_name3)
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-danger"></h5>
                    </div>
                    <div class="col-md-auto">
                        <p>{{$transcriber->other_name3}}</p>
                    </div>
                </div>
            @endif

            @if($transcriber->other_name4)
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-danger"></h5>
                    </div>
                    <div class="col-md-auto">
                        <p>{{$transcriber->other_name4}}</p>
                    </div>
                </div>
            @endif

            @if($transcriber->fontMatchers->inManu($manuscript->id)->get())
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-danger"> النساخ المشابهين في الخط: </h5>
                    </div>
                    <div class="col-md-auto">
                        @foreach($transcriber->fontMatchers->inManu($manuscript->id)->get() as $fontMatcher)
                            <p>{{$fontMatcher->transcriber1->full_name}}</p>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </fieldset>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">معلومات النسخة</legend>
        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">الرقم: </h5>
            </div>
            <div class="col-md-1">
                <p>{{$manuscript->id}}</p>
            </div>
            <div class="col-md-auto">
                <h5 class="text-danger">عنوان الكتاب: </h5>
            </div>
            <div class="col-md-auto">
                <p>{{$manuscript->book->title}}</p>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-2">
                <h5 class="text-danger">المؤلفين: </h5>
            </div>

            @if(!$manuscript->book->authors)
                <div class="col-md-auto">
                    <p class="text-success">/ / /</p>
                </div>
            @else
                @php $i = 0 @endphp
                @foreach($manuscript->book->authors as $author)
                    @php $i++ @endphp
                    @if($i == 1)
                        <div class="col-md-10">
                            <p>{{$author->name}}</p>
                        </div>
                    @else
                        <div class="col-md-2">
                            <p class="text-success"></p>
                        </div>
                        <div class="col-md-10">
                            <p>{{$author->name}}</p>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="row mb-2">
            <div class="col-md-2">
                <h5 class="text-danger">المواضيع: </h5>
            </div>

            @if(!$manuscript->book->subjects)
                <div class="col-md-auto">
                    <p class="text-success">/ / /</p>
                </div>

            @else
                @foreach($manuscript->book->subjects as $subject)
                    <div class="col-md-auto">
                        <p>{{$subject->name. ' /'}}</p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row mb-2">
            @if($manuscript->trans_eyear == null)
                <div class="col-md-2">
                    <h5 class="text-danger">تاريخ النسخ: </h5>
                </div>
                <div class="col-md-auto">
                    @if($manuscript->trans_day_nbr or $manuscript->trans_month or $manuscript->trans_syear)
                        <p>
                            {{$manuscript->trans_day .' '.$manuscript->trans_day_nbr .' '.$manuscript->trans_month .' '.$manuscript->trans_syear. ' / ' . 'هجري'}}
                        </p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>

            @else
                <div class="col-md-2">
                    <h5 class="text-danger">فترة النسخ: </h5>
                </div>
                <div class="col-md-auto">
                    <p>
                        {{' من سنة: ' . $manuscript->trans_syear . ' إلى سنة: ' . $manuscript->trans_eyear . ' / ' . 'هجري'}}
                    </p>
                </div>
            @endif
        </div>

        <div class="row mb-2">
            @if($manuscript->trans_eyear_m == null)
                <div class="col-md-2">
                    <h5 class="text-danger"></h5>
                </div>
                <div class="col-md-auto">
                    @if($manuscript->trans_day_nbr_m or $manuscript->trans_month_m or $manuscript->trans_syear_m)
                        <p>
                            {{$manuscript->trans_day .' '.$manuscript->trans_day_nbr_m .' '.$manuscript->trans_month_m .' '.$manuscript->trans_syear_m. ' / ' . 'ميلادي'}}
                        </p>
                    @else
                        <p class="text-success">/ / /</p>
                    @endif
                </div>

            @else
                <div class="col-md-2">
                    <h5 class="text-danger"></h5>
                </div>
                <div class="col-md-auto">
                    <p>
                        {{' من سنة: ' . $manuscript->trans_syear_m . ' إلى سنة: ' . $manuscript->trans_eyear_m . ' / ' . 'ميلادي'}}
                    </p>
                </div>
            @endif
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">مكان النسخ: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->trans_place)
                    <p>{{$manuscript->trans_place}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
            <div class="col-md-auto">
                <h5 class="text-danger">المدينة: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->city)
                    <p>{{$manuscript->city->name}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
            <div class="col-md-auto">
                <h5 class="text-danger">البلد حاليا: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->country)
                    <p>{{$manuscript->country->name}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">نوع النسخة: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->signed_in)
                    <p>{{$manuscript->signed_in ? 'yes' : 'false'}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">اسم الخزانة: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->cabinet)
                    <p>{{$manuscript->cabinet->name}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
            <div class="col-md-auto">
                <h5 class="text-danger">الرقم في الخزانة: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->nbr_in_cabinet or $manuscript->manu_type)
                    <p>
                        {{$manuscript->nbr_in_cabinet}}
                        @if($manuscript->manutype != 'مج')
                            {{' ' .$manuscript->manu_type}}
                        @endif
                    </p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
            <div class="col-md-auto mt-2">
                <h5 class="text-danger">الرقم في الفهرس: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->nbr_in_index)
                    <p>{{$manuscript->nbr_in_index}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <h5 class="my_line"><span>تفاصيل النسخة</span></h5>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">الخط: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->font)
                    <p>{{$manuscript->font}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>

            <div class="col-md-auto">
                <h5 class="text-danger">نوعه: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->font_style)
                    <p>{{$manuscript->font_style}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">مقاس الورق: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->paper_size)
                    <p>{{$manuscript->paper_size}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">نوع المسطرة: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->regular_lines)
                    <p>{{$manuscript->regular_lines}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>

            <div class="col-md-auto">
                <h5 class="text-danger">ملاحظات على المسطرة: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->lines_notes)
                    <p>{{$manuscript->lines_notes}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">نوع الزخارف: </h5>
            </div>
            @if(!$manuscript->motifs)
                <div class="col-md-auto">
                    <p class="text-success">/ / /</p>
                </div>
            @else
                <div class="col-md-auto">
                    <p>
                        @foreach($manuscript->motifs as $motif)
                            {{$motif->name . ' / '}}
                        @endforeach
                    </p>
                </div>
            @endif
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">ألوان الحبر: </h5>
            </div>
            @if(!$manuscript->colors)
                <div class="col-md-auto">
                    <p class="text-success">/ / /</p>
                </div>
            @else
                <div class="col-md-auto">
                    <p>
                        @foreach($manuscript->colors as $color)
                            {{$color->name . ' / '}}
                        @endforeach
                    </p>
                </div>
            @endif
        </div>


        <h5 class="my_line"><span>محتوى النسخة</span></h5>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">عمل الناسخ عدا نقل المحتوى: </h5>
            </div>
            @if(!$manuscript->manutypes)
                <div class="col-md-auto">
                    <p class="text-success">/ / /</p>
                </div>
            @else
                <div class="col-md-auto">
                    <p>
                        @foreach($manuscript->manutypes as $manutype)
                            {{$manutype->name . ' / '}}
                        @endforeach
                    </p>
                </div>
            @endif
        </div>


        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">مستوى النسخة من حيث الجودة والضبط: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->transcriber_level)
                    <p>{{$manuscript->transcriber_level}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>


        <h5 class="my_line"><span>الملاحظات</span></h5>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">الأصل المنسوخ منه: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->transcribed_from)
                    <p>{{$manuscript->transcribed_from}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">المنسوخ له: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->transcribed_to)
                    <p>{{$manuscript->transcribed_to}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">مستوى النسخة من حيث الوضوح والرداءة: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->manuscript_level)
                    <p>{{$manuscript->manuscript_level}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">ترميم وإتمام: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->rost_completion)
                    <p>{{$manuscript->rost_completion}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-auto">
                <h5 class="text-danger">ملاحظات أخرى: </h5>
            </div>
            <div class="col-md-auto">
                @if($manuscript->notes)
                    <p>{{$manuscript->notes}}</p>
                @else
                    <p class="text-success">/ / /</p>
                @endif
            </div>
        </div>

    </fieldset>
@endsection
