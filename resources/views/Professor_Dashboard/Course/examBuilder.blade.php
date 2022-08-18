@extends("Professor_Dashboard.Template.main")
@section("title")
    Courses
@endsection
@section("name")
    {{ $username }}
@endsection
@section("course")
    active
@endsection
@section("courses")
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
                    <h2 class="heading-section">Professor: {{ $builder->username }} with {{ $builder->national_code }} national code</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form method="GET" action="/professor/courses" class="signin-form">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input style="font-size: 20px" type="text" class="form-control" value="{{ $builder->username }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input style="font-size: 20px" type="email" class="form-control" value="{{ $builder->email }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="national_code">NationalCode:</label>
                                <input style="font-size: 20px" type="text" class="form-control" value="{{ $builder->national_code }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input style="font-size: 20px" type="number" class="form-control" value="{{ $builder->age }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="age">Experience:</label>
                                <input style="font-size: 20px" type="number" class="form-control" value="{{ $builder->experience }}">
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include("Form_Assets.scripts")
@endsection
