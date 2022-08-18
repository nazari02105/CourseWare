<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginStudentRequest;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
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
        return view("Signup_And_Login.Student.signup");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStudentRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "national_code" => $request->national_code,
            "age" => $request->age,
        ]);
        return redirect('/student/login');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Student $student)
    {
        $message = Session::get("message");
        Session::remove("message");

        $id = $student->id;
        $username = $student->username;
        $email = $student->email;
        $nationalCode = $student->national_code;
        $age = $student->age;
        return view("Admin_Dashboard.studentEdit",
            compact('id', 'username', 'email', 'nationalCode', 'age', 'message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStudentRequest $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $id = $student->id;
        $newStudent = Student::where('email', $request->email)->first();
        if ($newStudent != null && $newStudent->id != $student->id) {
            return redirect("/student/$id/edit")->with(["message" => "You can not use this email."]);
        }
        $newStudent = Student::where('national_code', $request->national_code)->first();
        if ($newStudent != null && $newStudent->id != $student->id) {
            return redirect("/student/$id/edit")->with(["message" => "You can not use this national code."]);
        }
        $student->update($request->all());
        return redirect("/student/$id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function showLogin()
    {
        $message = Session::get("message");
        Session::remove("message");

        return view("Signup_And_Login.Student.login", ["message" => $message]);
    }

    public function login(LoginStudentRequest $request)
    {
        $credentials = ['password' => $request->password, 'national_code' => $request->national_code, 'status' => 1];

        if (Auth::guard("student")->attempt($credentials)) {
            return redirect('/student/dashboard');
        }

        $student = Student::where(['national_code' => $request->national_code])->get()->first();
        if ($student == null)
            return redirect("/student/login")->with(["message" => 'No student exists with this national code']);
        else if (!Hash::check($request->password, $student->password))
            return redirect("/student/login")->with(["message" => 'Password is wrong']);
        return redirect("/student/login")->with(["message" => 'Please be patient while you wait for admin approval']);
    }

    public function dashboard()
    {
        $username = Auth::guard('student')->user()->username;
        $id = Auth::guard("student")->user()->id;
        $notifications = DB::table("notifications")->where(["user_id"=>$id, "type"=>"student", "deleted_at"=>null])->get();
        return view("Student_Dashboard.Dashboard.dashboard", ["username" => $username, "notifications"=>$notifications]);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $student = Student::where('id', $id)->first();
        $student->update(['status' => $student->status == 0 ? 1 : 0]);
    }

    public function logout()
    {
        Auth::guard("student")->logout();
        return redirect("/student/login");
    }

    public function courses()
    {
        $username = Auth::guard('student')->user()->username;
        $id = Auth::guard('student')->user()->id;
        $student = Student::find($id);
        $courses = $student->courses()->get();
        return view("Student_Dashboard.Course.course", ["username" => $username, "courses" => $courses]);
    }

    public function courseExams(Course $course)
    {
        $message = Session::get("message");
        Session::remove("message");

        $username = Auth::guard('student')->user()->username;
        $studentId = Auth::guard('student')->user()->id;
        $courseName = $course->title;
        $finished = array();
        $exams = $course->exams()->get()->toArray();
        foreach ($exams as $exam){
            $row = DB::table("exam_student")->where(["exam_id"=>$exam["id"], "student_id"=>$studentId])->first();
            if ($row != null && time() - $row->start_time > $exam["time"] * 60){
                $finished[] = $exam;
                array_splice($exams, array_search($exam, $exams), 1);
            }
        }
        return view("Student_Dashboard.Course.exams", ["username" => $username, "exams" => $exams, "courseName" => $courseName, "message" => $message,
            "finished"=>$finished]);
    }

    public function examQuestions(Exam $exam, $number)
    {
        $remainedTime = $this->calculateRemainedTime($exam);
        if ($remainedTime < 0){
            return redirect("/student/course/" . $exam->course_id . "/exams");
        }
        $courseId = $exam->course_id;
        $username = Auth::guard('student')->user()->username;
        $studentId = Auth::guard('student')->user()->id;
        $examId = $exam->id;
        $questions = $exam->questions()->get()->toArray();
        if (count($questions) == 0) {
            return redirect("/student/course/" . $exam->course_id . "/exams")->with(["message" => $exam->title . " does not have any question."]);
        }
        $max = count($questions);
        if ($number < 1) {
            $question = $questions[0];
            $number = 1;
        } else if ($number > count($questions)) {
            $question = $questions[$max - 1];
            $number = $max;
        } else {
            $question = $questions[$number - 1];
        }
        $row = DB::table("question_student")->where(["question_id"=>$question["id"], "student_id"=>$studentId])->first();
        if ($row != null) $answer = $row->answer;
        else $answer = null;
        return view("Student_Dashboard.Course.question", compact("username", "number", "max",
            "question", "examId", "remainedTime", "courseId", "studentId", "answer"));
    }

    private function calculateRemainedTime (Exam $exam){
        $total = $exam->time * 60;
        $student_id = Auth::guard('student')->user()->id;
        $row = DB::table("exam_student")->where(["exam_id"=>$exam->id, "student_id"=>$student_id])->first();
        $passed = time() - $row->start_time;
        return $total - $passed;
    }

    public function startExam (Request $request){
        $exam_id = $request->exam_id;
        $exam = Exam::query()->find($exam_id);
        $student_id = Auth::guard("student")->user()->id;
        $row = DB::table("exam_student")->where(["exam_id"=>$exam_id, "student_id"=>$student_id])->first();
        if ($row == null){
            app(NotificationController::class)->addNotification($student_id, "student",
                "You Started $exam->title Exam"
            );
            DB::table("exam_student")->insert(["exam_id"=>$exam_id, "student_id"=>$student_id, "start_time"=>time()]);
        }
        return redirect("/student/exam/".$request->exam_id."/question/1");
    }

    public function saveAnswer (Request $request){
        $exam = Exam::query()->find($request->examId);
        $time = $this->calculateRemainedTime($exam);
        if ($time > 0){
            DB::table("question_student")->updateOrInsert(["question_id"=>$request->questionId, "student_id"=>$request->studentId],
                ["answer"=>$request->answer]
            );
            return response()->json(['success'=>'success']);
        }
        return response()->json(['success'=>'finished']);
    }

    public function finishExam (Exam $exam){
        $studentId = Auth::guard("student")->user()->id;
        DB::table("exam_student")->where(["exam_id"=>$exam->id, "student_id"=>$studentId])->update(["start_time"=>1]);
        return redirect("/student/course/" . $exam->course_id . "/exams");
    }
}
