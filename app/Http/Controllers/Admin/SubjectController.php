<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Subject;

use Toastr;

class SubjectController extends Controller
{
    public $subject;

    public function __construct(Subject $subject) {
        $this->subject = $subject;
    }

     // shows the list of all subjects.
    public function index(){
        $subjectCols = $this->subject->get();
		return view('admin.subject.index')->with([ 
			'subjectCols' => $subjectCols // sending the list to view.
		]);
    }
    
    // shows the creating a subjects page.
	public function create() {
		return view('admin.subject.create');
    }

    public function edit($id) {
        $subject = $this->subject->get($id);
		return view('admin.subject.edit')->with([
            'subject' => $subject
        ]);
    }

    public function delete($id) {
        try {
            $this->subject->delete($id);

            Toastr::success('Subject deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Subject has chapters. Please, delete chapters first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        // $_POST[]
        $req->validate([
            'name' => 'required|string',
            'coinsPerQuestion' => 'required|integer',
            'description' => 'string|nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        try {
            $this->subject->save($req);
            Toastr::success('Subject has been added successfully', 'Success');
            return redirect($req->redirect_to);

        } catch (\Throwable $th) {
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        $req->validate([
            'name' => 'required|string',
            'coinsPerQuestion' => 'required|integer',
            'description' => 'string|nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        try {
            $this->subject->save($req, $req->id);
            Toastr::success('Subject has been added successfully', 'Success');
            return redirect($req->redirect_to);

        } catch (\Throwable $th) {
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    
}
