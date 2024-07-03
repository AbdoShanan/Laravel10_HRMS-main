<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/fonts/ionicons/2.0.1/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/fonts/SansPro/SansPro.min.css') }}">
</head>
<style>
input.form-control {
    text-align: right;
}
p {
    text-align: right;
}
</style>
<body class="hold-transition register-page" style="background-size: cover; background-image: url('{{ asset('assets/admin/imgs/login.jpg') }}')">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>HR</b>MS</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">تسجيل حساب جديد</p>

      <form action="{{ route('admin.register') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="الاسم">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('name')
        <p class="text-danger"> {{ $message }} </p>
        @enderror

        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="اسم المستخدم">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @error('username')
        <p class="text-danger"> {{ $message }} </p>
        @enderror

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
        <p class="text-danger"> {{ $message }} </p>
        @enderror

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="كلمة المرور">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
        <p class="text-danger"> {{ $message }} </p>
        @enderror

        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
