<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getSearchPage()
    {
        return view("Admin_Dashboard.searchRole");
    }

    public function getRole(Request $request)
    {
        if ($request->role == "professor") $mainCollection = Professor::all();
        else $mainCollection = Student::all();
        $mainArray = array();
        foreach ($mainCollection as $index) {
            $mainArray[] = $index;
        }

        $username = $request->username;
        $email = $request->email;
        $nationalCode = $request->nationalCode;
        $status = $request->status;

        echo $this->filter($mainArray, $username, $email, $nationalCode, $status);
    }

    public function filter($mainArray, $username, $email, $nationalCode, $status)
    {
        foreach ($mainArray as $index) {
            if ($username != "" && $username != null && !str_contains($index->username, $username))
                array_splice($mainArray, array_search($index, $mainArray), 1);
            else if ($email != "" && $email != null && !str_contains($index->email, $email))
                array_splice($mainArray, array_search($index, $mainArray), 1);
            else if ($nationalCode != "" && $nationalCode != null && !str_contains($index->national_code, $nationalCode))
                array_splice($mainArray, array_search($index, $mainArray), 1);
            else if ($status != "" && $status != null && $index->status != $status)
                array_splice($mainArray, array_search($index, $mainArray), 1);
        }
        $result = "";
        foreach ($mainArray as $index) {
            $result .= $index->id . ":" . $index->username . "_" . $index->email . "_" . $index->national_code . "-";
        }
        return $result;
    }
}
