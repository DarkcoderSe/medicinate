<?php

namespace App\Repository;

use App\Models\Subject as Sub;

class Subject 
{
    public function get($id = null)
    {
        $subjects = Sub::all();
        if(!is_null($id))
            $subjects = Sub::find($id);

        return $subjects;
    }

    public function save($request, $id = null) 
    {
        if (is_null($id)) 
            $subject = new Sub;
        else 
            $subject = Sub::find($id);

        $subject->name = $request->name;
        $subject->coins_per_question = $request->coinsPerQuestion;
        $subject->description = $request->description;
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $name = 'subj_' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/images/subjects');
            $image->move($destinationPath, $name);
            $subject->image = $name;   
        }

        $subject->save();
        return $subject;
    }

    public function delete($id)
    {
        Sub::destroy($id);
        // Toastr::success('')
    }
}