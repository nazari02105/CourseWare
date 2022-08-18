@extends("Admin_Dashboard.Template.main")
@section("title")
    Course
@endsection
@section("name")
    Admin
@endsection
@section("course")
    active
@endsection
@section("courseAll")
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
                    <h2 class="heading-section">{{ "Change ".$course->title." Course Professor" }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="/course/change/professor" method="POST" class="signin-form">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="form-group">
                                <label for="professor_id">Professor:</label>
                                <select style="font-size: 20px" name="professor_id" class="form-control" value="{{ old("professor_id") }}">
                                    @foreach($professors as $professor)
                                        @if($professor->id != $course->professor_id)
                                            <option style="background-color: black" value="{{ $professor->id }}">{{ $professor->username."-".$professor->national_code }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include("Form_Assets.scripts")
@endsection
