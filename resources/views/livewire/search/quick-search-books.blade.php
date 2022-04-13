<div>
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
        <div class="col-md-8">
            <div class="form-floating">
                <input type="text" class="form-select" name="author" id="author" list="authors" wire:model="author">
                <label for="author">المؤلف</label>
                <datalist id="authors">
                    @foreach ($authors as $author)
                        <option value="{{ $author->name }}" data-id="{{ $author->id }}">
                    @endforeach
                </datalist>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-3">
        <div class="col-md-7">
            <div class="form-floating">
                <input type="text" class="form-select multidatalist" id="subject" list="subjects" wire:model="subject"
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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary px-5"><i class="fad fa-search"></i> بحث</button>
            <button type="button" class="btn btn-dark px-5" wire:click="resetForm()"><i class="fad fa-times"></i>
                إلغاء</button>
        </div>
    </div>
</div>
