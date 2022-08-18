<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use App\Models\Professor;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLogin()
    {
        $message = Session::get("message");
        Session::remove("message");

        return view('Signup_And_Login.Admin.login', ['message' => $message]);
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = ['password' => $request->password, 'username' => $request->username];

        if (Auth::guard("admin")->attempt($credentials)) {
            return redirect('/admin/dashboard');
        }

        $admin = Admin::where(['username' => $request->username])->get()->first();
        if ($admin == null)
            return redirect("/admin/login")->with(['message' => 'No admin exists with this username']);
        return redirect("/admin/login")->with(['message' => 'Password is wrong']);
    }

    public function dashboard()
    {
        return view("Admin_Dashboard.dashboard");
    }

    public function pending()
    {
        $professors = Professor::where(["status" => 0])->get();
        $students = Student::where(["status" => 0])->get();
        return view("Admin_Dashboard.pending", ["professors" => $professors, "students" => $students]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect("/login");
    }

    public function allUsers()
    {
        $professors = Professor::all();
        $students = Student::all();
        return view("Admin_Dashboard.user", ['professors'=>$professors, 'students'=>$students]);
    }
}
