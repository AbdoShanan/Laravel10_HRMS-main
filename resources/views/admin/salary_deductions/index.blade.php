@extends('layouts.admin')
@section('title', 'أنواع الخصم للراتب')

@section('contentheader', 'قائمة شئون الموظفين')
@section('contentheaderactivelink')
    <a href="{{ route('salary_deductions.index') }}">أنواع الخصم للراتب</a>
@endsection
@section('contentheaderactive', 'عرض')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">أنواع الخصم للراتب</h3>
            @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()))
            <div class="card-tools">
                <a href="{{ route('salary_deductions.create') }}" class="btn btn-success btn-sm">إضافة خصم جديد</a>
            </div>
            @endif
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الموظف</th>
                        <th>نوع الخصم</th>
                        <th>الراتب الاساسي</th>
                        <th>مبلغ الخصم</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deductions as $key => $deduction)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $deduction->admin->name }}</td>
                            <td>{{ $deduction->type }}</td>
                            <td>{{ $deduction->basic_salary }}</td>
                            <td>{{ $deduction->deduction_amount }}</td>
                            <td>{{ $deduction->basic_salary - $deduction->deduction_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
