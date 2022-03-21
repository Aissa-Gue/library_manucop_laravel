<?php
$page = ['title' => 'تعديل معلومات الكتاب'];

$authorLivewire =
    [
        'label' => 'المؤلفين',
        'placeholder' => 'حدد مؤلف',
    ];

$subjectLivewire =
    [
        'label' => 'مواضيع الكتاب',
        'placeholder' => 'حدد موضوع',
    ];

?>
@extends('layouts.app', $page)

@section('content')
    <form action="{{Route('books.update', $book->id)}}" method="post">
        @csrf
        @method('PUT')
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات الكتاب</legend>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="book_id" class="form-label">الرقم</label>
                    <input class="form-control text-center" id="book_id" value="{{$book->id}}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10">
                    <label for="book" class="form-label">العنوان</label>
                    <input name="title" class="form-control @error('title') is-invalid @enderror" id="book"
                           placeholder="أدخل عنوان الكتاب" value="{{old('title') ?? $book->title}}">
                    @error('title')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <!-- authors list -->
            <div class="row mt-3">
                <div id="authors_row" class="col-md-7">
                    <livewire:author-search :authorLivewire="$authorLivewire"/>
                    @if(old('authors'))
                        <script>
                            $(document).ready(function () {
                                $('#author').val(
                                    <?php
                                    echo '[';
                                    foreach (old('authors') as $author) {
                                        echo $author . ',';
                                    }
                                    echo ']';
                                    ?>
                                );
                                $('#author').trigger('change');
                            });
                        </script>
                    @else
                        <script>
                            $(document).ready(function () {
                                $('#author').val(
                                    <?php
                                    echo '[';
                                    foreach ($book->authors as $author) {
                                        echo $author->id . ',';
                                    }
                                    echo ']';
                                    ?>
                                );
                                $('#author').trigger('change');
                            });
                        </script>
                    @endif

                    @error('authors.*')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <!-- subjects list -->
                <div id="subjects_row" class="col-md-7">
                    <livewire:subject-search :subjectLivewire="$subjectLivewire"/>
                    @if(old('subjects'))
                        <script>
                            $(document).ready(function () {
                                $('#subject').val(
                                    <?php
                                    echo '[';
                                    foreach (old('subjects') as $author) {
                                        echo $author . ',';
                                    }
                                    echo ']';
                                    ?>
                                );
                                $('#subject').trigger('change');
                            });
                        </script>
                    @else
                        <script>
                            $(document).ready(function () {
                                $('#subject').val(
                                    <?php
                                    echo '[';
                                    foreach ($book->subjects as $subject) {
                                        echo $subject->id . ',';
                                    }
                                    echo ']';
                                    ?>
                                );
                                $('#subject').trigger('change');
                            });
                        </script>
                    @endif
                    @error('subjects.*')
                    <div class="form-text text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">تعديل الكتاب</button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
