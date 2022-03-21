
<div class="modal fade" id="editCity{{$city->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="editCity" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">تعديل اسم المدينة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCityForm" action="{{Route('cities.update',$city->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <label for="city" class="form-label">اسم المدينة</label>
                    <input name="name1" class="form-control @error('name1') is-invalid @enderror" id="city"
                           placeholder="أدخل اسم المدينة" value="{{old('name1') ?? $city->name}}">
                    @error('name1')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" onclick="document.getElementById('editCityForm').submit();"
                        class="btn btn-primary">تعديل
                </button>
            </div>
        </div>
    </div>
</div>
