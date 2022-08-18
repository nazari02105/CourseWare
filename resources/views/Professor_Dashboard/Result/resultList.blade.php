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


    <div class="content">
        <div class="container">
            <h2 class="mb-5">{{ count($students) }} student(s) participated in this test</h2>
            @if(count($students) > 0)
                <h2 class="mb-5">{{ "Results" }}</h2>
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">NationalCode</th>
                            <th scope="col">Score</th>
                            <th scope="col">Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr scope="row">
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->national_code }}</td>
                                <td>{{ $results[$student->id]."/".$max }}</td>
                                <td>
                                    <form method="GET" action="{{ "/exam/detail" }}">
                                        <input type="hidden" name="examId" value="{{ $examId }}">
                                        <input type="hidden" name="studentId" value="{{ $student->id }}">
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
