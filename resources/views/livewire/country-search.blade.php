<div>
    <label for="country" class="form-label">{{ $countryLivewire['label'] }}</label>
    <input type='text' class="form-select" placeholder="{{ $countryLivewire['placeholder'] }}" id="country"
        list="countries" wire:model="country" name="country_name"
        onchange="getId('#country','#countries','country_id_hidden')">

    <datalist id="countries">
        @foreach ($countries as $country)
            <option value="{{ $country->name }}" data-id="{{ $country->id }}">
        @endforeach
    </datalist>

</div>
