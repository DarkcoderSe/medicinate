<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Donation;
use App\Models\DonationMedicine;

use DB;
use Toastr;

class DonationController extends Controller
{
    public function index()
    {
        return view('donation.index');
    }

    public function history()
    {
        $donations = Donation::where('user_id', auth()->user()->id)->get();
        return view('donation.history')->with([
            'donations' => $donations
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'address' => 'nullable|string',
        ]);

        DB::beginTransaction();
        
        try {
            
            $donation = new Donation;
            $donation->is_guest = auth()->check() ? 0 : 1;
            $donation->user_id = auth()->user()->id ?? null;
            $donation->is_not_controlled_substance = $request->is_not_controlled_substance == 'on' ? 1 : 0;
            $donation->not_expire_in_5_month = $request->not_expire_in_5_month == 'on' ? 1 : 0;
            $donation->sealed_packaging = $request->sealed_packaging == 'on' ? 1 : 0;
            $donation->not_require_refrigeration = $request->not_require_refrigeration == 'on' ? 1 : 0;
            $donation->shipping_paid = $request->shipping_paid == 'on' ? 1 : 0;

            $donation->name = $request->name;
            $donation->email = $request->email;
            $donation->address = $request->address;
            $donation->donation_weight = $request->donation_weight;
            $donation->donation_weight_standard = $request->donation_weight_standard;
            $donation->expected_cost = $request->expected_cost;
            $donation->save();

            if (count($request->drugName) > 0) {
                for ($i = 0; $i < count($request->drugName); $i++) {
                    $donationMedicine = new DonationMedicine;
                    $donationMedicine->donation_id = $donation->id;
                    $donationMedicine->name = $request->drugName[$i];
                    $donationMedicine->ndc = $request->ndc[$i];
                    $donationMedicine->expire_date = $request->expire_date[$i];
                    $donationMedicine->quantity = $request->quantity[$i];
                    $donationMedicine->quantity_type = $request->quantity_type[$i];
                    $donationMedicine->save();
                }
            }

            
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        DB::commit();
        Toastr::success('Your Donation has been sent successfully', 'Donation Sent');
        return redirect()->back();
    }
}
