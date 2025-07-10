<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExamTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamRequest;
use App\Models\Exam;
use App\Models\Project;
use Yajra\DataTables\DataTables;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_exams')->only(['index']);
        $this->middleware('permission:create_exams')->only(['create', 'store']);
        $this->middleware('permission:update_exams')->only(['edit', 'update']);
        $this->middleware('permission:delete_exams')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        $projects = Project::query()
            ->get();

        return view('admin.exams.index', compact('projects'));

    }// end of index

    public function data()
    {
        $exams = Exam::query()
            ->with(['project'])
            ->whenProjectId(request()->project_id);

        return DataTables::of($exams)
            ->addColumn('record_select', 'admin.exams.data_table.record_select')
            ->addColumn('project', function (Exam $exam) {
                return $exam->project->name;
            })
            ->addColumn('actions', 'admin.exams.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $projects = Project::query()
            ->get();

        return view('admin.exams.create', compact('projects'));

    }// end of create

    public function store(ExamRequest $request)
    {
        Exam::create($request->validated());

        session()->flash('success', __('site.added_successfully'));

        return response()->json([
            'redirect_to' => route('admin.exams.index'),
        ]);

    }// end of store

    public function edit(Exam $exam)
    {
        $exam->load(['project']);

        $projects = Project::query()
            ->get();

        return view('admin.exams.edit', compact('projects', 'exam'));

    }// end of edit

    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));

        return response()->json([
            'redirect_to' => route('admin.exams.index'),
        ]);

    }// end of update

    public function destroy(Exam $exam)
    {
        $this->delete($exam);

        return response()->json([
            'success_message' => __('site.deleted_successfully'),
        ]);

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $exam = Exam::FindOrFail($recordId);
            $this->delete($exam);

        }//end of for each

        return response()->json([
            'success_message' => __('site.deleted_successfully'),
        ]);

    }// end of bulkDelete

    private function delete(Exam $exam)
    {
        $exam->delete();

    }// end of delete

}//end of controller