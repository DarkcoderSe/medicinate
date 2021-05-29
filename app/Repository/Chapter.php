<?php

namespace App\Repository;

use App\Models\Chapter as Chap;

class Chapter 
{
    public function get($id = null)
    {
        $chapters = Chap::all();
        if (!is_null($id))
            $chapters = Chap::find($id);

        return $chapters;
    }

    public function whereGet($arr, $paginate = null)
    {
        $chapters = Chap::where($arr)->get();
        return $chapters;
    }

    public function save($request, $id = null) 
    {
        if (is_null($id)) {
            $chapter = new Chap;
            $chapter->subject_id = $request->subjectId;
        }
        else 
            $chapter = Chap::find($id);

        $chapter->name = $request->name;
        $chapter->save();

        return $chapter;
    }

    public function delete($id)
    {
        Chap::destroy($id);
        // Toastr::success('')
    }
}