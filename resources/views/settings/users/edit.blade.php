@if ($errors->update->any())
    <script>
        $(document).ready(function() {
            $('#editUser' + {{ $user->id }}).modal('show');
        });
    </script>
@endif
<div class="modal fade" id="editUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="editUser" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">تعديل بيانات المستخدم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fw-bold text-success">
                    <strong class="text-danger">الاسم: </strong>
                    {{ $user->name }}
                </p>
                <p class="fw-bold text-success">
                    <strong class="text-danger">اسم المستخدم: </strong>
                    {{ $user->username }}
                </p>
                <form id="editUserForm" action="{{ Route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="username" class="form-label">اسم المستخدم الجديد</label>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input name="username"
                                class="form-control @error('username', 'update') is-invalid @enderror" id="username"
                                placeholder="أدخل اسم المستخدم" value="{{ $user->username }}">
                            @error('username', 'update')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('id', 'update')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="is_admin" class="form-label">نوع الحساب</label>
                            <select name="is_admin"
                                class="form-select @error('is_admin', 'update') is-invalid @enderror" id="is_admin">
                                <option value="0" {{ $user->is_admin == false ? 'selected' : '' }}>مستخدم</option>
                                <option value="1" {{ $user->is_admin == true ? 'selected' : '' }}>مسؤول</option>
                            </select>

                            @error('is_admin', 'update')
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
                                class="form-control @error('password', 'update') is-invalid @enderror" id="password"
                                placeholder="أدخل كلمة المرور">
                            @error('password', 'update')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation', 'update') is-invalid @enderror"
                                id="password_confirmation" placeholder="أعد كتابة كلمة المرور">
                            @error('password_confirmation', 'update')
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
                                class="form-control @error('admin_pwd', 'update') is-invalid @enderror" id="admin_pwd"
                                placeholder="أدخل كلمة مرور المسؤول">
                            @error('admin_pwd', 'update')
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
                <button type="button" onclick="document.getElementById('editUserForm').submit();"
                    class="btn btn-primary">تعديل
                </button>
            </div>
        </div>
    </div>
</div>
