<div>
    <label for="author" class="form-label">{{ $authorLivewire['label'] }}</label>

    <input type="text" placeholder="{{ $authorLivewire['placeholder'] }}"
        class="form-control multidatalist @error('authors') is-invalid @enderror" list="authors" wire:model="author"
        id="author" onchange="getAuthor()">

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
            <p class="badge rounded-pill bg-primary mx-1 p-2 mt-3">
                {{ $author['name'] }}
                <a wire:click="deleteAuthor('{{ $author['id'] }}')" style="cursor: pointer"
                    class="text-white text-decoration-none mx-1"> <i class="fas fa-times"></i>
                </a>
            </p>
        @endforeach
    </div>

    <!--- add fontMatcher icon -->
    <div class="col-md-auto"><br><br>
        <a style="cursor: pointer" wire:click="pushToAuthors(author['id'], author['name'])">
            <i class="fas fa-plus-circle fs-4"></i>
        </a>
    </div>
</div>
