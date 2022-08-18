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
    @include("Admin_Dashboard.Form_Template.styles")
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">{{ "Add Student To ".$course->title." Course" }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-3">
                    @if(isset($message))
                        <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
                    @endif
                    <div class="login-wrap p-0">
                        <form action="/course/add/student" method="POST" class="signin-form">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="form-group">
                                <label style="font-size: 15px" for="national_code">Students National Code:</label>
                                <input style="font-size: 20px; color:black !important;" name="national_code" type="text" class="form-control"
                                       required value="{{ old("national_code") }}">
                            </div>
                            @error('national_code')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="login-wrap p-0">
                    <div class="content">
                        <div class="container">
                            @if(count($students) > 0)
                                <div style="font-size: 25px" align="center">
                                    Students whom exists in this course
                                </div>
                                <div class="table-responsive custom-table-responsive">
                                    <table class="table custom-table" style="font-size: 18px">
                                        <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">National Code</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            @if($course->students->contains($student->id))
                                                <tr scope="row">
                                                    <td>{{ $student->username }}</td>
                                                    <td>{{ $student->national_code }}</td>
                                                    <td>
                                                        <form action="/course/delete/student" method="POST">
                                                            @csrf
                                                            @method("delete")
                                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                            <div>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="login-wrap p-0">
                    <div class="content">
                        <div class="container">
                            @if(count($students) > 0)
                                <div style="font-size: 25px" align="center">
                                    Students whom you can add to course
                                </div>
                                <div class="table-responsive custom-table-responsive">
                                    <table class="table custom-table" style="font-size: 18px">
                                        <thead>
                                        <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">National Code</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            @if(!$course->students->contains($student->id))
                                                <tr scope="row">
                                                    <td>{{ $student->username }}</td>
                                                    <td>{{ $student->national_code }}</td>
                                                    <td>
                                                        <form action="/course/add/student" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                            <input type="hidden" name="national_code" value="{{ $student->national_code }}">
                                                            <div>
                                                                <button type="submit" class="btn btn-info">Add</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    @include("Form_Assets.scripts")
@endsection
