<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseAddStudentRequest;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $courses = Course::all();
        return view("Admin_Dashboard.courseAll", ['courses'=>$courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $professors = Professor::all();
        return view("Admin_Dashboard.courseCreate", ["professors"=>$professors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCourseRequest $request)
    {
        Course::create([
            "title" => $request->title,
            "professor_id" => $request->professor_id,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
        ]);
        app(NotificationController::class)->addNotification($request->professor_id, "professor",
            "You Added To $request->title Course"
        );
        return redirect('/course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Course $course)
    {
        return view("Admin_Dashboard.courseEdit", [
            'title'=>$course->title,
            'startTime'=>$course->start_time,
            'endTime'=>$course->end_time,
            'id'=>$course->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        return redirect("/course");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        foreach ($course->students()->get() as $student){
            $course->students()->detach($student);
        }
        foreach ($course->exams()->get() as $exam){
            $exam->delete();
        }
        $course->delete();
        return redirect("/course");
    }

    public function courseStudents (Course $course){
        $students = $course->students()->get();
        return view("Admin_Dashboard.courseStudents", ['students'=>$students, 'name'=>$course->title]);
    }

    public function changeProfessorForm (Request $request){
        $professors = Professor::all();
        $course = Course::find($request->id);
        return view("Admin_Dashboard.courseChangeProfessor", compact('course', 'professors'));
    }

    public function changeProfessor (Request $request){
        $course = Course::find($request->course_id);
        app(NotificationController::class)->addNotification($course->professor_id, "professor",
            "You Removed From $course->title Course"
        );
        $course->update(['professor_id'=>$request->professor_id]);
        app(NotificationController::class)->addNotification($request->professor_id, "professor",
            "You Added To $course->title Course"
        );
        return redirect('/course');
    }

    public function addStudentPage (Request $request){
        $message = Session::get("message");
        Session::remove("message");

        $course = Course::find($request->id);
        $students = Student::all();
        return view("Admin_Dashboard.courseAddStudent", compact('course', 'students', 'message'));
    }

    public function addStudent (CourseAddStudentRequest $request){
        $course = Course::find($request->course_id);
        $student = Student::where('national_code', $request->national_code)->first();
        if ($student == null){
            return redirect("/course/add/student?id=$course->id")->with(["message"=>"No student exists with this national code"]);
        }
        if ($course->students->contains($student->id)){
            return redirect("/course/add/student?id=$course->id")->with(["message"=>"This student is already exists in this course"]);
        }
        $course->students()->save($student);
        app(NotificationController::class)->addNotification($student->id, "student",
            "You Added To $course->title Course"
        );
        return redirect("/course/add/student?id=$course->id");
    }

    public function deleteStudent (Request $request){
        $course = Course::find($request->course_id);
        $course->students()->detach($request->student_id);
        app(NotificationController::class)->addNotification($request->student_id, "student",
            "You Removed From $course->title Course"
        );
        return redirect('/course/add/student?id='.$course->id);
    }
}
