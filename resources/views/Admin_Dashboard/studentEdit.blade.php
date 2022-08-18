@extends("Admin_Dashboard.Template.main")
@section("title")
    User
@endsection
@section("name")
    Admin
@endsection
@section("register")
    active
@endsection
@section("user")
    active
@endsection
@section("content")
    <style>
        input,
        input::-webkit-input-placeholder {
            font-size: 20px;
            line-height: 3;
        }
    </style>
    @include("Form_Assets.styles")
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Edit {{ $username }} with {{ $nationalCode }} national code</h2>
                    @if(isset($message))
                        <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="/student/{{ $id }}" method="POST" class="signin-form">
                            @method("patch")
                            @csrf
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input style="font-size: 20px" name="username" type="text" class="form-control" placeholder="Username" required value="{{ $username }}">
                            </div>
                            @error('username')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input style="font-size: 20px" name="email" type="email" class="form-control" placeholder="Email" required value="{{ $email }}">
                            </div>
                            @error('email')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="national_code">NationalCode:</label>
                                <input style="font-size: 20px" name="national_code" type="text" class="form-control" placeholder="National Code" required value="{{ $nationalCode }}">
                            </div>
                            @error('national_code')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input style="font-size: 20px" name="age" type="number" class="form-control" placeholder="Age" required value="{{ $age }}">
                            </div>
                            @error('age')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include("Form_Assets.scripts")
@endsection
