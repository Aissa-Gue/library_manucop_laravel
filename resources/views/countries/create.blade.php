<?php
$subNavs = [
    [
        'text' => 'إضافة بلد',
        'icon' => 'fas fa-user',
        'route' => 'countries.index',
    ],
    [
        'text' => 'إضافة مدينة',
        'icon' => 'fas fa-user',
        'route' => 'cities.index',
    ],
];
?>

@include('includes.subNavs',$subNavs)

<form action="{{Route('countries.store')}}" method="post">
    @csrf
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">إضافة بلد</legend>

        <div class="row">
            <div class="col-md-7">
                <label for="country" class="form-label">اسم البلد</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror" id="country"
                       placeholder="أدخل اسم البلد">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="row justify-content-end text-end">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">إضافة البلد</button>
            </div>
        </div>
    </fieldset>
</form>
