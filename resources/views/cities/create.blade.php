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

<form action="{{Route('cities.store')}}" method="post">
    @csrf
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">إضافة مدينة</legend>

        <div class="row">
            <div class="col-md-7">
                <label for="city" class="form-label">اسم المدينة</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror" id="city"
                       placeholder="أدخل اسم المدينة">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>

        <div class="row justify-content-end text-end">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">إضافة المدينة</button>
            </div>
        </div>
    </fieldset>
</form>