<?php

namespace App\Repository;

use App\Models\Ngo as NonGovtOrg; // Eng -> Urdu

class Ngo 
{
    public function get($id = null)
    {
        $ngos = NonGovtOrg::all();
        if(!is_null($id))
            $ngos = NonGovtOrg::find($id);

        return $ngos;
    }

    public function save($request, $id = null) 
    {
        $ngo = new NonGovtOrg;

        if (!is_null($id)) 
            $ngo = NonGovtOrg::find($id);

        $ngo->name = $request->name;
     
        $ngo->save();

        return $ngo;
    }

    public function delete($id)
    {
        NonGovtOrg::destroy($id);
    }
    
}