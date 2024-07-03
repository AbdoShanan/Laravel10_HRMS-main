@extends('layouts.admin')
@section('title')
فئات الوظائف
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('jobs_categories.index') }}">   الوظائف</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات أنواع وظائف الموظفين 
         @can('إضافة نوع وظيفة')
            <a href="{{ route('jobs_categories.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
       @endcan
         </h3>
      </div>
      <div class="card-body" id="ajax_responce_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>    اسم الوظيفة</th>
               <th>   حالة التفعيل</th>
               <th>  الاضافة بواسطة</th>
               <th>  التحديث بواسطة</th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->name }}</td>
                  <td @if ($info->active==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->active==1) مفعل @else معطل @endif</td>
                  <td>
                     @php
                     $dt=new DateTime($info->created_at);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($info->created_at));
                     $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }} <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     {{ $info->added->name }} 
                  </td>
                  <td>
                     @if($info->updated_by>0)
                     @php
                     $dt=new DateTime($info->updated_at);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($info->updated_at));
                     $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}  <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     {{ $info->updatedby->name }} 
                     @else
                     لايوجد
                     @endif
                  </td>
                  <td>
                     @can('تعديل نوع وظيفة')
                     <a  href="{{ route('jobs_categories.edit',$info->id) }}" class="btn btn-success btn-sm">تعديل</a>
                     @endcan

                     @can('حذف نوع وظيفة')
                     <a  href="{{ route('jobs_categories.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a>
                    @endcan
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <br>
         <div class="col-md-12 text-center">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection
