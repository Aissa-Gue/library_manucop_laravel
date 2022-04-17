<div>

    <form wire:submit.prevent="@if ($bookComp['is_update'] == true) update() @else store() @endif" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات الكتاب</legend>
            <div class="row mb-1">
                <div class="col-md-8">
                    <label for="book" class="form-label">عنوان الكتاب</label>
                    <input wire:model="book" name="book" class="form-control @error('book') is-invalid @enderror"
                        id="book" placeholder="أدخل عنوان الكتاب">
                    @error('book')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- authors list -->
            <div class="row mb-1">
                <div class="col-md-7">
                    <label for="author" class="form-label">المؤلفين</label>
                    <input type="text" placeholder="حدد مؤلف"
                        class="form-control multidatalist @error('authorsArray') is-invalid @enderror" list="authors"
                        wire:model="author" id="author" onchange="getAuthor()">

                    <datalist id="authors">
                        @foreach ($authors as $author)
                            <option value="{{ $author->name }}" data-id="{{ $author->id }}">
                        @endforeach
                    </datalist>

                    <span class="text-danger">
                        @error('authorsArray')
                            {{ $message }}
                        @enderror
                        @error('authorsArray.*.id')
                            {{ $message }}
                        @enderror
                    </span>

                    <!--- List of authors badges -->
                    <div id="authorsBadges">
                        @foreach ($authorsArray as $author)
                            <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                {{ $author['name'] }}
                                <a wire:click="deleteAuthor('{{ $author['id'] }}')" style="cursor: pointer"
                                    class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                                </a>
                            </p>
                        @endforeach
                    </div>
                </div>

                <!--- add author icon -->
                <div class="col-md-auto"><br><br>
                    <a style="cursor: pointer" wire:click="pushToAuthors(author['id'], author['name'])">
                        <i class="fas fa-plus-circle fs-4"></i>
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- subjects list -->
                <div class="col-md-7">
                    <label for="subject" class="form-label">المواضيع</label>
                    <input type="text" placeholder="حدد موضوع"
                        class="form-control multidatalist @error('subjectsArray') is-invalid @enderror" list="subjects"
                        wire:model="subject" id="subject" onchange="getSubject()">

                    <datalist id="subjects">
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->name }}" data-id="{{ $subject->id }}">
                        @endforeach
                    </datalist>

                    <span class="text-danger">
                        @error('subjectsArray')
                            {{ $message }}
                        @enderror
                        @error('subjectsArray.*.id')
                            {{ $message }}
                        @enderror
                    </span>

                    <!--- List of subjects badges -->
                    <div id="subjectsBadges">
                        @foreach ($subjectsArray as $subject)
                            <p class="badge rounded-pill bg-success mx-1 p-2 mt-3">
                                {{ $subject['name'] }}
                                <a wire:click="deleteSubject('{{ $subject['id'] }}')" style="cursor: pointer"
                                    class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                                </a>
                            </p>
                        @endforeach
                    </div>
                </div>

                <!--- add subject icon -->
                <div class="col-md-auto"><br><br>
                    <a style="cursor: pointer" wire:click="pushToSubjects(subject['id'], subject['name'])">
                        <i class="fas fa-plus-circle fs-4"></i>
                    </a>
                </div>
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn {{ $bookComp['btn_color'] }}"><i
                            class="{{ $bookComp['btn_icon'] }}"></i>
                        {{ $bookComp['btn_title'] }} </button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
