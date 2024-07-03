@extends('layouts.admin')

@section('title', 'تعديل صلاحية')

@section('contentheader')
    تعديل صلاحية
@endsection

@section('contentheaderactivelink')
    <a href="{{ route('permissions.index') }}">الصلاحيات</a>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">اسم الصلاحية</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>الصلاحيات</label><br>
                    @foreach($permission as $value)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="permission_{{ $value->id }}" name="permission[]" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="permission_{{ $value->id }}">{{ $value->name }}</label>
                        </div>
                    @endforeach
                    @error('permission')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">تحديث</button>
            </form>
        </div>
    </div>
</div>
@endsection
