<div class="mb-4">
    <form id="quickSearchForm" action="{{ Route('search.quick.transSearch') }}" method="get">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="form-floating">
                    <input type="text" class="form-select" name="transcriber" id="transcriber" list="transcribers"
                        wire:model="transcriber">
                    <label for="transcriber">الاسم الكامل / النسب</label>
                    <datalist id="transcribers">
                        @foreach ($transcribers as $transcriber)
                            <option value="{{ $transcriber->full_name_all }}" data-id="{{ $transcriber->id }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-select" name="last_name" id="last_name" list="last_names"
                        wire:model="last_name">
                    <label for="last_name">اللقب (اسم الشهرة)</label>
                    <datalist id="last_names">
                        @foreach ($last_names as $last_name)
                            <option value="{{ $last_name->last_name }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-select" name="nickname" id="nickname" list="nicknames"
                        wire:model="nickname">
                    <label for="nickname"> الكنية</label>
                    <datalist id="nicknames">
                        @foreach ($nicknames as $nickname)
                            <option value="{{ $nickname->nickname }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-select" name="country" id="country" list="countries"
                        wire:model="country">
                    <label for="country">بلد الناسخ</label>
                    <datalist id="countries">
                        @foreach ($countries as $country)
                            <option value="{{ $country->name }}" data-id="{{ $country->id }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input type="number" class="form-control text-center" name="trans_syear" id="trans_syear">
                    <label for="trans_syear">فترة النسخ: من (هجري)</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input type="number" class="form-control text-center" name="trans_eyear" id="trans_eyear">
                    <label for="trans_eyear">فترة النسخ: إلى (هجري)</label>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-select" name="city" id="city" list="cities" wire:model="city">
                    <label for="city">مدينة الناسخ</label>
                    <datalist id="cities">
                        @foreach ($cities as $city)
                            <option value="{{ $city->name }}" data-id="{{ $city->id }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input type="number" class="form-control text-center" name="trans_syear_m" id="trans_syear_m">
                    <label for="trans_syear_m">فترة النسخ: من (ميلادي)</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input type="number" class="form-control text-center" name="trans_eyear_m" id="trans_eyear_m">
                    <label for="trans_eyear_m">فترة النسخ: إلى (ميلادي)</label>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary px-5"><i class="fad fa-search"></i> بحث</button>
                <button type="button" class="btn btn-dark px-5" wire:click="resetForm()"><i class="fad fa-times"></i>
                    إلغاء</button>
            </div>
        </div>
    </form>
</div>
