@extends("Student_Dashboard.Template.main")
@section("title")
    Question
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
    <link rel="stylesheet" href="{{ asset("Quiz/style.css") }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10 col-lg-10">
                <div class="border">
                    <div style="font-size: 20px">Exam closes in <span id="time"></span> minutes!</div>

                    @if($question["type"] == "descriptive")
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                <h4>{{ $question["title"] }}</h4>
                                <span>({{ $number." of ".$max }})</span>
                            </div>
                        </div>
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row align-items-center question-title">
                                <h3 class="text-danger">Q.</h3>
                                <h5 class="mt-1 ml-2">{{ $question["question"] }}</h5>
                            </div>
                        </div>
                        <textarea id="-1" onkeyup="save(this, {{ $question["id"] }}, {{ $studentId }}, {{ $examId }})"
                                  style="width: 100%" rows="10">{{ $answer == null ? "" : $answer }}</textarea>
                    @endif

                    @if($question["type"] == "test")
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                <h4>{{ $question["title"] }}</h4>
                                <span>({{ $number." of ".$max }})</span>
                            </div>
                        </div>
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row align-items-center question-title">
                                <h3 class="text-danger">Q.</h3>
                                <h5 class="mt-1 ml-2">{{ $question["question"] }}</h5>
                            </div>

                            <?php $tests = explode("*&*", $question["options"]); array_splice($tests, count($tests) - 1, 1); $counter = 0; ?>
                            @foreach($tests as $test)
                                <div class="ans ml-2">
                                    <label class="radio"> <input type="radio" name="brazil" value="brazil">
                                        @if($answer != null && $answer == $counter)
                                            <span id="{{ $counter }}"
                                                  onclick="save(this, {{ $question["id"] }}, {{ $studentId }}, {{ $examId }}, {{ $counter }}, {{ count($tests) }})"
                                                  style="background-color: red; color: white">
                                            {{ $test }}
                                            </span>
                                        @endif
                                        @if($answer == null || $answer != $counter)
                                            <span id="{{ $counter }}"
                                                  onclick="save(this, {{ $question["id"] }}, {{ $studentId }}, {{ $examId }}, {{ $counter }}, {{ count($tests) }})">
                                            {{ $test }}
                                            </span>
                                        @endif
                                    </label>
                                </div>
                                <?php $counter += 1; ?>
                            @endforeach

                        </div>
                    @endif

                    <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                        <button class="btn btn-primary d-flex align-items-center btn-danger" type="button">
                            <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;
                            <a href="{{ "/student/exam/".$examId."/question/".($number-1) }}" style="color: white">Previous</a>
                        </button>
                        <button class="btn btn-primary border-success align-items-center btn-success" type="button">
                            @if($number == $max)
                                <a href="{{ "/student/exam/".$examId."/finish" }}" style="color: white">Finish</a>
                            @endif
                            @if($number != $max)
                                <a href="{{ "/student/exam/".$examId."/question/".($number+1) }}" style="color: white">Next</a>
                            @endif
                            <i class="fa fa-angle-right ml-2"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function save(element, questionId, studentId, examId, counter, max) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var answer = "";
            if (element.id == -1) {
                answer = element.value;
            } else {
                for (var i = 0; i<max; ++i){
                    var span = document.getElementById(i);
                    span.style.color = "black";
                    span.style.backgroundColor = "white";
                }
                var correct = document.getElementById(counter);
                correct.style.color = "white";
                correct.style.backgroundColor = "red";
                answer = element.id;
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('student.answer') }}",
                data: {answer: answer, questionId: questionId, studentId: studentId, examId: examId},
                success: function (data) {
                    if (data.success == "finished") {
                        location.href = "/student/course/{{$courseId}}/exams";
                    }
                }
            });
        }

        function startTimer(duration, display) {
            var timer = duration,
                minutes,
                seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    location.href = "/student/course/{{$courseId}}/exams";
                }
            }, 1000);
        }

        window.onload = function () {
            var fiveMinutes = {{ $remainedTime }},
                display = document.querySelector("#time");
            startTimer(fiveMinutes, display);
        };
    </script>
@endsection
