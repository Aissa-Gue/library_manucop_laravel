<div id="transcriberBlock">
    <div class="row" id="transcriberInfo1">
        <h5 class="my_line"><span>الناسخ الأول</span></h5>

        <!-- Transcriber name -->
        <div class="col-md-6 transcriber">
            <label for="transcriber1" class="form-label">اسم الناسخ (من القائمة)</label>

            <input type='text'
                   placeholder='حدد اسم الناسخ'
                   class='form-control'
                   list='transcribers1'
                   wire:model="transcriber1"
                   id="transcriber1"
                   name="transcriber1_name"
                   onchange="getId('#transcriber1_id','#transcribers1','transcriber1_id_hidden')">

            <datalist id="transcribers1">
                @foreach ($transcribers1 as $transcriber1)
                    <option value="{{$transcriber1->full_name}}" data-id="{{$transcriber1->id}}">
                @endforeach
            </datalist>

            @error('transcriber1_id')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>

        <!-- Name in manuscript -->
        <div class="col-md-6 nameInManu">
            <label for="name_in_manu1" class="form-label">اسم الناسخ الوارد في النسخة</label>
            <input name="name_in_manu1"
                   wire:model="name_in_manu1"
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
            <input type='text'
                   placeholder='حدد اسم الناسخ المشابه له في الخط'
                   class='form-control'
                   list='fontMatchers1'
                   wire:model="fontMatcher1"
                   id="fontMatcher1"
                   onchange="addFontMatcher1()">

            <datalist id="fontMatchers1">
                @foreach ($fontMatchers1 as $fontMatcher1)
                    <option value="{{$fontMatcher1->full_name}}" data-id="{{$fontMatcher1->id}}">
                @endforeach
            </datalist>

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
            <input type='text'
                   placeholder='حدد اسم الناسخ'
                   class='form-control'
                   list='transcribers2'
                   wire:model="transcriber2"
                   id="transcriber2"
                   name="transcriber2_name"
                   onchange="getId('#transcriber2_id','#transcribers2','transcriber2_id_hidden')">

            <datalist id="transcribers2">
                @foreach ($transcribers2 as $transcriber2)
                    <option value="{{$transcriber2->full_name}}" data-id="{{$transcriber2->id}}">
                @endforeach
            </datalist>

            @error('transcriber2_id')
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
            <input type='text'
                   placeholder='حدد اسم الناسخ المشابه له في الخط'
                   class='form-control'
                   list='fontMatchers2'
                   wire:model="fontMatcher2"
                   id="fontMatcher2"
                   onchange="addFontMatcher2()">

            <datalist id="fontMatchers2">
                @foreach ($fontMatchers2 as $fontMatcher2)
                    <option value="{{$fontMatcher2->full_name}}" data-id="{{$fontMatcher2->id}}">
                @endforeach
            </datalist>
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
            <input type='text'
                   placeholder='حدد اسم الناسخ'
                   class='form-control'
                   list='transcribers3'
                   wire:model="transcriber3"
                   id="transcriber3"
                   name="transcriber3_name"
                   onchange="getId('#transcriber3_id','#transcribers3','transcriber3_id_hidden')">

            <datalist id="transcribers3">
                @foreach ($transcribers3 as $transcriber3)
                    <option value="{{$transcriber3->full_name}}" data-id="{{$transcriber3->id}}">
                @endforeach
            </datalist>

            @error('transcriber3_id')
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
            <input type='text'
                   placeholder='حدد اسم الناسخ المشابه له في الخط'
                   class='form-control'
                   list='fontMatchers3'
                   wire:model="fontMatcher3"
                   id="fontMatcher3"
                   onchange="addFontMatcher3()">

            <datalist id="fontMatchers3">
                @foreach ($fontMatchers3 as $fontMatcher3)
                    <option value="{{$fontMatcher3->full_name}}" data-id="{{$fontMatcher3->id}}">
                @endforeach
            </datalist>
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
            <input type='text'
                   placeholder='حدد اسم الناسخ'
                   class='form-control'
                   list='transcribers4'
                   wire:model="transcriber4"
                   id="transcriber4"
                   name="transcriber4_name"
                   onchange="getId('#transcriber4_id','#transcribers4','transcriber4_id_hidden')">

            <datalist id="transcribers4">
                @foreach ($transcribers4 as $transcriber4)
                    <option value="{{$transcriber4->full_name}}" data-id="{{$transcriber4->id}}">
                @endforeach
            </datalist>

            @error('transcriber4_id')
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
            <input type='text'
                   placeholder='حدد اسم الناسخ المشابه له في الخط'
                   class='form-control'
                   list='fontMatchers4'
                   wire:model="fontMatcher4"
                   id="fontMatcher4"
                   onchange="addFontMatcher4()">

            <datalist id="fontMatchers4">
                @foreach ($fontMatchers4 as $fontMatcher4)
                    <option value="{{$fontMatcher4->full_name}}" data-id="{{$fontMatcher4->id}}">
                @endforeach
            </datalist>
            @error('fontMatchers4.*')
            <div class="form-text text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>


