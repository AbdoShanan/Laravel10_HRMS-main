@extends('layouts.admin')
@section('title', 'سجل الحضور والانصراف')
@section('contentheader')
سجل الحضور والانصراف
@endsection
@section('contentheaderactivelink')
<a href="{{ route('attendances.index') }}">سجل الحضور والانصراف</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>ساعة تسجيل الدخول</th>
                    <th>ساعة تسجيل الخروج</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $attendance->admin->name }}</td>
                        <td>{{ $attendance->login_time }}</td>
                        <td>{{ $attendance->logout_time ?? 'لم يتم تسجيل الخروج بعد' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
