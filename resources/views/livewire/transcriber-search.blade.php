<div id="transcriberBlock">
    <div class="row" id="transcriberInfo1">
        <h5 class="my_line"><span>الناسخ الأول</span></h5>

        <!-- Transcriber name -->
        <div class="col-md-6 transcriber">
            <label for="transcriber1" class="form-label">اسم الناسخ (من القائمة)</label>
            <select wire:model="transcriber1"
                    class="form-select"
                    name="transcriber_id1"
                    id="transcriber1"
            >
                <option disabled>حدد اسم الناسخ</option>
                @foreach ($transcribers1 as $transcriber1)
                    <option value="{{$transcriber1->id}}">{{$transcriber1->full_name}}</option>
                @endforeach
            </select>
            @error('transcriber_id1')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Name in manuscript -->
        <div class="col-md-6 nameInManu">
            <label for="name_in_manu1" class="form-label">اسم الناسخ الوارد في النسخة</label>
            <input name="name_in_manu1"
                   class="form-control @error('name_in_manu1') is-invalid @enderror"
                   id="name_in_manu1"
                   placeholder="أدخل اسم الناسخ 1 كما ورد في النسخة">
            @error('name_in_manu1')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Font matcher -->
        <div class="col-md-6 fontMatcher mt-2">
            <label for="fontMatcher1" class="form-label">الناسخ المشابه له في الخط</label>
            <select wire:model="transcriber1"
                    class="form-select"
                    name="fontMatchers1[]"
                    id="fontMatcher1"
                    multiple
            >
                <option disabled>حدد اسم الناسخ المشابه في الخط</option>
                @foreach ($transcribers1 as $transcriber1)
                    <option value="{{$transcriber1->id}}">{{$transcriber1->full_name}}</option>
                @endforeach
            </select>
            @error('fontMatchers1.*')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <!---------------- 2nd transcriber ---------------------->
    <div class="row d-none" id="transcriberInfo2">
        <h5 class="my_line"><span>الناسخ الثاني</span></h5>

        <!-- Transcriber name -->
        <div class="col-md-6 transcriber">
            <label for="transcriber2" class="form-label">اسم الناسخ (من القائمة)</label>
            <select wire:model="transcriber2"
                    class="form-select"
                    name="transcriber_id2"
                    id="transcriber2"
            >
                <option disabled>حدد اسم الناسخ</option>
                @foreach ($transcribers2 as $transcriber2)
                    <option value="{{$transcriber2->id}}">{{$transcriber2->full_name}}</option>
                @endforeach
            </select>
            @error('transcriber_id2')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Name in manuscript -->
        <div class="col-md-6 nameInManu">
            <label for="name_in_manu2" class="form-label">اسم الناسخ الوارد في النسخة</label>
            <input name="name_in_manu2"
                   class="form-control @error('name_in_manu2') is-invalid @enderror"
                   id="name_in_manu2"
                   placeholder="أدخل اسم الناسخ 2 كما ورد في النسخة">
            @error('name_in_manu2')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Font matcher -->
        <div class="col-md-6 fontMatcher mt-2">
            <label for="fontMatcher2" class="form-label">الناسخ المشابه له في الخط</label>
            <select wire:model="transcriber2"
                    class="form-select"
                    name="fontMatchers2[]"
                    id="fontMatcher2"
                    multiple
            >
                <option disabled>حدد اسم الناسخ المشابه في الخط</option>
                @foreach ($transcribers2 as $transcriber2)
                    <option value="{{$transcriber2->id}}">{{$transcriber2->full_name}}</option>
                @endforeach
            </select>
            @error('fontMatchers2.*')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <!---------------- 3rd transcriber ---------------------->
    <div class="row d-none" id="transcriberInfo3">
        <h5 class="my_line"><span>الناسخ الثالث</span></h5>

        <!-- Transcriber name -->
        <div class="col-md-6 transcriber">
            <label for="transcriber3" class="form-label">اسم الناسخ (من القائمة)</label>
            <select wire:model="transcriber3"
                    class="form-select"
                    name="transcriber_id3"
                    id="transcriber3"
            >
                <option disabled>حدد اسم الناسخ</option>
                @foreach ($transcribers3 as $transcriber3)
                    <option value="{{$transcriber3->id}}">{{$transcriber3->full_name}}</option>
                @endforeach
            </select>
            @error('transcriber_id3')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Name in manuscript -->
        <div class="col-md-6 nameInManu">
            <label for="name_in_manu3" class="form-label">اسم الناسخ الوارد في النسخة</label>
            <input name="name_in_manu3"
                   class="form-control @error('name_in_manu3') is-invalid @enderror"
                   id="name_in_manu3"
                   placeholder="أدخل اسم الناسخ 3 كما ورد في النسخة">
            @error('name_in_manu3')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Font matcher -->
        <div class="col-md-6 fontMatcher mt-2">
            <label for="fontMatcher3" class="form-label">الناسخ المشابه له في الخط</label>
            <select wire:model="transcriber3"
                    class="form-select"
                    name="fontMatchers3[]"
                    id="fontMatcher3"
                    multiple
            >
                <option disabled>حدد اسم الناسخ المشابه في الخط</option>
                @foreach ($transcribers3 as $transcriber3)
                    <option value="{{$transcriber3->id}}">{{$transcriber3->full_name}}</option>
                @endforeach
            </select>
            @error('fontMatchers3.*')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <!---------------- 4th transcriber ---------------------->
    <div class="row d-none" id="transcriberInfo4">
        <h5 class="my_line"><span>الناسخ الرابع</span></h5>

        <!-- Transcriber name -->
        <div class="col-md-6 transcriber">
            <label for="transcriber4" class="form-label">اسم الناسخ (من القائمة)</label>
            <select wire:model="transcriber4"
                    class="form-select"
                    name="transcriber_id4"
                    id="transcriber4"
            >
                <option disabled>حدد اسم الناسخ</option>
                @foreach ($transcribers4 as $transcriber4)
                    <option value="{{$transcriber4->id}}">{{$transcriber4->full_name}}</option>
                @endforeach
            </select>
            @error('transcriber_id4')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Name in manuscript -->
        <div class="col-md-6 nameInManu">
            <label for="name_in_manu4" class="form-label">اسم الناسخ الوارد في النسخة</label>
            <input name="name_in_manu4"
                   class="form-control @error('name_in_manu4') is-invalid @enderror"
                   id="name_in_manu4"
                   placeholder="أدخل اسم الناسخ 4 كما ورد في النسخة">
            @error('name_in_manu4')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Font matcher -->
        <div class="col-md-6 fontMatcher mt-2">
            <label for="fontMatcher4" class="form-label">الناسخ المشابه له في الخط</label>
            <select wire:model="transcriber4"
                    class="form-select"
                    name="fontMatchers4[]"
                    id="fontMatcher4"
                    multiple
            >
                <option disabled>حدد اسم الناسخ المشابه في الخط</option>
                @foreach ($transcribers4 as $transcriber4)
                    <option value="{{$transcriber4->id}}">{{$transcriber4->full_name}}</option>
                @endforeach
            </select>
            @error('fontMatchers4.*')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>


