<div>
    <label for="city" class="form-label">{{$cityLivewire['label']}}</label>
    <select wire:model="city"
            class="form-select"
            name="city_id"
            id="city">

        <option disabled>{{$cityLivewire['placeholder']}}</option>
        @foreach ($cities as $city)
            <option value="{{$city->id}}">{{$city->name}}</option>
        @endforeach
    </select>
    <script>

        $(document).ready(function () {
            $('#city').select2();
            $('#city').val(null).trigger('change');//delete selection
        });

    </script>

</div>
