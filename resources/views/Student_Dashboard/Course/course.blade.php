@extends("Student_Dashboard.Template.main")
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

    <div class="content">
        <div class="container">
            @if(count($courses) > 0)
                <h2 class="mb-5">{{ $username." Courses" }}</h2>
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Exams</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr scope="row">
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->start_time }}</td>
                                <td>{{ $course->end_time }}</td>
                                <td>
                                    <form method="GET" action="{{ "/student/course/".$course->id."/exams" }}">
                                        <button type="submit" class="bg-theme03">See</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @include("Admin_Dashboard.Form_Template.scripts")
@endsection
