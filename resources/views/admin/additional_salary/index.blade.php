@extends('layouts.admin')
@section('title')
    أنواع الإضافي للراتب
@endsection

@section('contentheader')
    قائمة شئون الموظفين
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('additional_salary.index') }}">أنواع الإضافي للراتب</a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أنواع الإضافي للراتب</h3>
            @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()))
            <div class="card-tools">
                <a href="{{ route('additional_salary.create') }}" class="btn btn-success btn-sm">إضافة راتب إضافي </a>
            </div>
            @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الموظف</th>
                        <th>نوع الإضافي</th>
                        <th>الراتب الاساسي</th>
                        <th>المبلغ الإضافي</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($additionalSalaries as $key => $salary)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $salary->admin->name }}</td>
                            <td>{{ $salary->type }}</td>
                            <td>{{ $salary->basic_salary }}</td>
                            <td>{{ $salary->additional_amount }}</td>
                            <td>{{ $salary->total_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
