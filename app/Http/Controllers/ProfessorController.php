<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginProfessorRequest;
use App\Models\Course;
use App\Models\Professor;
use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfessorController extends Controller
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
        return view("Signup_And_Login.Professor.signup");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfessorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessorRequest $request)
    {
        Professor::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "national_code" => $request->national_code,
            "experience" => $request->experience,
            "age" => $request->age,
        ]);
        return redirect('/professor/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Professor $professor)
    {
        $username = $professor->username;
        $email = $professor->email;
        $nationalCode = $professor->national_code;
        $experience = $professor->experience;
        $age = $professor->age;
        return view("Admin_Dashboard.professorShow", compact('username', 'email', 'nationalCode', 'experience', 'age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Professor $professor)
    {
        $message = Session::get("message");
        Session::remove("message");

        $id = $professor->id;
        $username = $professor->username;
        $email = $professor->email;
        $nationalCode = $professor->national_code;
        $experience = $professor->experience;
        $age = $professor->age;
        return view("Admin_Dashboard.professorEdit",
            compact('id', 'username', 'email', 'nationalCode', 'experience', 'age', 'message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfessorRequest  $request
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(UpdateProfessorRequest $request, Professor $professor)
    {
        $id = $professor->id;
        $newProfessor = Professor::where('email', $request->email)->first();
        if ($newProfessor != null && $newProfessor->id != $professor->id){
            return redirect("/professor/$id/edit")->with(["message"=>"You can not use this email."]);
        }
        $newProfessor = Professor::where('national_code', $request->national_code)->first();
        if ($newProfessor != null && $newProfessor->id != $professor->id){
            return redirect("/professor/$id/edit")->with(["message"=>"You can not use this national code."]);
        }
        $professor->update($request->all());
        return redirect("/professor/$id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Professor  $professor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        //
    }

    public function showLogin (){
        $message = Session::get("message");
        Session::remove("message");

        return view("Signup_And_Login.Professor.login", ["message"=>$message]);
    }

    public function login (LoginProfessorRequest $request){
        $credentials = ['password' => $request->password, 'national_code' => $request->national_code, 'status' => 1];

        if (Auth::guard("professor")->attempt($credentials)){
            return redirect('/professor/dashboard');
        }

        $professor = Professor::where(['national_code' => $request->national_code])->get()->first();
        if ($professor == null)
            return redirect("/professor/login")->with(["message"=>'No professor exists with this national code']);
        else if (!Hash::check($request->password, $professor->password))
            return redirect("/professor/login")->with(["message"=>'Password is wrong']);
        return redirect("/professor/login")->with(["message"=>'Please be patient while you wait for admin approval']);
    }

    public function dashboard (){
        $username = Auth::guard("professor")->user()->username;
        $id = Auth::guard("professor")->user()->id;
        $notifications = DB::table("notifications")->where(["user_id"=>$id, "type"=>"professor", "deleted_at"=>null])->get();
        return view("Professor_Dashboard.Dashboard.dashboard", ["username"=>$username, "notifications"=>$notifications]);
    }

    public function changeStatus (Request $request){
        $id = $request->id;
        $professor = Professor::where('id', $id)->first();
        $professor->update(['status'=>$professor->status == 0 ? 1 : 0]);
    }

    public function logout (){
        Auth::guard("professor")->logout();
        return redirect("/login");
    }

    public function courses (){
        $username = Auth::guard("professor")->user()->username;
        $courses = Course::where('professor_id', Auth::guard("professor")->user()->id)->get();
        return view("Professor_Dashboard.Course.show", ["username"=>$username, "courses"=>$courses]);
    }

    public function courseStudents (Course $course){
        $username = Auth::guard("professor")->user()->username;
        $name = $course->title;
        $students = $course->students()->get();
        return view("Professor_Dashboard.Course.courseStudents", ["students"=>$students, "name"=>$name, "username"=>$username]);
    }
}
