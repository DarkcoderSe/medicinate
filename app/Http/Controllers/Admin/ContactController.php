<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\ContactUs;

use Toastr;
use DataTables;

class ContactController extends Controller
{
    public $contact;

    public function __construct(ContactUs $contact) {
        $this->contact = $contact;
    }

    public function index($id = null, $userId = null) {

		return view('admin.contact.index')->with([ 
			'id' => $id,
            'userId' => $userId
		]);
    }

    public function ajaxIndex($id = null, $userId = null) {

        $contacts = $this->contact->get($id, $userId);

		$url = \URL::to('/');
		// return $contacts;
        return Datatables::of($contacts)
        ->editColumn('name', function ($contacts) use ($url) {
            if(!is_null($contacts->user))
                return "<a href='{$url}/admin/contact/null/{$contacts->id}'>{$contacts->name}</a>";
            else 
                return $contacts->name;
        })
		->editColumn('status', function ($contacts) use ($url) {
            if ($contacts->status) 
                return "Active";
            else 
                return "Not-Active";
		})
        ->addColumn('action', function ($contacts) use ($url) {
			return "<a class='text-primary' href='{$url}/admin/contact/view/{$contacts->id}' data-toggle='tooltip' data-placement='top' title='' data-original-title='View'><i class='bx bx-edit'></i></a>&nbsp;&nbsp;
            <a class='text-danger' href='{$url}/admin/contact/delete/{$contacts->id}' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete'><i class='bx bx-trash'></i></a>";
        })
        ->rawColumns(['name', 'status', 'action'])
		->make(true);
    }

    public function view($id) {
        $contact = $this->contact->get($id);
        return view('admin.contact.view', compact('contact'));
    }

    public function delete($id) {
        try {
            $this->contact->delete($id);

            Toastr::success('Message deleted successfully', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Server side error', 'Err 500');
            return redirect()->back();
        
        }
    }

    public function update(Request $req) {
        try {
            $this->contact->save($req, $req->id);
            Toastr::success('Contact Message has been updated successfully', 'Success');
            return is_null($req->redirect_to) ? redirect()->back() : redirect($req->redirect_to);

        } catch (\Throwable $th) {
            dd($th);
            Toastr::error('Server side error', 'Failure!');
            return redirect()->back()->withInput();
        }
    }

}
