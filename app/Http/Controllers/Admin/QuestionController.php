<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Question;
use App\Repository\Chapter;

use Toastr;
use DataTables;

class QuestionController extends Controller
{
    public $question;
    public $chapter;

    public function __construct(Question $question, Chapter $chapter) {
        $this->question = $question;
        $this->chapter = $chapter;
    }

     // shows the list of all questions.
    public function index(){
        $questionCols = $this->question->get();
		return view('admin.question.index')->with([ 
			'questionCols' => $questionCols // sending the list to view.
		]);
    }
    
    public function ajaxIndex(){
		
		$questions = $this->question->get(); 
		$url = \URL::to('/');
		// return $users;
        return Datatables::of($questions)
        ->editColumn('question', function ($questions) use ($url) {
            return "<a href='{$url}/admin/question/edit/{$questions->id}'>{$questions->question}</a>";
        })
        ->editColumn('chapter_id', function ($questions) use ($url) {
            return $questions->chapter->name ?? '';
        })
        ->editColumn('added_by', function ($questions) use ($url) {
            return $questions->user->name ?? '';
        })
        ->addColumn('action', function ($questions) use ($url) {
			return "<a class='text-primary' href='{$url}/admin/question/view/{$questions->id}' data-toggle='tooltip' data-placement='top' title='' data-original-title='View'><i class='bx bx-eye'></i></a><a class='text-danger' href='{$url}/admin/user/delete/{$questions->id}' data-toggle='tooltip' data-placement='top' title='Delete the question' data-original-title='Delete'><i class='bx bx-trash'></i></a>";
        })
        ->rawColumns(['question', 'action'])
		->make(true);
		
	}

    // shows the creating a questions page.
	public function create($chapId = null) {
        $chapter = null;
        if (!is_null($chapId))
            $chapter = $this->chapter->get($chapId);

		return view('admin.question.create', compact('chapter'));
    }

    public function edit($id) {
        $question = $this->question->get($id);
		return view('admin.question.edit')->with([
            'question' => $question
        ]);
    }

    public function delete($id) {
        try {
            $this->question->delete($id);

            Toastr::success('Question deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Question has chapters. Please, delete chapters first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        
        $req->validate([
            'question' => 'required|string',
            'explaination' => 'required|string',
            'chapterId' => 'nullable|numeric'
        ]);

        try {
            $question = $this->question->save($req);
            Toastr::success('Question has been added successfully', 'Success');
            // return redirect($req->redirect_to);
            return redirect('/admin/question/edit', $question->id);

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        $req->validate([
            'question' => 'required|string',
            'explaination' => 'required|string',
            'id' => 'required|numeric'
        ]);

        try {
            $this->question->save($req, $req->id);
            Toastr::success('Question has been updated successfully', 'Success');
            return redirect()->back();

        } catch (\Throwable $th) {
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }


    /**
     * Options 
     */

    public function optionSubmit(Request $req) {
        
        $req->validate([
            'option' => 'required|string',
            'questionId' => 'required|numeric'
        ]);

        try {
            $this->question->optionSave($req);
            Toastr::success('Question Option has been added successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function optionUpdate(Request $req) {
        $req->validate([
            'option' => 'required|string',
            'id' => 'required|numeric'
        ]);

        try {
            $this->question->optionSave($req, $req->id);
            Toastr::success('Question Option has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);
            

        } catch (\Throwable $th) {
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function optionDelete($id) {
        try {
            $this->question->optionDelete($id);

            Toastr::success('Question Option deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Question Option has chapters. Please, delete chapters first');
            return redirect()->back();
        
        }
    }

    /**
     * Update Correct Option
     */
    public function updateCorrectOption(Request $req) {
        try {
            $this->question->updateCorrectOption($req);
            return response()->json([
                'status' => 'success',
                'message' => 'Option has been updated successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Question Not Found'
            ], 404);
        }
    }


}
