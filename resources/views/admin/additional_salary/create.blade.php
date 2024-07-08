@extends('layouts.admin')
@section('title')
    إضافة راتب إضافي 
@endsection

@section('contentheader')
    قائمة شئون الموظفين
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('additional_salary.index') }}">أنواع الإضافي للراتب</a>
@endsection
@section('contentheaderactive')
    إضافة
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('additional_salary.store') }}" method="POST">
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
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="type">نوع الإضافي</label>
            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="basic_salary">الراتب الاساسي</label>
            <input type="number" name="basic_salary" id="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror" step="0.01" required>
            @error('basic_salary')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="additional_amount">المبلغ الإضافي</label>
            <input type="number" name="additional_amount" id="additional_amount" class="form-control @error('additional_amount') is-invalid @enderror" step="0.01" required>
            @error('additional_amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group text-center">
            <button class="btn btn-sm btn-success" type="submit" name="submit">إضافة الراتب الإضافي</button>
            <a href="{{ route('additional_salary.index') }}" class="btn btn-danger btn-sm">إلغاء</a>
        </div>
    </form>
</div>
@endsection
