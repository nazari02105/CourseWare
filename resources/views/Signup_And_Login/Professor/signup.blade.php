@extends("Signup_And_Login.Template.main")
@section('title')
    Signup
@endsection
@section('action')
    {{ "/professor" }}
@endsection
@section('content')

    <span class="login100-form-logo">
        <i class="zmdi zmdi-landscape"></i>
    </span>

    <span class="login100-form-title p-b-34 p-t-27">
        Professor Signup
    </span>

    <div class="wrap-input100 validate-input" data-validate="Enter username">
        <input class="input100" type="text" name="username" placeholder="Username" value="{{ old("username") }}">
        <span class="focus-input100" data-placeholder="&#xf207;"></span>
    </div>
    @error('username')
        <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
    @enderror
    <br>

    <div class="wrap-input100 validate-input" data-validate="Enter email">
        <input class="input100" type="email" name="email" placeholder="Email" value="{{ old("email") }}">
        <span class="focus-input100" data-placeholder="&#xf194;"></span>
    </div>
    @error('email')
        <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
    @enderror
    <br>

    <div class="wrap-input100 validate-input" data-validate="Enter national code">
        <input class="input100" type="text" name="national_code" placeholder="National Code" value="{{ old("national_code") }}">
        <span class="focus-input100" data-placeholder="&#xf198;"></span>
    </div>
    @error('national_code')
        <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
    @enderror
    <br>

    <div class="wrap-input100 validate-input" data-validate="Enter experience">
        <input class="input100" type="number" name="experience" placeholder="Experience" value="{{ old("experience") }}">
        <span class="focus-input100" data-placeholder="&#xf217;"></span>
    </div>
    @error('experience')
        <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
    @enderror
    <br>

    <div class="wrap-input100 validate-input" data-validate="Enter age">
        <input class="input100" type="number" name="age" placeholder="Age" value="{{ old("age") }}">
        <span class="focus-input100" data-placeholder="&#xf284;"></span>
    </div>
    @error('age')
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
            Signup
        </button>
    </div>
@endsection
