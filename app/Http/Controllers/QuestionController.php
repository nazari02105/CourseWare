<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Professor;
use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $username = Auth::guard("professor")->user()->username;
        $questions = Auth::guard("professor")->user()->questions()->get()->toArray();
        return view("Question.professorQuestions", ["username" => $username, "questions" => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Exam $exam)
    {
        $message = Session::get("message");
        Session::remove("message");

        $id = $exam->id;
        $username = Auth::guard("professor")->user()->username;
        return view("Question.create", ["id" => $id, "username" => $username, "message" => $message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreQuestionRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreQuestionRequest $request)
    {
        if ($request->type == "descriptive") {
            $question = Question::query()->create($request->all());
            $exam = Exam::query()->find($request->exam_id);
            $exam->questions()->save($question);
            \DB::table("exam_question")->where("exam_id", $exam->id)->where("question_id", $question->id)
                ->update(["score" => 0]);
        } else {
            $tests = "";
            $correctAnswer = -1;

            $number = $request->test_numbers;
            $bool = true;
            for ($i = 0; $i <= $number; ++$i) {
                $member = "member" . $i;
                if (!isset($request->$member) || $request->$member == "" || $request->$member == null)
                    return redirect("/exam/" . $request->exam_id . "/add/question")->with(["message" => "All tests must have a value"]);
                $tests .= $request->$member . "*&*";
                $checkbox = "checkbox" . $i;
                if (isset($request->$checkbox)) {
                    $correctAnswer = $i;
                    $bool = false;
                }
            }
            if ($bool)
                return redirect("/exam/" . $request->exam_id . "/add/question")->with(["message" => "You must also specify the correct test answer"]);

            $question = Question::query()->create([
                "professor_id" => $request->professor_id,
                "title" => $request->title,
                "question" => $request->question,
                "type" => "test",
                "options" => $tests,
                "right_answer" => $correctAnswer,
            ]);
            $exam = Exam::query()->find($request->exam_id);
            $exam->questions()->save($question);
            \DB::table("exam_question")->where("exam_id", $exam->id)->where("question_id", $question->id)
                ->update(["score" => 0]);
        }
        return redirect("/exam/" . $request->exam_id . "/add/question");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Question $question)
    {
        $message = Session::get("message");
        Session::remove("message");

        $username = Auth::guard("professor")->user()->username;
        if ($question->type == "descriptive")
            return view("Question.editDescriptive", ["question" => $question, "username" => $username, "message" => $message]);
        else {
            $options = explode("*&*", $question->options);
            $right_answer = $question->right_answer;
            array_splice($options, count($options) - 1, 1);
            return view("Question.editTest", compact("question", "username", "message", "options", "right_answer"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateQuestionRequest $request
     * @param \App\Models\Question $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        if ($question->type == "descriptive") {
            $newQuestion = Question::query()->where("title", $request->title)->first();
            if ($newQuestion != null && $newQuestion->id != $question->id)
                return redirect("/question/$question->id/edit")->with(["message" => "This title is already taken."]);
            $question->update($request->all());
            return redirect("/question/$question->id/edit");
        } else {
            $newQuestion = Question::query()->where("title", $request->title)->first();
            if ($newQuestion != null && $newQuestion->id != $question->id)
                return redirect("/question/$question->id/edit")->with(["message" => "This title is already taken."]);


            $tests = "";
            $correctAnswer = -1;

            $number = $request->test_numbers;
            if ($number < 2)
                return redirect("/question/$question->id/edit")->with(["message" => "The question must have more than one test."]);

            $bool = true;
            for ($i = 0; $i <= $number; ++$i) {
                $member = "member" . $i;
                if (!isset($request->$member) || $request->$member == "" || $request->$member == null)
                    return redirect("/question/$question->id/edit")->with(["message" => "All tests must have a value"]);
                $tests .= $request->$member . "*&*";
                $checkbox = "checkbox" . $i;
                if (isset($request->$checkbox)) {
                    $correctAnswer = $i;
                    $bool = false;
                }
            }
            if ($bool)
                return redirect("/question/$question->id/edit")->with(["message" => "You must also specify the correct test answer"]);

            $question->update([
                "title" => $request->title,
                "question" => $request->question,
                "options" => $tests,
                "right_answer" => $correctAnswer,
            ]);

            return redirect("/question/$question->id/edit");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    public function addFromBank(Exam $exam)
    {
        $exam_id = $exam->id;
        $professor_id = Auth::guard("professor")->user()->id;
        $bank = $this->getProfessorBank($exam, $professor_id);
        $username = Auth::guard("professor")->user()->username;

        return view("Question.bank", compact("exam_id", "bank", "username"));
    }

    private function getProfessorBank(Exam $exam, $professor_id)
    {
        $professor = Professor::find($professor_id);
        $professorQuestions = $professor->questions()->get()->toArray();
        $examQuestions = $exam->questions()->get()->toArray();
        foreach ($examQuestions as $question) {
            if ($question["professor_id"] == $professor_id) {
                $professorQuestions = $this->removeDuplicateQuestions($professorQuestions, $question["id"]);
            }
        }
        return $professorQuestions;
    }

    private function removeDuplicateQuestions($professorQuestions, $questionId)
    {
        foreach ($professorQuestions as $question)
            if ($question["id"] == $questionId) {
                array_splice($professorQuestions, array_search($question, $professorQuestions), 1);
                break;
            }
        return $professorQuestions;
    }

    public function addToExam(Request $request)
    {
        if ($request->status == "true") {
            \DB::table("exam_question")->insert(["exam_id" => $request->examId, "question_id" => $request->questionId, "score" => 0]);
        } else {
            \DB::table("exam_question")->where(["exam_id" => $request->examId, "question_id" => $request->questionId])->delete();
        }
    }

    public function examQuestions(Exam $exam)
    {
        $id = $exam->id;
        $username = Auth::guard("professor")->user()->username;
        $questions = $exam->questions()->get();
        return view("Question.examQuestions", ["username" => $username, "questions" => $questions, "id" => $id]);
    }

    public function deleteFromExam(Request $request)
    {
        \DB::table("exam_question")->where(["exam_id" => $request->exam_id, "question_id" => $request->question_id])->delete();
        return redirect("/exam/" . $request->exam_id . "/see/question");
    }

    public function setScore(Request $request)
    {
        \DB::table("exam_question")->where(["exam_id" => $request->examId, "question_id" => $request->questionId])
            ->update(["score" => $request->score]);
        $sum = 0;
        $questions = \DB::table("exam_question")->where(["exam_id" => $request->examId])->get();
        foreach ($questions as $question) {
            $sum += $question->score;
        }
        echo $sum;
    }
}
