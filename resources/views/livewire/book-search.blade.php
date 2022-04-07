<div>
    <label for="book" class="form-label">{{ $bookLivewire['label'] }}</label>
    <input type='text' placeholder='{{ $bookLivewire['placeholder'] }}' class='form-control' list='books'
        wire:model="book" id="book" name="book_name" onchange="getId('#book','#books','book_id_hidden')"
        wire:change="setBookId(book_id)">
    <!-- delete getId() function after changing other views -->


    <datalist id="books">
        @foreach ($books as $book)
            <option value="{{ $book->title }}" data-id="{{ $book->id }}">
        @endforeach
    </datalist>

    <script>
        //get book data-id
        $("#book").change(function() {
            book_id = $('#books option[value="' + $('#book').val() + '"]').data('id')
        });
    </script>
</div>
