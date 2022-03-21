<div>
    <label for="subject" class="form-label">{{$subjectLivewire['label']}}</label>
    <select wire:model="subject"
            class="form-select"
            name="subjects[]"
            id="subject"
            multiple
            >

        <option disabled>{{$subjectLivewire['placeholder']}}</option>
        @foreach ($subjects as $subject)
            <option value="{{$subject->id}}">{{$subject->name}}</option>
        @endforeach
    </select>
    <script>
        $(document).ready(function () {
            $('#subject').select2();
        });
    </script>

</div>
