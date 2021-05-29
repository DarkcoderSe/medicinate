<?php

namespace App\Repository;

use App\Models\ContactUs as Rabta; // Eng -> Urdu

class ContactUs
{
    public function get($id = null, $userId = null)
    {
        if($id == 'null') $id = null;

        $messages = Rabta::with('user')->orderBy('created_at', 'DESC')->get();
        if(!is_null($userId))
            $messages = Rabta::with('user')->where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
        elseif(!is_null($id))
            $messages = Rabta::with('user')->find($id); 

        return $messages;
    }

    public function delete($id)
    {
        Rabta::destroy($id);
    }

    public function save($request, $id = null) 
    {
        if (is_null($id)) 
            $contact = new Rabta;
        else 
            $contact = Rabta::find($id);

        $contact->status = $request->status == 'on' ? 0 : 1;
        $contact->admin_notes = $request->admin_notes;

        $contact->save();
        return $contact;
    }


}