<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Test;
use App\Repository\Category;
use App\Repository\Subject;

use Toastr;

class TestController extends Controller
{
    //
    public $test;
    public $category;

    public function __construct(
                                Test $test, 
                                Category $category,
                                Subject $subject
                            ) {
        $this->test = $test;
        $this->category = $category;
        $this->subject = $subject;
    }

     // shows the list of all tests.
    public function index(){
        $tests = $this->test->get();
		return view('admin.test.index')->with([ 
			'tests' => $tests // sending the list to view.
		]);
    }
  
    // shows the creating a tests page.
	public function create($catId = null) {
        $category = null;
        $categories = $this->category->get();
        if (!is_null($catId))
            $categories = $this->category->get($catId);

		return view('admin.test.create', compact(['category', 'categories']));
    }

    public function edit($id) {
        $categories = $this->category->get();
        $test = $this->test->get($id);
        $subjects = $this->subject->get();

		return view('admin.test.edit')->with([
            'test' => $test,
            'categories' => $categories,
            'subjects' => $subjects
        ]);
    }

    public function delete($id) {
        try {
            $this->test->delete($id);

            Toastr::success('Test deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Test has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        // dd($req->all());

        $req->validate([
            'categoryId' => 'required|numeric',
            'name' => 'required|string',
            'slug' => 'required|string',
            'requiredCoins' => 'numeric|required',
            'requiredTime' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'totalQuestions' => 'required|numeric'
        ]);

        try {
            $test = $this->test->save($req);
            Toastr::success('Test has been added successfully', 'Success');
            return redirect('admin/test/edit', $test->id);
            // return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        $req->validate([
            'id' => 'required|numeric',
            'name' => 'required|string',
            'slug' => 'required|string',
            'requiredCoins' => 'numeric|required',
            'requiredTime' => 'nullable|string',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'totalQuestions' => 'required|numeric'
        ]);

        try {
            $this->test->save($req, $req->id);
            Toastr::success('Test has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Aditional CRUDs
     */
    public function deleteTestSubjectRule($id) {
        try {
            $this->test->deleteTestSubjectRule($id);

            Toastr::success('Test Question removed successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Test has some relations. Please, broke relations first');
            return redirect()->back();
        
        }
    }

    public function questionSubmit(Request $req) {
        // dd($req->all());
        try {
            $this->test->addTestSubjectRules($req);

            Toastr::success('Test Question added successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('500 Server side error');
            return redirect()->back();
        }

    }

    public function getQuestions($testId) {
        $questions = $this->test->getQuestions($testId);
        return view('admin.question.random', compact('questions'));
    }

}
