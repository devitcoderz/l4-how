<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OpenAiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminDashboardController extends Controller
{
    protected $openAiService;

    public function __construct(OpenAiService $openAiService)
    {
        $this->openAiService = $openAiService;
    }

    public function index()
    {
        $user = Auth::user();
        $userModel = User::find($user->id);
        $userPatients = User::where('id', $user->id)->with('patients')->first()->patients;
        $userPrompts = $userModel->prompts;

        $documents = collect();
        $patient = 0;
        $finalText = '';

        return view('admin.dashboard', compact('finalText', 'patient', 'userPatients', 'userPrompts', 'documents'));
    }

    public function change_password(){
        return view("admin.change-password");
    }

    public function change_password_submit(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed|min:3'
        ],[
            'current_password'=>[
                'required'=>'Current password is required'
            ],
            'password'=>[
                'required'=>'Password is required',
                'confirmed'=>'Password must macth with confirm password',
                'min'=>'Password must contain minimum :min letters'
            ]
        ],$request->all());
        
        // Get the current logged-in user
        $user = User::find(Auth::user()->id);

        // Check if the provided current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password does not match.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Optionally, return a success message or redirect
        return back()->with('success', 'Password changed successfully.');
    }

}
