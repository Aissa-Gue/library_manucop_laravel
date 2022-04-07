<div>
    <label for="city" class="form-label">{{$cityLivewire['label']}}</label>
    <input type='text'
           placeholder='{{$cityLivewire['placeholder']}}'
           class='form-control'
           list='cities'
           wire:model="city"
           id="city"
           name="city_name"
           onchange="getId('#city','#cities','city_id_hidden')">

    <datalist id="cities">
        @foreach ($cities as $city)
            <option value="{{$city->name}}" data-id="{{$city->id}}">
        @endforeach
    </datalist>
</div>

