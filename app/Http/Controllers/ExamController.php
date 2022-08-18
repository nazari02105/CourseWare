<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $username = Auth::guard("professor")->user()->username;
        return view("Professor_Dashboard.Course.createExam", compact("username"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreExamRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {
        Exam::query()->create([
            'title' => $request->title,
            'builder_id' => Session::get("professor_id"),
            'course_id' => Session::get("course_id"),
            'description' => $request->description,
            'time' => $request->time,
        ]);
        return redirect("/professor/course/" . Session::get("course_id") . "/exams");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Exam $exam)
    {
        $id = $exam->id;
        $name = $exam->title;
        $username = Auth::guard("professor")->user()->username;
        return view("Professor_Dashboard.Course.editExam", compact("exam", "id", "name", "username"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateExamRequest $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->all());
        return redirect("/exam/$exam->id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect("/professor/courses");
    }

    public function courseExams(Course $course)
    {
        //it will be used when someone tried to create new exam for this course
        Session::put("course_id", $course->id);
        Session::put("professor_id", Auth::guard("professor")->user()->id);

        $id = Auth::guard("professor")->user()->id;
        $name = $course->title;
        $username = Auth::guard("professor")->user()->username;
        $exams = $course->exams()->get();
        return view("Professor_Dashboard.Course.courseExams", compact('id', 'name', 'username', 'exams'));
    }

    public function examBuilder(Exam $exam)
    {
        $username = Auth::guard("professor")->user()->username;
        $builder = $exam->professor()->first();
        return view("Professor_Dashboard.Course.examBuilder", ["builder" => $builder, "username" => $username]);
    }

    public function examResults(Exam $exam)
    {
        $examId = $exam->id;
        $username = Auth::guard("professor")->user()->username;
        $rows = DB::table("exam_student")->where(["exam_id" => $exam->id])->get()->toArray();
        for ($i = 0; $i < count($rows); ++$i)
            if (time() - $rows[$i]->start_time <= $exam->time * 60)
                array_splice($rows, $i, 1);
        $students = array();
        foreach ($rows as $row)
            $students[] = Student::find($row->student_id);
        $max = $this->addResult($exam, $students);
        $results = $this->getResult($exam, $students);
        return view("Professor_Dashboard.Result.resultList", compact("username", "examId", "students", "max", "results"));
    }

    private function addResult(Exam $exam, $students)
    {
        $questions = $exam->questions()->get();
        $max = 0;
        foreach ($questions as $question) {
            $row = DB::table("exam_question")->where(["exam_id" => $exam->id, "question_id" => $question->id])->first();
            $score = $row->score;
            $max += $score;
            if ($question->type == "test") {
                foreach ($students as $student) {
                    $questionStudentRow = DB::table("question_student")->where(["question_id" => $question->id, "student_id" => $student->id])->first();
                    if ($questionStudentRow != null) {
                        if ($questionStudentRow->answer == $question->right_answer)
                            DB::table("question_student")->where(["question_id" => $question->id, "student_id" => $student->id])->update(["score" => $score]);
                        else
                            DB::table("question_student")->where(["question_id" => $question->id, "student_id" => $student->id])->update(["score" => 0]);
                    }
                }
            }
        }
        return $max;
    }

    private function getResult(Exam $exam, $students)
    {
        $result = array();
        $questions = $exam->questions()->get();
        foreach ($students as $student) {
            $sum = 0;
            foreach ($questions as $question) {
                $questionStudentRow = DB::table("question_student")->where(["question_id" => $question->id, "student_id" => $student->id])->first();
                if ($questionStudentRow != null && $questionStudentRow->score != null) {
                    $sum += $questionStudentRow->score;
                }
            }
            $result[$student->id] = $sum;
        }
        return $result;
    }

    public function examDetail(Request $request)
    {
        $username = Auth::guard("professor")->user()->username;
        $examId = $request->examId;
        $studentId = $request->studentId;

        $exam = Exam::query()->find($examId);
        $questions = $exam->questions()->get();

        $returned = $this->getAnswer($questions, $studentId);
        $answers = $returned[0];
        $scores = $returned[1];
        $maxes = $this->getMaxes($examId, $questions);

        return view("Professor_Dashboard.Result.resultDetail", compact("username", "questions", "answers", "scores", "maxes", "studentId"));
    }

    private function getAnswer($questions, $studentId)
    {
        $score = array();
        $result = array();
        foreach ($questions as $question) {
            $questionStudentRow = DB::table("question_student")->where(["question_id" => $question->id, "student_id" => $studentId])->first();
            if ($questionStudentRow == null)
                $result[$question->id] = "";
            else if ($questionStudentRow->answer == null)
                $result[$question->id] = "";
            else
                $result[$question->id] = $questionStudentRow->answer;
            if ($questionStudentRow == null)
                $score[$question->id] = 0;
            else if ($questionStudentRow->score == null)
                $score[$question->id] = 0;
            else
                $score[$question->id] = $questionStudentRow->score;
        }
        return [$result, $score];
    }

    private function getMaxes($exam_id, $questions)
    {
        $maxes = array();
        foreach ($questions as $question) {
            $examQuestionRow = DB::table("exam_question")->where(["question_id" => $question->id, "exam_id" => $exam_id])->first();
            $maxes[$question->id] = $examQuestionRow->score;
        }
        return $maxes;
    }

    public function updateScore(Request $request)
    {
        DB::table("question_student")->updateOrInsert(["student_id"=>$request->studentId, "question_id"=>$request->questionId],
            ["score"=>$request->score]
        );
    }
}
