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
    @include("Admin_Dashboard.Form_Template.styles")
    @include("Form_Assets.styles")

    <div class="content">
        <div class="container">
            @if(count($students) > 0)
                <h2 class="mb-5">{{ $username." Students In ".$name." Course" }}</h2>
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">National Code</th>
                            <th scope="col">Age</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr scope="row">
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->national_code }}</td>
                                <td>{{ $student->age }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <form method="GET" action="/professor/courses" class="signin-form">
                    <div align="center">
                        <div class="form-group col-3" align="center">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Back</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>

    @include("Admin_Dashboard.Form_Template.scripts")
@endsection
