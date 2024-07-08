@extends('layouts.admin')
@section('title')
    أنواع البدلات للراتب
@endsection

@section('contentheader')
    قائمة شئون الموظفين
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('allowance_salary.index') }}">أنواع البدلات للراتب</a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أنواع البدلات للراتب</h3>
            @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()))
            <div class="card-tools">
                <a href="{{ route('allowance_salary.create') }}" class="btn btn-success btn-sm">إضافة بدل راتب جديد</a>
            </div>
            @endif
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الموظف</th>
                        <th>نوع البدلات</th>
                        <th>الراتب الاساسي</th>
                        <th>مبلغ البدل</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allowanceSalaries as $key => $salary)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $salary->admin->name }}</td>
                            <td>{{ $salary->type }}</td>
                            <td>{{ $salary->basic_salary }}</td>
                            <td>{{ $salary->allowance_amount }}</td>
                            <td>{{ $salary->total_salary }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
