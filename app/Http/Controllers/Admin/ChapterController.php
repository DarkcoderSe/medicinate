<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\Chapter;

use Toastr;

class ChapterController extends Controller
{
    public $chapter;

    public function __construct(Chapter $chap) {
        $this->chapter = $chap;
    }

    public function edit($id) {
        $chapter = $this->chapter->get($id);
		return view('admin.chapter.edit')->with([
            'chapter' => $chapter
        ]);
    }

    public function delete($id) {
        try {
            $this->chapter->delete($id);

            Toastr::success('Chapter deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('This Chapter has some tests. Please, delete tests first');
            return redirect()->back();
        
        }
    }

    public function submit(Request $req) {
        // dd($req->all());

        $req->validate([
            'name' => 'required|string',
            'subjectId' => 'required|integer'
        ]);

        try {
            $this->chapter->save($req);
            Toastr::success('Chapter has been added successfully', 'Success');
            return redirect($req->redirect_to);

        } catch (\Throwable $th) {
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $req) {
        $req->validate([
            'name' => 'required|string'
        ]);

        try {
            $this->chapter->save($req, $req->id);
            Toastr::success('Chapter has been updated successfully', 'Success');
            return redirect($req->redirect_to);

        } catch (\Throwable $th) {
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }


    //
}
