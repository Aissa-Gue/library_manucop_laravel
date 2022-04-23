<div>
    <form wire:submit.prevent="@if ($transComp['is_update'] == true) update() @else store() @endif" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">معلومات الناسخ</legend>

            <div class="row">
                <div class="col-md-8">
                    <label for="full_name" class="form-label">اسم الناسخ</label>
                    <input name="full_name" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                        placeholder="أدخل اسم الناسخ" wire:model="full_name">
                    @error('full_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div key="descent1" class="col-md-2">
                    <label for="descent1" class="form-label">النسبة</label>
                    <input name="descent1" class="form-control @error('descent1') is-invalid @enderror" id="descent1"
                        placeholder="أدخل النسبة 1" wire:model="descent1">
                    @error('descent1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if ($currentDescent > 1)
                    <div key="descent2" class="col-md-2">
                        <label for="descent2" class="form-label">&nbsp;</label>
                        <input id="descent2" name="descent2"
                            class="form-control @error('descent2') is-invalid @enderror" placeholder="أدخل النسبة 2"
                            wire:model="descent2">
                        @error('descent2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                @if ($currentDescent > 2)
                    <div key="descent3" class="col-md-2">
                        <label for="descent3" class="form-label">&nbsp;</label>
                        <input id="descent3" name="descent3"
                            class="form-control @error('descent3') is-invalid @enderror" placeholder="أدخل النسبة 3"
                            wire:model="descent3">
                        @error('descent3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                @if ($currentDescent > 3)
                    <div key="descent4" class="col-md-2">
                        <label for="descent4" class="form-label">&nbsp;</label>
                        <input id="descent4" name="descent4"
                            class="form-control @error('descent4') is-invalid @enderror" placeholder="أدخل النسبة 4"
                            wire:model="descent4">
                        @error('descent4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                @if ($currentDescent > 4)
                    <div key="descent5" class="col-md-2">
                        <label for="descent" class="form-label">&nbsp;</label>
                        <input id="descent" name="descent5" class="form-control @error('descent5') is-invalid @enderror"
                            placeholder="أدخل النسبة 5" wire:model="descent5">
                        @error('descent5')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                <!-- add input dynamically -->
                @if ($currentDescent < 5)
                    <div key="increaseDescent" class="form-group col-md-auto" style="cursor: pointer; margin-top: 37px;"
                        wire:click="increaseDescent()">
                        <i class="fal fa-plus-circle fs-4 text-secondary"></i>
                    </div>
                @endif
                <!-- END add input dynamically -->
            </div>

            <div class="row mt-2">
                <div class="col-md-2">
                    <label for="last_name" class="form-label">اللقب (اسم الشهرة)</label>
                    <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                        placeholder="أدخل لقب الناسخ" wire:model="last_name">
                    @error('last_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="nickname" class="form-label">الكنية</label>
                    <input name="nickname" class="form-control @error('nickname') is-invalid @enderror" id="nickname"
                        placeholder="أدخل كنية الناسخ" wire:model="nickname">
                    @error('nickname')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="country" class="form-label">البلد حاليا</label>
                    <input type='text' class="form-select" placeholder="حدد بلد الناسخ" id="country" list="countries"
                        wire:model="country" name="country_name" wire:change="setCountryId(country_id)">

                    <datalist id="countries">
                        @foreach ($countries as $country)
                            <option value="{{ $country->name }}" data-id="{{ $country->id }}">
                        @endforeach
                    </datalist>

                    @error('country_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="city" class="form-label">المدينة</label>
                    <input type='text' placeholder='حدد مدينة الناسخ' class='form-select' list='cities'
                        wire:model="city" id="city" name="city_name" wire:change="setCityId(city_id)">

                    <datalist id="cities">
                        @foreach ($cities as $city)
                            <option value="{{ $city->name }}" data-id="{{ $city->id }}">
                        @endforeach
                    </datalist>
                    @error('city_id')
                        <div class="form-text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-8">
                    <label for="other_name1" class="form-label">صيغ أخرى لاسم الناسخ</label>
                    <input name="other_name1" class="form-control @error('other_name1') is-invalid @enderror"
                        id="other_name1" placeholder="أدخل الصيغة 1" wire:model="other_name1">
                    @error('other_name1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                @if ($currentOtherName >= 2)
                    <div class="col-md-8 mt-2">
                        <input name="other_name2" class="form-control @error('other_name2') is-invalid @enderror"
                            id="other_name2" placeholder="أدخل الصيغة 2" wire:model="other_name2">
                        @error('other_name2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                @if ($currentOtherName >= 3)
                    <div class="col-md-8 mt-2">
                        <input name="other_name3" class="form-control @error('other_name3') is-invalid @enderror"
                            id="other_name3" placeholder="أدخل الصيغة 3" wire:model="other_name3">
                        @error('other_name3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                @if ($currentOtherName >= 4)
                    <div class="col-md-8 mt-2">
                        <input name="other_name4" class="form-control @error('other_name4') is-invalid @enderror"
                            id="other_name4" placeholder="أدخل الصيغة 4" wire:model="other_name4">
                        @error('other_name4')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                <!-- add input dynamically -->
                @if ($currentOtherName < 4)
                    <div wire:key="increaseOtherName" class="col-md-auto"
                        @if ($currentOtherName == 1) style="cursor: pointer; margin-top: 37px;" @endif
                        @if ($currentOtherName > 1) style="cursor: pointer; margin-top: 17px;" @endif
                        wire:click="increaseOtherName()">
                        <i class="fal fa-plus-circle fs-4 text-secondary"></i>
                    </div>
                @endif
                <!-- END add input dynamically -->
            </div>

            <div class="row justify-content-end text-end">
                <div class="col-md-2">
                    <button type="submit" class="btn {{ $transComp['btn_color'] }}">
                        <i class="{{ $transComp['btn_icon'] }}"></i>
                        {{ $transComp['btn_title'] }}
                    </button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
