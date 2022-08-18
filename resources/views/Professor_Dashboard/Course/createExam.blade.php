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
                    <h2 class="heading-section">Create New Exam</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="/exam" method="POST" class="signin-form">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input style="font-size: 20px" name="title" type="text" class="form-control" placeholder="Title" required value="{{ old("title") }}">
                            </div>
                            @error('title')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input style="font-size: 20px" name="description" type="text" class="form-control" placeholder="Description" required value="{{ old("description") }}">
                            </div>
                            @error('description')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="time">Time:</label>
                                <input style="font-size: 20px" name="time" type="number" class="form-control" placeholder="Time" required value="{{ old("time") }}">
                            </div>
                            @error('time')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include("Form_Assets.scripts")
@endsection
