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
                    <h2 class="heading-section">Edit {{$title}} Course</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="{{ "/course/".$id }}" method="POST" class="signin-form">
                            @csrf
                            @method("patch")
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input style="font-size: 20px" name="title" type="text" class="form-control" required value="{{ $title }}">
                            </div>
                            @error('title')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>

                            <div class="form-group">
                                <label for="start_time">Start Time:</label>
                                <input style="font-size: 20px" name="start_time" type="date" class="form-control" required value="{{ $startTime }}">
                            </div>
                            @error('start_time')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>

                            <div class="form-group">
                                <label for="end_time">End Time:</label>
                                <input style="font-size: 20px" name="end_time" type="date" class="form-control" required value="{{ $endTime }}">
                            </div>
                            @error('end_time')
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
