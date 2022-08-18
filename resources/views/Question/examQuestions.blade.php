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
                            <textarea style="width: 100%" rows="10"></textarea>
                            <form method="POST" action="/question/exam/delete">
                                @csrf
                                @method("delete")
                                <label style="font-size: 15px">Score:</label>
                                <input style="font-size: 15px" type="number" min="0" max="100" step="0.25"
                                    onchange="changeScore({{ $id }}, {{ $question->id }}, this)"
                                    value="{{ (\Illuminate\Support\Facades\DB::table("exam_question")->select("score")
                                    ->where(["exam_id"=>$id, "question_id"=>$question->id])->first())->score }}">
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <input type="hidden" name="exam_id" value="{{ $id }}">
                                <input class="btn btn-danger" type="submit" value="delete">
                            </form>
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

                                <?php $tests = explode("*&*", $question->options); array_splice($tests, count($tests)-1, 1); ?>
                                @foreach($tests as $test)
                                    <div class="ans ml-2">
                                        <label class="radio"> <input type="radio" name="brazil" value="brazil">
                                            <span>{{ $test }}</span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                                <form method="POST" action="/question/exam/delete">
                                    @csrf
                                    @method("delete")
                                    <label style="font-size: 15px">Score:</label>
                                    <input style="font-size: 15px" type="number" min="0" max="100" step="0.25"
                                           onchange="changeScore({{ $id }}, {{ $question->id }}, this)"
                                           value="{{ (\Illuminate\Support\Facades\DB::table("exam_question")->select("score")
                                            ->where(["exam_id"=>$id, "question_id"=>$question->id])->first())->score }}">
                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                    <input type="hidden" name="exam_id" value="{{ $id }}">
                                    <input class="btn btn-danger" type="submit" value="delete">
                                </form>
                            <br><br><br><br>
                        @endif

                    @endforeach
                    <div style="font-size: 20px">Sum:<span id="sum"></span></div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function changeScore (examId, questionId, element){
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function () {
                const res = this.responseText;
                var sum = document.getElementById("sum");
                sum.textContent = res;
            }
            xmlhttp.open("GET", "/question/score?examId="+examId+"&questionId="+questionId+"&score="+element.value);
            xmlhttp.send();
        }
    </script>

@endsection
