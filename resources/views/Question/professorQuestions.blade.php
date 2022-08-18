@extends("Professor_Dashboard.Template.main")
@section("title")
    Questions
@endsection
@section("name")
    {{ $username }}
@endsection
@section("questions")
    active
@endsection
@section("designed")
    active
@endsection
@section("content")
    @include("Admin_Dashboard.Form_Template.styles")

    <div class="content">
        <div class="container">
            <h2 class="mb-5">{{ $username." Questions" }}</h2>
            @if(count($questions) > 0)
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Question</th>
                            <th scope="col">Type</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $question)
                            <tr scope="row">
                                <td>{{ $question["title"] }}</td>
                                <td>{{ substr($question["question"], 0, 15)."..." }}</td>
                                <td>{{ $question["type"] }}</td>
                                <td>
                                    <form method="GET" action="{{ "/question/".$question["id"]."/edit" }}">
                                        <input type="submit" value="Edit" class="btn btn-warning">
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
