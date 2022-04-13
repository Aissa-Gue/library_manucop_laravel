@if ($errors->store->any())
    <script>
        $(document).ready(function() {
            $('#createUser').modal('show');
        });
    </script>
@endif
<div class="modal fade" id="createUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="createUser" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">إضافة مستخدم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" action="{{ Route('users.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="username" class="form-label">اسم المستخدم</label>
                            <input name="username" class="form-control @error('username', 'store') is-invalid @enderror"
                                id="username" placeholder="أدخل اسم المستخدم">
                            @error('username', 'store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="is_admin" class="form-label">نوع الحساب</label>
                            <select name="is_admin" class="form-select @error('is_admin', 'store') is-invalid @enderror"
                                id="is_admin">
                                <option value="0">مستخدم</option>
                                <option value="1">مسؤول</option>
                            </select>

                            @error('is_admin', 'store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" name="password"
                                class="form-control @error('password', 'store') is-invalid @enderror" id="password"
                                placeholder="أدخل كلمة المرور">
                            @error('password', 'store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation', 'store') is-invalid @enderror"
                                id="password_confirmation" placeholder="أعد كتابة كلمة المرور">
                            @error('password_confirmation', 'store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="admin_pwd" class="form-label">كلمة مرور المسؤول</label>
                            <input type="password" name="admin_pwd"
                                class="form-control @error('admin_pwd', 'store') is-invalid @enderror" id="admin_pwd"
                                placeholder="أدخل كلمة مرور المسؤول">
                            @error('admin_pwd', 'store')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" onclick="document.getElementById('createUserForm').submit();"
                    class="btn btn-success">إضافة
                </button>
            </div>
        </div>
    </div>
</div>
