<div>
    <label for="author" class="form-label">{{$authorLivewire['label']}}</label>
    <select wire:model="author"
            class="form-select"
            name="authors[]"
            id="author"
            multiple="multiple"
            >

        <option disabled>{{$authorLivewire['placeholder']}}</option>
        @foreach ($authors as $author)
            <option value="{{$author->id}}">{{$author->name}}</option>
        @endforeach
    </select>

    <script>
        $(document).ready(function () {
            $('#author').select2();
        });
    </script>
</div>
