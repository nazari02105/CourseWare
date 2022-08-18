<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/login", function () {
    return view('welcome');
})->name("login");

Route::group(['prefix' => 'professor'], function () {
    Route::get("login", [ProfessorController::class, 'showLogin']);
    Route::post("login", [ProfessorController::class, 'login']);
    Route::get("dashboard", [ProfessorController::class, 'dashboard'])
        ->middleware('auth:professor');
    Route::get("logout", [ProfessorController::class, 'logout'])
        ->middleware("auth:professor");
    Route::get("courses", [ProfessorController::class, 'courses'])
        ->middleware("auth:professor");
    Route::get("course/{course}/students", [ProfessorController::class, "courseStudents"])
        ->middleware("auth:professor");
    Route::get("course/{course}/exams", [ExamController::class, "courseExams"])
        ->middleware("auth:professor");
});
Route::resource("/professor", ProfessorController::class);

Route::group(["prefix" => "student"], function () {
    Route::get("logout", [StudentController::class, "logout"])->middleware("auth:student");
    Route::get("courses", [StudentController::class, "courses"])->middleware("auth:student");
    Route::get("course/{course}/exams", [StudentController::class, "courseExams"])->middleware("auth:student");
    Route::get("/exam/{exam}/question/{number}", [StudentController::class, "examQuestions"])->middleware("auth:student");
    Route::post("/exam/start", [StudentController::class, "startExam"])->middleware("auth:student");
    Route::post("/save/answer", [StudentController::class, "saveAnswer"])->name("student.answer");
    Route::get("/exam/{exam}/finish", [StudentController::class, "finishExam"])->middleware("auth:student");
});
Route::get("/student/login", [StudentController::class, 'showLogin']);
Route::post("/student/login", [StudentController::class, 'login']);
Route::get("/student/dashboard", [StudentController::class, 'dashboard'])
    ->middleware('auth:student');
Route::resource("/student", StudentController::class);

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminController::class, 'showLogin']);
    Route::post('login', [AdminController::class, 'login']);
    Route::get('dashboard', [AdminController::class, 'dashboard'])
        ->middleware('auth:admin');
    Route::get('logout', [AdminController::class, 'logout'])
        ->middleware('auth:admin');
    Route::get('pending', [AdminController::class, 'pending'])
        ->middleware('auth:admin');
    Route::get('user', [AdminController::class, 'allUsers'])
        ->middleware('auth:admin');
    Route::get('professor/status', [ProfessorController::class, 'changeStatus'])
        ->middleware("auth:admin");
    Route::get('student/status', [StudentController::class, 'changeStatus'])
        ->middleware("auth:admin");
    Route::get('role/search', [SearchController::class, 'getSearchPage'])
        ->middleware("auth:admin");
    Route::get('role/get', [SearchController::class, 'getRole'])
        ->middleware("auth:admin", "throttle:10,1");
});

Route::group(['prefix' => 'course'], function () {
    Route::get('/{course}/students', [CourseController::class, 'courseStudents'])
        ->middleware('auth:admin');
    Route::get('/change/professor', [CourseController::class, 'changeProfessorForm'])
        ->middleware('auth:admin');
    Route::post('/change/professor', [CourseController::class, 'changeProfessor'])
        ->middleware('auth:admin');
    Route::get('/add/student', [CourseController::class, 'addStudentPage'])
        ->middleware('auth:admin');
    Route::post('/add/student', [CourseController::class, 'addStudent'])
        ->middleware('auth:admin');
    Route::delete('/delete/student', [CourseController::class, 'deleteStudent'])
        ->middleware('auth:admin');
});
Route::resource("/course", CourseController::class);

Route::group(['prefix' => 'exam'], function () {
    Route::get("/{exam}/builder", [ExamController::class, 'examBuilder']);
    Route::get("/{exam}/add/question/bank", [QuestionController::class, "addFromBank"])
        ->middleware("auth:professor");
    Route::get("/{exam}/add/question", [QuestionController::class, "create"])
        ->middleware("auth:professor");
    Route::get("/{exam}/see/question", [QuestionController::class, "examQuestions"])
        ->middleware("auth:professor");
    Route::get("/{exam}/result", [ExamController::class, "examResults"])
        ->middleware("auth:professor");
    Route::get("/detail", [ExamController::class, "examDetail"])
        ->middleware("auth:professor");
    Route::post("/score/update", [ExamController::class, "updateScore"])
        ->middleware("auth:professor")->name("exam.updateScore");
});
Route::resource("exam", ExamController::class);

Route::group(['prefix' => 'question'], function () {
    Route::post("/store", [QuestionController::class, "store"])
        ->middleware("auth:professor");
    Route::get("/add", [QuestionController::class, "addToExam"]);
    Route::delete("/exam/delete", [QuestionController::class, "deleteFromExam"])
        ->middleware("auth:professor");
    Route::get("/score", [QuestionController::class, "setScore"])
        ->middleware("auth:professor");
    Route::get("/all", [QuestionController::class, "index"])
        ->middleware("auth:professor");
    Route::get("/{question}/edit", [QuestionController::class, "edit"])
        ->middleware("auth:professor");
    Route::patch("/{question}/update", [QuestionController::class, "update"])
        ->middleware("auth:professor");
});

Route::get("/{type}/notification/{id}/delete", [NotificationController::class, "deleteNotification"]);
