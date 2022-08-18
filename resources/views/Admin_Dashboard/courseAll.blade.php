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
    @include("Admin_Dashboard.Form_Template.styles")

    <div class="content">
        <div class="container">
            <h2 class="mb-5">All Courses In Course Ware</h2>
            <button class="bg-info"><a href="/course/create" style="color: black">New</a></button>
            @if(count($courses) > 0)
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Professor</th>
                            <th scope="col">Students</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr scope="row">
                                <td>{{ $course->title }}</td>
                                <td>
                                    <button class="bg-important"><a href="{{ "professor/".$course->professor_id }}"
                                                                    style="color: black">See</a></button>
                                    <button class="bg-theme03"><a
                                            href="{{ "/course/change/professor?id=".$course->id }}"
                                            style="color: black">Change</a></button>
                                </td>
                                <td>
                                    <button class="bg-important"><a href="{{ "course/".$course->id."/students" }}"
                                                                    style="color: black">See</a></button>
                                    <button class="bg-info"><a href="{{ "/course/add/student?id=".$course->id }}"
                                                               style="color: black">Add</a></button>
                                </td>
                                <td>{{ $course->start_time }}</td>
                                <td>{{ $course->end_time }}</td>
                                <td>
                                    <form method="POST" action="{{ "/course/".$course->id }}">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" class="bg-danger">Delete</button>
                                        <button class="bg-warning"><a href="{{ "/course/".$course->id."/edit" }}"
                                                                      style="color: black">Edit</a></button>
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
