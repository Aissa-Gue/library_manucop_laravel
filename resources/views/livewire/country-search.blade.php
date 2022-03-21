<div>
    <label for="country" class="form-label">{{$countryLivewire['label']}}</label>
    <select wire:model="country"
            class="form-select"
            name="country_id"
            id="country">

        <option disabled>{{$countryLivewire['placeholder']}}</option>
        @foreach ($countries as $country)
            <option value="{{$country->id}}">{{$country->name}}</option>
        @endforeach
    </select>

    <script>
        $(document).ready(function () {
            $('#country').select2();
            $('#country').val(null).trigger('change');//delete selection
        });
    </script>
</div>
