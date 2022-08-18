@extends("Student_Dashboard.Template.main")
@section("title")
    Dashboard
@endsection
@section("name")
    {{ $username }}
@endsection
@section("dashboard")
    active
@endsection
@section("content")
    <br>
    <div align="center" style="font-size: 30px">
        Welcome To Student Dashboard
    </div>
@endsection
@section("notificationHead")
    RECENTLY NOTIFICATION
@endsection
@section("notifications")
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @foreach($notifications as $notification)
        <div class="desc" onclick="JSalert('{{ $notification->message }}')">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                <span class="badge bg-danger"><a href="/student/notification/{{ $notification->id }}/delete" style="color: white"><i class="fa fa-trash"></i></a></span>
            </div>
            <div class="details">
                <p>
                    <muted>{{ intdiv((time() - $notification->time), 60) }} Minutes ago</muted>
                    <br/>
                    <a href="#">CW</a> {{ $notification->message }}<br/>
                </p>
            </div>
        </div>
    @endforeach

    <script type="text/javascript">
        function hello (){
            alert("yes");
        }
        function JSalert(message) {
            Swal.fire(message)
        }
    </script>
@endsection
