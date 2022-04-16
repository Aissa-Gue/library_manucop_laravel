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

        <div class="row">
            <form id="advancedSearchForm" action="{{ Route('search.advanced.manuSearch') }}" method="get">
                <livewire:search.advanced-search-manuscripts />
                <div id="hiddenInputsSubject"></div>
                <div id="hiddenInputsAuthor"></div>
                <div id="hiddenInputsTranscriber"></div>
                <div id="hiddenInputsManutype"></div>
                <div id="hiddenInputsColor"></div>
                <div id="hiddenInputsMotif"></div>
                <div id="hiddenInputsCabinet"></div>

            </form>
        </div>
    @endsection
    <script>
        /********** subjects : in book_search component **********/
        var subject_name = [],
            subjects = [];

        function setSubjects() {
            $("#hiddenInputsSubject").empty();
            subjects.forEach((element) => {
                $("#hiddenInputsSubject").append(
                    '<input type="hidden" name="subjects[]" value="' + element + '">'
                );
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

        /********** Authors : in book_search component **********/
        var author_name = [],
            authors = [];

        function setAuthors() {
            $("#hiddenInputsAuthor").empty();
            authors.forEach((element) => {
                $("#hiddenInputsAuthor").append(
                    '<input type="hidden" name="authors[]" value="' + element + '">'
                );
            });
        }

        function getAuthor() {
            author_name = $("#author").val();
            if (!authors.includes(author_name)) {
                authors.push(author_name);
            }
            console.log(author);
        }

        function deleteAuthor(val) {
            author.splice($.inArray(val, author), 1);
            setAuthors();
        }

        /********** Colors : in book_search component **********/
        var color_name = [],
            colors = [];

        function setColors() {
            $("#hiddenInputsColor").empty();
            colors.forEach((element) => {
                $("#hiddenInputsColor").append(
                    '<input type="hidden" name="colors[]" value="' + element + '">'
                );
            });
        }

        function getColor() {
            color_name = $("#color").val();
            if (!colors.includes(color_name)) {
                colors.push(color_name);
            }
            console.log(color);
        }

        function deleteColor(val) {
            color.splice($.inArray(val, color), 1);
            setColors();
        }

        /********** Motifs : in book_search component **********/
        var motif_name = [],
            motifs = [];

        function setMotifs() {
            $("#hiddenInputsMotif").empty();
            motifs.forEach((element) => {
                $("#hiddenInputsMotif").append(
                    '<input type="hidden" name="motifs[]" value="' + element + '">'
                );
            });
        }

        function getMotif() {
            motif_name = $("#motif").val();
            if (!motifs.includes(motif_name)) {
                motifs.push(motif_name);
            }
            console.log(motif);
        }

        function deleteMotif(val) {
            motif.splice($.inArray(val, motif), 1);
            setMotifs();
        }

        /********** Manutypes : in book_search component **********/
        var manutype_name = [],
            manutypes = [];

        function setManutypes() {
            $("#hiddenInputsManutype").empty();
            manutypes.forEach((element) => {
                $("#hiddenInputsManutype").append(
                    '<input type="hidden" name="manutypes[]" value="' + element + '">'
                );
            });
        }

        function getManutype() {
            manutype_name = $("#manutype").val();
            if (!manutypes.includes(manutype_name)) {
                manutypes.push(manutype_name);
            }
            console.log(manutype);
        }

        function deleteManutype(val) {
            manutype.splice($.inArray(val, manutype), 1);
            setManutypes();
        }
    </script>

</div>
