<?php

namespace App\Repository;

use App\Models\Manufacturer as Man; // Eng -> Urdu

class Manufacturer 
{
    public function get($id = null)
    {
        $manufacturers = Man::all();
        if(!is_null($id))
            $manufacturers = Man::find($id);

        return $manufacturers;
    }

    public function save($request, $id = null) 
    {
        $manufacturer = new Man;

        if (!is_null($id)) 
            $manufacturer = Man::find($id);

        $manufacturer->name = $request->name;
        $manufacturer->dmln = $request->dmln;
        $manufacturer->type_of_license = $request->type_of_license;
        $manufacturer->address = $request->address;
        $manufacturer->save();

        return $manufacturer;
    }

    public function delete($id)
    {
        Man::destroy($id);
    }
    
}