<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Donation;
use App\Models\Ngo;
use App\Models\DonationToNgo;


use Toastr;


class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::all();
        $ngos = Ngo::all();

        return view('admin.donation.index')->with([
            'donations' => $donations,
            'ngos' => $ngos
        ]);
    }
    
    public function create()
    {
        $ngos = Ngo::all();
        return view('admin.donation.create')->with([
            'ngos' => $ngos
        ]);
    }

    public function update(Request $request)
    {
        DonationToNgo::where('donation_id', $request->id)->delete();

        foreach ($request->get('ngos') as $ngo) {
            $donationToNgo = new DonationToNgo;;
            $donationToNgo->donation_id = $request->get('id');
            $donationToNgo->ngo_id = $ngo;
            $donationToNgo->save();
        }

        Toastr::success('NGOs has been updated successfully', 'Success');
        return redirect()->back();
    }

    public function changeStatus($status, $donationId)
    {
        $donation = Donation::find($donationId);
        $donation->status = $status;
        $donation->save();

        Toastr::success('Status has been changed successfully', 'Success');
        return redirect()->back();
    }

    public function delete($id)
    {
        Donation::destroy($id);
        Toastr::success('Donation has been deleted successfully', 'Success');
        return redirect()->back();
    }
}
