<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Donation;

use Toastr;


class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::all();
        return view('admin.donation.index')->with([
            'donations' => $donations
        ]);
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
