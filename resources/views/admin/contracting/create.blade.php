@extends('layouts.admin')

@section('title', 'إضافة مهمة جديدة')

@section('contentheader')
    قائمة مهام المقاولات
@endsection

@section('contentheaderactivelink')
    <a href="{{ route('contractings.index') }}">مهام المقاولات</a>
@endsection

@section('contentheaderactive')
    إضافة
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center">إضافة مهمة جديدة</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('contractings.store') }}" method="post">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>اسم الإداري</label>
                            <select name="admin_id" id="admin_id" class="form-control">
                                @foreach($admins as $id => $name)
                                    <option value="{{ $id }}" {{ old('admin_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('admin_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>الوصف</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>وقت التاسك (ساعات)</label>
                        <input type="text" name="timer" id="timer" class="form-control" placeholder="المؤقت بالساعات (مثال: 05)" value="{{ old('timer') }}">
                        @error('timer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button class="btn btn-sm btn-success" type="submit" name="submit">إضافة المهمة</button>
                            <a href="{{ route('contractings.index') }}" class="btn btn-danger btn-sm">إلغاء</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
