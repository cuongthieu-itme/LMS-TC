<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function leaveImpersonate()
    {
        auth()->user()->leaveImpersonation();

        session(['locale' => auth()->user()->locale]);

        return redirect()->route('admin.home');

    }//end of leave impersonate

}//end of controller