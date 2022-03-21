<div>
    <label for="book" class="form-label">{{$bookLivewire['label']}}</label>
    <select wire:model="book"
            class="form-select"
            name="book_id"
            id="book">

        <option disabled>{{$bookLivewire['placeholder']}}</option>
        @foreach ($books as $book)
            <option value="{{$book->id}}">{{$book->title}}</option>
        @endforeach
    </select>
    <script>
        $(document).ready(function () {
            $('#book').select2();
            $('#book').val(null).trigger('change');//delete selection
        });
    </script>
</div>
