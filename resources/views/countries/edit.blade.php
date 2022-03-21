
<div class="modal fade" id="editCountry{{$country->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="editCountry" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">تعديل اسم البلد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCountryForm" action="{{Route('countries.update',$country->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="country" class="form-label">اسم البلد</label>
                    <input name="name1" class="form-control @error('name1') is-invalid @enderror" id="country"
                           placeholder="أدخل اسم البلد" value="{{old('name1') ?? $country->name}}">
                    @error('name1')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" onclick="document.getElementById('editCountryForm').submit();"
                        class="btn btn-primary">تعديل
                </button>
            </div>
        </div>
    </div>
</div>
