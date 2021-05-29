<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportedIssue;

use DB;
use Toastr;
use DataTables;

class ReportedIssueController extends Controller
{
    // shows the list of all reportedIssues.
    public function index(){
		return view('admin.reportedIssue.index');
    }

    public function ajaxIndex(){
		
		/**
         * @return users with Data Table instance. 
         */

		$reportedIssues = ReportedIssue::all(); // get all reportedIssues here.

		$url = \URL::to('/');
		// return $users;
        return Datatables::of($reportedIssues)
        ->editColumn('name', function ($reportedIssues) use ($url) {
            return "<a href='{$url}/admin/reported-issue/edit/{$reportedIssues->id}'>{$reportedIssues->name}</a>";
        })
        ->addColumn('action', function ($reportedIssues) use ($url) {
			return "<a class='text-primary' href='{$url}/admin/reported-issue/view/{$reportedIssues->id}' data-toggle='tooltip' data-placement='top' title='' data-original-title='View'><i class='bx bx-eye'></i></a>
                    <a class='text-danger' href='{$url}/admin/reported-issue/delete/{$reportedIssues->id}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete'><i class='bx bx-trash'></i></a>";
        })
        ->rawColumns(['name', 'action'])
		->make(true);
		
	}
    
    
    // shows the creating a reportedIssue page.
	public function create(){
		return view('admin.reportedIssue.create');
    }

    // shows the edit page of reportedIssue.
    public function edit($id){
		$reportedIssue = ReportedIssue::find($id); // getting the speific reportedIssue to edit
		return view('admin.reportedIssue.edit')->with([
			'reportedIssue' => $reportedIssue // sending reportedIssue record to edit view.
		]);
    }

    // shows the deleting method of reportedIssue.
    public function delete($id){

		try {
			ReportedIssue::destroy($id); // checks the if reportedIssue is deletable or not.
		} catch (\Throwable $th) {
            abort(404); // if argu is wrong then 404 page.
		}

		// Toastr is notification package we are using for project.
		Toastr::success('reportedIssue record deleted successfully', 'Success');
		return redirect()->back(); // redirecting back to list page.
	}
    
    // submitting record to Database.
	public function submit(Request $request){

		$request->validate([
			'name' => 'required|string',
            'value' => 'nullable|string',
            'description' => 'nullable|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$reportedIssue = new ReportedIssue;
			$reportedIssue->name = $request->name;
			$reportedIssue->value = $request->value;
            $reportedIssue->save();

		} catch (\Throwable $th) {
			dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('ReportedIssue added successfully', 'Success');
		
		if($request->ajax())
			return response()->json(ReportedIssue::all(), 200);
		else
        	return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
	}
    
    // update a specific reportedIssue in database.
    public function update(Request $request){

		$request->validate([
			'name' => 'required|string',
            'value' => 'nullable|string',
            'description' => 'nullable|string'
		]);
		
		DB::beginTransaction(); // starting transaction for runtime db error.
		// if one query executed and other gives error then both will be roll backed. 
		try {
			// dd($request->all()); // debugging method die dump.
			$reportedIssue = ReportedIssue::findOrFail($request->id);
			$reportedIssue->name = $request->name;
			$reportedIssue->value = $request->value;
            $reportedIssue->save();

		} catch (\Throwable $th) {
			// dd($th);
			DB::rollback();
			Toastr::error('Server side error');
			return redirect()->back();
		}

		DB::commit();
		Toastr::success('ReportedIssue updated successfully', 'Success');
		
		if($request->ajax())
			return response()->json(ReportedIssue::all(), 200);
		else
        	return isset($request->redirect_to) ? redirect($request->redirect_to) : redirect()->back();
        
	}
}
