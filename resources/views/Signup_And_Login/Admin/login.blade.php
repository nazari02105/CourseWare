@extends("Signup_And_Login.Template.main")
@section('title')
    Login
@endsection
@section('action')
    {{ "/admin/login" }}
@endsection
@section('content')

    @if(isset($message))
        <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
    @endif

    <span class="login100-form-logo">
        <i class="zmdi zmdi-landscape"></i>
    </span>

    <span class="login100-form-title p-b-34 p-t-27">
        Admin Login
    </span>

    <div class="wrap-input100 validate-input" data-validate="Enter username">
        <input class="input100" type="text" name="username" placeholder="Username" value="{{ old("username") }}">
        <span class="focus-input100" data-placeholder="&#xf207;"></span>
    </div>
    @error('username')
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
