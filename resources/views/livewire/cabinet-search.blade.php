<div>
    <label for="cabinet" class="form-label">{{$cabinetLivewire['label']}}</label>
    <select wire:model="cabinet"
            class="form-select"
            name="cabinet_id"
            id="cabinet">

        <option disabled>{{$cabinetLivewire['placeholder']}}</option>
        @foreach ($cabinets as $cabinet)
            <option value="{{$cabinet->id}}">{{$cabinet->name}}</option>
        @endforeach
    </select>
    <script>
        $(document).ready(function () {
            $('#cabinet').select2();
            $('#cabinet').val(null).trigger('change');//delete selection
        });
    </script>
</div>
