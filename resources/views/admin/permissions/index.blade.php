@extends('layouts.admin')

@section('title', 'الصلاحيات')

@section('contentheader')
    قائمة الصلاحيات
@endsection

@section('contentheaderactivelink')
    <a href="{{ route('permissions.index') }}">الصلاحيات</a>
@endsection

@section('contentheaderactive')
    <a href="{{ route('permissions.create') }}">إضافة صلاحية جديدة</a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">إضافة صلاحية جديدة</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i = 0 @endphp 
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                  
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('permissions.edit', $role->id) }}">تعديل</a>

                                    @if ($role->name !== 'owner')
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $role->id], 'style' => 'display:inline']) !!}
                                            {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
