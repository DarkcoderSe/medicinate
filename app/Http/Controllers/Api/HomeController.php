<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\CurrentPasswordCheck;

use App\Models\Subject;
use App\Models\Category;
use App\Models\Badge;
use App\Models\PaymentMethod;
use App\Models\ContactUs;
use App\Models\ReportedIssue;

use Auth;
use Validator;
use Hash;

class HomeController extends Controller
{
    public function index(){
        $subjects = Subject::with('chapters')->get();
        $categories = Category::where('parent_id', null)
                    ->with('allChilds')
                    ->with('tests')
                    ->get();
        
        return response()->json([
            'subjects' => $subjects,
            'categories' => $categories,
            'response' => 'success'
        ], 200);
    }

    public function category(){
        $categories = Category::where('parent_id', null)
                    ->with('allChilds')
                    ->with('tests')
                    ->get();
        return response()->json([
            'categories' => $categories,
            'response' => 'success'
        ], 200);
    }

    public function addContactNumber(Request $request){
        try {
            $user = Auth::user();
            $user->contact_no = $request->contact_number;
            $user->save();
        } catch (\Throwable $th) {
            throw $th;
            return response()->json([
                'response' => 'failed'
            ], 404);
        }

        return response()->json([
            'response' => 'success'
        ], 200);
    }

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'profile_picture' => 'nullable|mimes:png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        try {
            $user = Auth::user();
            $user->name = $request->name;
            if ($request->hasFile('profile_picture')) {

                $image = $request->file('profile_picture');
                $name = 'profile' . time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('/app/public/images/profiles');
                $image->move($destinationPath, $name);
                $user->profile_picture = $name;   
            }
            $user->save();

        } catch (\Throwable $th) {
            return response()->json([
                'response' => 'failed'
            ], 404);
        }

        return response()->json([
            'response' => 'success',
            'result' => $user
        ], 200);
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'min:6', new CurrentPasswordCheck],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6', 'same:password'],
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return response()->json([
            'response' => 'success'
        ], 200);

    }

    /**
     * Badges WORK
     */
    public function badges(){
        $badges = Auth::user()->badges;

        return response()->json([
            'badges' => $badges,
            'response' => 'success'
        ], 200);

    }


    /**
     * Payment Methods
     */
    public function paymentMethods(){
        $paymentMethods = PaymentMethod::with('detail')->where('status', 1)->get();
        
        return response()->json([
            'paymentMethods' => $paymentMethods,
            'response' => 'success'
        ], 200);
    }

    /**
     * Contact us 
     */
    public function contactUs(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|numeric',
            'message' => 'nullable|string',
            'admin_notes' => 'nullable|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        $contactUs = new ContactUs;
        $contactUs->user_id = Auth::check() ? Auth::user()->id : null;
        $contactUs->name = $request->name;
        $contactUs->email = $request->email;
        $contactUs->contact_no = $request->contact_no;
        $contactUs->message = $request->message;
        $contactUs->save();

        return response()->json([
            'response' => 'success'
        ], 200);
    }

    public function report(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'contact_no' => 'nullable|numeric',
            'subject' => 'string|nullable',
            'message' => 'nullable|string',
            'reported_url' => 'nullable|string',
            'admin_notes' => 'nullable|string',
            'question_id' => 'nullable|numeric',
            'screen' => 'nullable|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'response' => 'failed',
                'result' => $validator->errors()
            ], 400);
        }

        $issue = new ReportedIssue;
        $issue->user_id = Auth::check() ? Auth::user()->id : null;
        $issue->name = $request->name;
        $issue->email = $request->email;
        $issue->contact_no = $request->contact_no;
        $issue->subject = $request->subject;
        $issue->message = $request->message;
        $issue->reported_url = $request->reported_url;
        $issue->question_id = $request->question_id;
        $issue->screen = $request->screen;
        $issue->save();

        return response()->json([
            'response' => 'success'
        ], 200);
    }
}
