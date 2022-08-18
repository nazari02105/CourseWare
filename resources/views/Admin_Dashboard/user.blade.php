@extends("Admin_Dashboard.Template.main")
@section("title")
    User
@endsection
@section("name")
    Admin
@endsection
@section("register")
    active
@endsection
@section("user")
    active
@endsection
@section("content")
    @include("Admin_Dashboard.Form_Template.styles")

    <div class="content">
        <div class="container">
            @if(count($professors) > 0)
                <h2 class="mb-5">Professors</h2>
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">NationalCode</th>
                            <th scope="col">Experience</th>
                            <th scope="col">Age</th>
                            <th scope="col">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($professors as $professor)
                            <tr scope="row">
                                <td>{{ $professor->username }}</td>
                                <td>{{ $professor->email }}</td>
                                <td>{{ $professor->national_code }}</td>
                                <td>{{ $professor->experience }}</td>
                                <td>{{ $professor->age }}</td>
                                <td><button class="bg-info"><a href="{{ "/professor/".$professor->id."/edit" }}" style="color: black">Edit</a></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <br><br><br>

            @if(count($students) > 0)
                <h2 class="mb-5">Students</h2>
                <div class="table-responsive custom-table-responsive">
                    <table class="table custom-table" style="font-size: 18px">
                        <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">NationalCode</th>
                            <th scope="col">Age</th>
                            <th scope="col">Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr scope="row">
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->national_code }}</td>
                                <td>{{ $student->age }}</td>
                                <td><button class="bg-info"><a href="{{ "/student/".$student->id."/edit" }}" style="color: black">Edit</a></button></td>
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
