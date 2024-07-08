@extends('layouts.admin')
@section('title')
    إضافة خصم راتب
@endsection

@section('contentheader')
    قائمة شئون الموظفين
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('salary_deductions.index') }}">أنواع الخصم للراتب</a>
@endsection
@section('contentheaderactive')
    إضافة
@endsection
@section('content')
<div class="col-12">
    <form action="{{ route('salary_deductions.store') }}" method="POST">
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
            <label for="basic_salary">الراتب الأساسي</label>
            <input type="number" name="basic_salary" id="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror" step="0.01" required>
            @error('basic_salary')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="type">نوع الخصم</label>
            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="deduction_amount">مبلغ الخصم</label>
            <input type="number" name="deduction_amount" id="deduction_amount" class="form-control @error('deduction_amount') is-invalid @enderror" step="0.01" required>
            @error('deduction_amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group text-center">
            <button class="btn btn-sm btn-success" type="submit" name="submit">إضافة نوع الخصم</button>
            <a href="{{ route('salary_deductions.index') }}" class="btn btn-danger btn-sm">إلغاء</a>
        </div>
    </form>
</div>
@endsection
