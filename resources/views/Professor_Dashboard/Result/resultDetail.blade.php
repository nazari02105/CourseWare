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


                    <?php $counter = 1; ?>
                    @foreach($questions as $question)

                        @if($question->type == "descriptive")
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                    <h4>{{ $question->title }}</h4>
                                    <span>({{ $counter." of ".count($questions) }})</span><?php $counter += 1; ?>
                                </div>
                            </div>
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row align-items-center question-title">
                                    <h3 class="text-danger">Q.</h3>
                                    <h5 class="mt-1 ml-2">{{ $question->question }}</h5>
                                </div>
                            </div>
                            <textarea style="width: 100%" rows="10">{{ $answers[$question->id] }}</textarea>
                            <label style="font-size: 15px">Score:</label>
                            <input style="font-size: 15px" type="number" min="0" max="{{ $maxes[$question->id] }}"
                                   step="0.1"
                                   onchange="changeScore({{ $studentId }}, {{ $question->id }}, this)"
                                   value="{{ $scores[$question->id] }}"/>
                            <br><br><br><br>
                        @endif

                        @if($question->type == "test")
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                    <h4>{{ $question->title }}</h4>
                                    <span>({{ $counter." of ".count($questions) }})</span><?php $counter += 1; ?>
                                </div>
                            </div>
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row align-items-center question-title">
                                    <h3 class="text-danger">Q.</h3>
                                    <h5 class="mt-1 ml-2">{{ $question->question }}</h5>
                                </div>

                                <?php $tests = explode("*&*", $question->options); array_splice($tests, count($tests) - 1, 1); $counter2 = 0; ?>
                                @foreach($tests as $test)
                                    <div class="ans ml-2">
                                        @if($counter2 == $answers[$question->id])
                                            <label class="radio"> <input type="radio" name="brazil" value="brazil">
                                                <span style="background-color: red; color: white;">{{ $test }}</span>
                                            </label>
                                        @endif
                                        @if($counter2 != $answers[$question->id])
                                            <label class="radio"> <input type="radio" name="brazil" value="brazil">
                                                <span>{{ $test }}</span>
                                            </label>
                                        @endif
                                    </div>
                                    <?php $counter2 += 1; ?>
                                @endforeach

                            </div>
                            <label style="font-size: 15px">Score:</label>
                            <input style="font-size: 15px" type="number" min="0" max="{{ $maxes[$question->id] }}"
                                   step="0.1"
                                   onchange="changeScore({{ $studentId }}, {{ $question->id }}, this)"
                                   value="{{ $scores[$question->id] }}"/>
                            <br><br><br><br>
                        @endif

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script>
        function changeScore(studentId, questionId, element) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('exam.updateScore') }}",
                data: {studentId: studentId, questionId: questionId, score: element.value},
                success: function (data) {

                }
            });
        }
    </script>

@endsection
