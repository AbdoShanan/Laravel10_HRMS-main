@extends('layouts.admin')
@section('title')
المستخدمين
@endsection
@section('contentheader')
تعديل بيانات مستخدم 
@endsection
@section('contentheaderactivelink')
<a href="{{ route('admins.index') }}"> المستخدمين</a>
@endsection
@section('contentheaderactive')
تعديل بيانات مستخدم 
@endsection
@section('content')
<div class="container">
    <form action="{{ route('admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">الإسم</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" required>
            @error('name')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>
        <div class="form-group">
            <label for="email">الإيميل</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>
        <div class="form-group">
            <label for="password">رقم المرور</label>
            <input type="password" name="password" id="password" class="form-control" >
            @error('password')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">تأكيد رقم المرور </label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="form-group">
            <label for="status">الحالة</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1">مفعل</option>
                <option value="0">غير مفعل</option>
            </select>
            @error('status')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
        </div>

        <div class="row mg-b-20">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">صلاحية المستخدم</label>
                    {!! Form::select('roles_name[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">تعديل</button>
    </form>
</div>
@endsection
