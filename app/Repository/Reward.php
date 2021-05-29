<?php

namespace App\Repository;

use App\Models\Reward as Inam; // Eng -> Urdu

class Reward 
{
    public function get($id = null)
    {
        $rewards = Inam::all();
        if(!is_null($id))
            $rewards = Inam::find($id);

        return $rewards;
    }

    public function save($request, $id = null) 
    {
        $reward = new Inam;

        if (!is_null($id)) 
            $reward = Inam::find($id);

        $reward->coins = $request->coins;
        $reward->status = $request->status == 'on' ? 1 : 0;
        $reward->limit = $request->limit;
        $reward->icon = $request->icon;
        $reward->is_ads_available = $request->is_ads_available == 'on' ? 1 : 0;
        $reward->expire_at = $request->expire_at;
        $reward->ad = $request->ad;
        $reward->order = $request->order;

        if ($request->hasFile('icon')) {

            $image = $request->file('icon');
            $name = 'Inam_' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/images/rewards');
            $image->move($destinationPath, $name);
            $reward->icon = $name;   
        }

        $reward->save();

        return $reward;
    }

    public function delete($id)
    {
        Inam::destroy($id);
    }
    
}