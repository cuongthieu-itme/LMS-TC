<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentExam;
use Yajra\DataTables\DataTables;

class StudentExamController extends Controller
{
    public function index()
    {
        return view('student.student_exams.index');

    }// end of index

    public function data()
    {
        $studentExams = StudentExam::query()
            ->with(['teacher', 'student', 'section', 'project'])
            ->whenTeacherId(request()->teacher_id)
            ->whenExaminerId(request()->examiner_id)
            ->whenStudentId(auth()->user()->id)
            ->whenStatus(request()->status)
            ->whenAssessment(request()->assessment);

        return DataTables::of($studentExams)
            ->addColumn('teacher', function (StudentExam $studentExam) {
                return $studentExam->teacher?->name;
            })
            ->addColumn('examiner', function (StudentExam $studentExam) {
                return $studentExam->examiner?->name;
            })
            ->addColumn('student', function (StudentExam $studentExam) {
                return $studentExam->student->name;
            })
            ->addColumn('project', function (StudentExam $studentExam) {
                return $studentExam->project->name;
            })
            ->addColumn('section', function (StudentExam $studentExam) {
                return $studentExam->section->name;
            })
            ->addColumn('status', function (StudentExam $studentExam) {
                return __('student_exams.' . $studentExam->status);
            })
            ->editColumn('created_at', function (StudentExam $studentExam) {
                return $studentExam->created_at->format('Y-m-d');
            })
            ->addColumn('actions', function (StudentExam $studentExam) {
                return view('student.student_exams.data_table.actions', compact('studentExam'));
            })
            ->rawColumns(['actions'])
            ->toJson();

    }// end of data

    public function show(StudentExam $studentExam)
    {
        return view('student.student_exams.show', compact('studentExam'));

    }// end of show

}//end of model