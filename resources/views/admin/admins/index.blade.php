@extends('layouts.admin')
@section('title')
المستخدمين
@endsection
@section('contentheader')
قائمة المستخدمين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('admins.index') }}">   المستخدمين</a>
@endsection
@section('contentheaderactive')
إضافة مستخدم جديد
@endsection
@section('content')
<div class="container">
    @can('إضافة مستخدم')
    <a href="{{ route('admins.create') }}" class="btn btn-primary">إضافة مستخدم جديد</a>
    @endcan
    <table class="table mt-3">
        <thead>
            <tr>
                <th>الإسم</th>
                <th>الإيميل</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @if ($admin->active == 1)
                            مفعل
                        @else
                            غير مفعل
                        @endif
                    </td>
                    <td>
                        @can('تعديل المستخدم')
                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning">تعديل</a>
                        @endcan
                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                        @can('حذف المستخدم')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        @endcan
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
