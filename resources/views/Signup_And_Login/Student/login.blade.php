@extends("Signup_And_Login.Template.main")
@section('title')
    Login
@endsection
@section('action')
    {{ "/student/login" }}
@endsection
@section('content')

    @if(isset($message))
        <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
    @endif

    <span class="login100-form-logo">
        <i class="zmdi zmdi-landscape"></i>
    </span>

    <span class="login100-form-title p-b-34 p-t-27">
        Student Login
    </span>

    <div class="wrap-input100 validate-input" data-validate="Enter national code">
        <input class="input100" type="text" name="national_code" placeholder="National Code" value="{{ old("national_code") }}">
        <span class="focus-input100" data-placeholder="&#xf198;"></span>
    </div>
    @error('national_code')
    <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
    @enderror
    <br>

    <div class="wrap-input100 validate-input" data-validate="Enter password">
        <input class="input100" type="password" name="password" placeholder="Password">
        <span class="focus-input100" data-placeholder="&#xf191;"></span>
    </div>
    @error('password')
    <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
    @enderror
    <br>

    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            Login
        </button>
    </div>
@endsection
