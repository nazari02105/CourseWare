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
            <h2 class="mb-5">{{ $name." Exams" }}</h2>
            @if(count($exams) > 0)
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Time</th>
                            <th scope="col">Builder</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            @if($exam->builder_id != $id)
                                <tr scope="row">
                                    <td>{{ $exam->title }}</td>
                                    <td>{{ $exam->description }}</td>
                                    <td>{{ $exam->time }}</td>
                                    <td>
                                        <form method="GET" action="{{ "/exam/".$exam->id."/builder" }}">
                                            <button type="submit" class="bg-theme03">See</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <br><br><br>
            <h2 class="mb-5">{{ $name." Exams Which Created By ".$username }}</h2>
            <button class="bg-info"><a href="/exam/create" style="color: black">New</a></button>
            @if(count($exams))
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Time</th>
                            <th scope="col">Questions</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exams as $exam)
                            @if($exam->builder_id == $id)
                                <tr scope="row">
                                    <td>{{ $exam->title }}</td>
                                    <td>{{ $exam->description }}</td>
                                    <td>{{ $exam->time }}</td>
                                    <td>
                                        <form method="GET" action="{{ "/exam/".$exam->id."/add/question" }}">
                                            <button type="submit" class="bg-success">Add</button>
                                            <button class="bg-important"><a href="{{ "/exam/".$exam->id."/add/question/bank" }}"
                                                                          style="color: black">Bank</a></button>
                                            <button class="bg-theme03"><a href="{{ "/exam/".$exam->id."/see/question" }}"
                                                                            style="color: black">See</a></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ "/exam/".$exam->id }}">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn bg-danger">Delete</button>
                                            <button class="btn bg-warning"><a href="{{ "/exam/".$exam->id."/edit" }}"
                                                                          style="color: black">Edit</a></button>
                                            <button class="btn bg-primary"><a href="{{ "/exam/".$exam->id."/result" }}"
                                                                          style="color: black">Result</a></button>
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

    @include("Admin_Dashboard.Form_Template.scripts")
@endsection
