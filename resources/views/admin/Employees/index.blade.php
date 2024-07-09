@extends('layouts.admin')

@section('title', 'بيانات الموظفين')

@section('contentheader')
    قائمة الضبط
@endsection

@section('contentheaderactivelink')
    <a href="{{ route('Employees.index') }}">الموظفين</a>
@endsection

@section('contentheaderactive')
    عرض
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
        @if ((auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager()))
            <h3 class="card-title card_title_center">بيانات الموظفين
                <a href="{{ route('Employees.create') }}" class="btn btn-sm btn-success">اضافة جديد</a>
            </h3>
        @endif
        </div>
        <div class="card-body" id="ajax_responce_serachDiv">
            @if($data->count() > 0)
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="custom_thead">
                        <tr>
                            <th>اسم الموظف</th>
                            <th>الرقم القومي</th>
                            <th>البريد الإلكتروني</th>
                            <th>تاريخ البداية</th>
                            <th>الإدارة</th>
                            <th>الوظيفة</th>
                            <th>الراتب</th>
                            <th>الصورة</th>
                            <th>تمت الإضافة بواسطة</th>
                            <th>تم التحديث بواسطة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $info)
                        <tr>
                            <td>{{ $info->emp_name }}</td>
                            <td>{{ $info->emp_national_idenity }}</td>
                            <td>{{ $info->emp_email }}</td>
                            <td>{{ $info->emp_start_date }}</td>
                            <td>{{ $info->emp_Departments_code }}</td>
                            <td>{{ $info->emp_jobs_id }}</td>
                            <td>{{ $info->emp_sal }}</td>
                            <td>
                                @if($info->emp_photo)
                                    <img src="{{ asset('storage/app/public/' . $info->emp_photo) }}" alt="Employee Photo" style="max-width: 50px; max-height: 50px;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                @php
                                $dt = new DateTime($info->created_at);
                                $date = $dt->format("Y-m-d");
                                $time = $dt->format("h:i");
                                $newDateTime = date("a", strtotime($info->created_at));
                                $newDateTimeType = (($newDateTime == 'AM') ? 'صباحا' : 'مساء');
                                @endphp
                                {{ $date }} <br>
                                {{ $time }} {{ $newDateTimeType }} <br>
                                {{ $info->added->name }}
                            </td>
                            <td>
                                @if($info->updated_by > 0)
                                    @php
                                    $dt = new DateTime($info->updated_at);
                                    $date = $dt->format("Y-m-d");
                                    $time = $dt->format("h:i");
                                    $newDateTime = date("a", strtotime($info->updated_at));
                                    $newDateTimeType = (($newDateTime == 'AM') ? 'صباحا' : 'مساء');
                                    @endphp
                                    {{ $date }} <br>
                                    {{ $time }} {{ $newDateTimeType }} <br>
                                    {{ $info->updatedby->name }}
                                @else
                                    لايوجد
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('Employees.edit', $info->id) }}" class="btn btn-success btn-sm">تعديل</a>
                                <a href="{{ route('Employees.destroy', $info->id) }}" class="btn are_you_shur btn-danger btn-sm">حذف</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="col-md-12 text-center">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
            @else
            <p class="bg-danger text-center">عفواً، لا توجد بيانات لعرضها</p>
            @endif
        </div>
    </div>
</div>
@endsection
