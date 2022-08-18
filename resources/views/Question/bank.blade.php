@extends("Professor_Dashboard.Template.main")
@section("title")
    Questions
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
            <h2 class="mb-5">{{ $username." Questions Bank" }}</h2>
            @if(count($bank) > 0)
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Question</th>
                            <th scope="col">Type</th>
                            <th scope="col">Add</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bank as $question)
                            <tr scope="row">
                                <td>{{ $question["title"] }}</td>
                                <td>{{ substr($question["question"], 0, 15)."..." }}</td>
                                <td>{{ $question["type"] }}</td>
                                <td>
                                    <input type="checkbox"
                                           onclick="addQuestion({{ $exam_id }}, {{ $question["id"] }}, this)">
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
    <script>
        function addQuestion(examId, questionId, element) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "/question/add?examId="+examId+"&questionId="+questionId+"&status="+element.checked);
            xmlhttp.send();
        }
    </script>
@endsection
