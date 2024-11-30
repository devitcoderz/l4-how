<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserDashboardController extends Controller
{
    public function index()
    {
        dd("not yet developed");
        // $user = Auth::user();
        // $userModel = User::find($user->id);
        // $userPatients = User::where('id', $user->id)->with('patients')->first()->patients;
        // $userPrompts = $userModel->prompts;

        // $documents = collect();
        // $finalText = '';

        // if (Session::has('patientS'))
        // {
        //     Session::forget('patientS');
        // }

        // return view('user.dashboard', compact('finalText', 'userPatients', 'userPrompts', 'documents'));
    }

    public function change_password()
    {
        return view("user.change-password");
    }

    public function change_password_submit(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:3'
        ], [
            'current_password' => [
                'required' => 'Current password is required'
            ],
            'password' => [
                'required' => 'Password is required',
                'confirmed' => 'Password must macth with confirm password',
                'min' => 'Password must contain minimum :min letters'
            ]
        ], $request->all());

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
