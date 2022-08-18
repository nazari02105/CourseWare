@extends("Student_Dashboard.Template.main")
@section("title")
    Exams
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
            @if(isset($message))
                <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
            @endif

            <h2 class="mb-5">{{ $courseName." Finished Exams" }}</h2>
            @if(count($finished) > 0)
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($finished as $exam)
                            <tr scope="row">
                                <td>{{ $exam["title"] }}</td>
                                <td>{{ $exam["description"] }}</td>
                                <td>{{ $exam["time"] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <h2 class="mb-5">{{ $courseName." Exams" }}</h2>
            @if(count($exams) > 0)
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Time</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            <tr scope="row">
                                <td>{{ $exam["title"] }}</td>
                                <td>{{ $exam["description"] }}</td>
                                <td>{{ $exam["time"] }}</td>
                                <td>
                                    <form method="POST" action="{{ "/student/exam/start" }}">
                                        @csrf
                                        <input type="hidden" name="exam_id" value="{{ $exam["id"] }}">
                                        <button type="submit" class="bg-theme03">Start</button>
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
