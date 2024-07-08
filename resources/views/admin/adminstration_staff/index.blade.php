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
عرض
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">بيانات موظفين الإدارة</h3>
            <div class="card-tools">
                <a href="{{ route('Administration_staff.create') }}" class="btn btn-success btn-sm">إضافة موظف جديد</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الموظف</th>
                        <th>الإدارة التابع لها</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffDetails as $key => $staff)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $staff->admin->name }}</td>
                            <td>{{ $staff->department_name }}</td>
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
