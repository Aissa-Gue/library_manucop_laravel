<?php
$subNavs = [
    [
        'text' => 'إضافة بلد',
        'icon' => 'fas fa-globe',
        'route' => 'countries.index',
        'request' => 'countries',
    ],
    [
        'text' => 'إضافة مدينة',
        'icon' => 'fas fa-city',
        'route' => 'cities.index',
        'request' => 'cities',
    ],
];

$countryLivewire = [
    'label' => 'البلد',
    'placeholder' => 'اختر بلد',
];
?>

@include('includes.subNavs', $subNavs)

<form action="{{ Route('cities.store') }}" method="post">
    @csrf
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">إضافة مدينة</legend>

        <div class="row">
            <div class="col-md-4">
                <input type="hidden" name="country_id" id="country_id_hidden" value="">
                <livewire:country-search :countryLivewire="$countryLivewire" />

                @error('country_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <script>
                    // add hidden input contains data-id of selected value (datalist single select)
                    function getId(input_id, datalist_id, hidden_input_id) {
                        var val = $(input_id).val();
                        var dataid = $(datalist_id + " option")
                            .filter(function() {
                                return this.value === val;
                            })
                            .data("id");
                        if (dataid == null) {
                            document.getElementById(hidden_input_id).value = null;
                        } else {
                            document.getElementById(hidden_input_id).value = dataid;
                        }
                        console.log(dataid);
                    }
                </script>
            </div>
            <div class="col-md-5">
                <label for="city" class="form-label">اسم المدينة</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror" id="city"
                    placeholder="أدخل اسم المدينة">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row justify-content-end text-end">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> إضافة المدينة</button>
            </div>
        </div>
    </fieldset>
</form>
