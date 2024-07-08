@extends('layouts.admin')
@section('title')
بيانات موظفين الإدارة
@endsection

@section('contentheader')
قائمة شئون الموظفين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Administration_staff.index') }}">موظفين الإدارة</a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <form action="{{ route('Administration_staff.store') }}" method="POST">
      @csrf
      <div class="form-group">
         <label for="admin_id">اسم الموظف</label>
         <select name="admin_id" id="admin_id" class="form-control select2 @error('admin_id') is-invalid @enderror" required>
            <option value="">اختر الموظف</option>
            @foreach($admins as $admin)
               <option value="{{ $admin->id }}">{{ $admin->name }}</option>
            @endforeach
         </select>
         @error('admin_id')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
      </div>
      <div class="form-group">
         <label for="department">الإدارة التابع لها</label>
         <select name="department" id="department" class="form-control select2 @error('department') is-invalid @enderror" required>
            <option value="">اختر الإدارة</option>
            <option value="المهام">المهام</option>
            <option value="المقاولات">المقاولات</option>
         </select>
         @error('department')
            <div class="invalid-feedback">{{ $message }}</div>
         @enderror
      </div>
      <div class="form-group text-center">
         <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الموظف</button>
         <a href="{{ route('Administration_staff.index') }}" class="btn btn-danger btn-sm">الغاء</a>
      </div>
   </form>
</div>
@endsection
