@extends('layouts.app')

@section('content')
    @include('dashboard.cards')
    <!-- table  -->
    <div class="row my-3">
        <div class="col-md-6 bg-light">
            <table class="table table-hover caption-top">
                {{-- <caption class="bg-light caption-top fw-bold text-center">عدد المخطوطات حسب حالة الحفظ --}}
                <caption class="alert alert-secondary caption-top fw-bold text-center mb-1">عدد المخطوطات حسب حالة الحفظ
                </caption>
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الحالة</th>
                        <th scope="col" class="text-center">عدد المخطوطات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>حسنة</td>
                        <td class="fw-bold text-center">
                            @if ($by_save_status->where('save_status', 'حسنة')->count() > 0)
                                @foreach ($by_save_status as $status)
                                    {{ $status->save_status == 'حسنة' ? $status->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>من حسنة إلى متوسطة</td>
                        <td class="fw-bold text-center">
                            @if ($by_save_status->where('save_status', 'من حسنة إلى متوسطة')->count() > 0)
                                @foreach ($by_save_status as $status)
                                    {{ $status->save_status == 'من حسنة إلى متوسطة' ? $status->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">3</th>
                        <td>متوسطة</td>
                        <td class="fw-bold text-center">
                            @if ($by_save_status->where('save_status', 'متوسطة')->count() > 0)
                                @foreach ($by_save_status as $status)
                                    {{ $status->save_status == 'متوسطة' ? $status->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">4</th>
                        <td>من متوسطة إلى رديئة</td>
                        <td class="fw-bold text-center">
                            @if ($by_save_status->where('save_status', 'من متوسطة إلى رديئة')->count() > 0)
                                @foreach ($by_save_status as $status)
                                    {{ $status->save_status == 'من متوسطة إلى رديئة' ? $status->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">5</th>
                        <td>رديئة</td>
                        <td class="fw-bold text-center">
                            @if ($by_save_status->where('save_status', 'رديئة')->count() > 0)
                                @foreach ($by_save_status as $status)
                                    {{ $status->save_status == 'رديئة' ? $status->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="chart1" class="bg-light p-3 col-md-6"></div>
        <script>
            /************** chart 01 **************/
            var options = {
                series: [
                    @foreach ($by_cabinets as $cabinet)
                        {{ $cabinet->total . ',' }}
                    @endforeach
                ],
                labels: [
                    @foreach ($by_cabinets as $cabinet)
                        '{{ $cabinet->cabinet->name }}',
                    @endforeach
                ],
                chart: {
                    type: 'polarArea',
                    height: 320
                },
                dataLabels: {
                    enabled: true,
                },
                title: {
                    text: 'عدد المخطوطات حسب الخزائن',
                    align: 'center',
                    margin: 20,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '17px',
                        fontWeight: 'bold',
                        fontFamily: undefined,
                        color: '#263238'
                    },
                },
                stroke: {
                    colors: ['#fff']
                },
                fill: {
                    opacity: 0.9
                },
                legend: {
                    show: false,
                    position: 'bottom',
                },
                yaxis: {
                    show: false,
                }
            };

            var chart1 = new ApexCharts(document.querySelector("#chart1"), options);
            chart1.render();
        </script>
    </div>

    <div class="row my-3">
        <div class="col-md-6 bg-light">
            <table class="table table-hover caption-top">
                <caption class="alert alert-secondary caption-top fw-bold text-center mb-1">عدد المخطوطات حسب الجودة
                </caption>
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الحالة</th>
                        <th scope="col" class="text-center">الوضوح والرداءة</th>
                        <th scope="col" class="text-center">الجودة والضبط</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>جيدة</td>
                        <td class="fw-bold text-center">
                            @if ($by_manuscript_level->where('manuscript_level', 'جيدة')->count() > 0)
                                @foreach ($by_manuscript_level as $manuLevel)
                                    {{ $manuLevel->manuscript_level == 'جيدة' ? $manuLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                        <td class="fw-bold text-center">
                            @if ($by_transcriber_level->where('transcriber_level', 'جيدة')->count() > 0)
                                @foreach ($by_transcriber_level as $transLevel)
                                    {{ $transLevel->transcriber_level == 'جيدة' ? $transLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>حسنة</td>
                        <td class="fw-bold text-center">
                            @if ($by_manuscript_level->where('manuscript_level', 'حسنة')->count() > 0)
                                @foreach ($by_manuscript_level as $manuLevel)
                                    {{ $manuLevel->manuscript_level == 'حسنة' ? $manuLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                        <td class="fw-bold text-center">
                            @if ($by_transcriber_level->where('transcriber_level', 'حسنة')->count() > 0)
                                @foreach ($by_transcriber_level as $transLevel)
                                    {{ $transLevel->transcriber_level == 'حسنة' ? $transLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>متوسطة</td>
                        <td class="fw-bold text-center">
                            @if ($by_manuscript_level->where('manuscript_level', 'متوسطة')->count() > 0)
                                @foreach ($by_manuscript_level as $manuLevel)
                                    {{ $manuLevel->manuscript_level == 'متوسطة' ? $manuLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                        <td class="fw-bold text-center">
                            @if ($by_transcriber_level->where('transcriber_level', 'متوسطة')->count() > 0)
                                @foreach ($by_transcriber_level as $transLevel)
                                    {{ $transLevel->transcriber_level == 'متوسطة' ? $transLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>رديئة</td>
                        <td class="fw-bold text-center">
                            @if ($by_manuscript_level->where('manuscript_level', 'رديئة')->count() > 0)
                                @foreach ($by_manuscript_level as $manuLevel)
                                    {{ $manuLevel->manuscript_level == 'رديئة' ? $manuLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                        <td class="fw-bold text-center">
                            @if ($by_transcriber_level->where('transcriber_level', 'رديئة')->count() > 0)
                                @foreach ($by_transcriber_level as $transLevel)
                                    {{ $transLevel->transcriber_level == 'رديئة' ? $transLevel->total : '' }}
                                @endforeach
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="chart3" class="bg-light col-md-6"></div>
        <script>
            /************** chart 03 **************/

            var options = {
                series: [{
                    name: 'المخطوطات',
                    data: [
                        @foreach ($by_manutypes as $manutype)
                            {{ $manutype->total . ',' }}
                        @endforeach
                    ]
                }],
                title: {
                    text: 'عدد المخطوطات حسب عمل الناسخ',
                    align: 'center',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '17px',
                        fontWeight: 'bold',
                        fontFamily: undefined,
                        color: '#263238'
                    },
                },
                chart: {
                    type: 'bar',
                    height: 300
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '40%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [
                        @foreach ($by_manutypes as $manutype)
                            '{{ $manutype->name }}',
                        @endforeach
                    ],
                },
                yaxis: {
                    title: {
                        text: ' (العدد)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };

            var chart3 = new ApexCharts(document.querySelector("#chart3"), options);
            chart3.render();
        </script>
    </div>

    <div class="row my-4">
        <div id="chart2" class="bg-light p-2 col-md-12"></div>
        <script>
            /************** chart 02 **************/
            var options = {
                series: [{
                        name: 'المخطوطات',
                        data: [
                            @foreach ($by_subjects1 as $subject)
                                {{ $subject->total }},
                            @endforeach
                        ]
                    },
                    {
                        name: 'الكتب',
                        data: [
                            @foreach ($by_subjects2 as $subject)
                                {{ $subject->total }},
                            @endforeach
                        ]
                    }
                ],
                title: {
                    text: 'عدد الكتب / المخطوطات حسب المواضيع',
                    align: 'center',
                    margin: 10,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '17px',
                        fontWeight: 'bold',
                        fontFamily: undefined,
                        color: '#263238'
                    },
                },
                chart: {
                    type: 'bar',
                    height: 500
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [
                        @foreach ($by_subjects2 as $subject)
                            '{{ $subject->name }}',
                        @endforeach
                    ],
                },
                yaxis: {
                    title: {
                        text: ' (العدد)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };

            var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
            chart2.render();
        </script>
    </div>
@endsection
