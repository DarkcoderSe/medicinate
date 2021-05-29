<?php

namespace App\Repository;

use App\Models\Badge as Alamat; // Eng -> Urdu

class Badge 
{
    public function get($id = null)
    {
        $badges = Alamat::all();
        if(!is_null($id))
            $badges = Alamat::find($id);

        return $badges;
    }

    public function save($request, $id = null) 
    {
        $badge = new Alamat;

        if (!is_null($id)) 
            $badge = Alamat::find($id);

        $badge->name = $request->name;
        $badge->status = $request->status == 'on' ? 1 : 0;
        $badge->required_test = $request->requiredTest;
        $badge->description = $request->description;

        $badge->max_score = $request->maxScore;
        $badge->min_score = $request->minScore;

        if ($request->hasFile('icon')) {

            $image = $request->file('icon');
            $name = 'Alamat_' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/images/badges');
            $image->move($destinationPath, $name);
            $badge->icon = $name;   
        }

        $badge->save();

        return $badge;
    }

    public function delete($id)
    {
        Alamat::destroy($id);
    }
    
}