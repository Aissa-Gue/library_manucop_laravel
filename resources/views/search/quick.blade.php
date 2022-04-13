<?php
$subNavs = [
    [
        'text' => 'بحث سريع',
        'icon' => 'fas fa-search',
        'route' => 'search.quick.manuscripts',
        'request' => 'search/quick/*',
    ],
    [
        'text' => 'بحث متقدم',
        'icon' => 'fas fa-telescope',
        'route' => 'search.advanced.manuscripts',
        'request' => 'search/advanced/*',
    ],
];
?>
<div>
    @extends('layouts.app')

    @section('content')
        @include('includes.subNavs', $subNavs)
        <div class="row justify-content-center mb-3 ">
            <div class="col-md-8">
                <ul class="nav nav-pills bg-white py-1">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('search.quick.manuscripts') ? 'active' : '' }}"
                            href="{{ Route('search.quick.manuscripts') }}">الاستمارت</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('search.quick.transcribers') ? 'active' : '' }}"
                            href="{{ Route('search.quick.transcribers') }}">النساخ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('search.quick.books') ? 'active' : '' }}"
                            href="{{ Route('search.quick.books') }}">الكتب</a>
                    </li>
                    {{-- <div class="offset-6">
                        <a class="btn btn-outline-success" href="{{ Route('search.results') }}">نتائج البحث</a>
                    </div> --}}
                </ul>
            </div>
        </div>
        @if (Route::is('search.quick.manuscripts'))
            <livewire:search.quick-search-manuscripts />
        @elseif (Route::is('search.quick.transcribers'))
            <livewire:search.quick-search-transcribers />
        @elseif (Route::is('search.quick.books'))
            <div class="row">
                <form id="quickSearchForm" action="{{ Route('search.quick.bookSearch') }}" method="get">
                    <livewire:search.quick-search-books />
                    <div id="hiddenDiv">

                    </div>
                </form>
            </div>
        @endif


        <script>
            // subjects
            var subject_name = [],
                subjects = [];

            function setSubjects() {
                $('#hiddenDiv').empty();
                subjects.forEach(element => {
                    $('#hiddenDiv').append('<input type="hidden" name="subjects[]" value="' + element + '">');
                });
            }

            function getSubject() {
                subject_name = $("#subject").val();
                if (!subjects.includes(subject_name)) {
                    subjects.push(subject_name);
                }
                console.log(subject);
            }

            function deleteSubject(val) {
                subjects.splice($.inArray(val, subjects), 1);
                setSubjects();
            }
        </script>
    @endsection

</div>
