<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Setting;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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

    public function settings(){
        $settings = Setting::first();
        return view("admin.settings",compact('settings'));
    }

    public function save_settings(Request $request){
        // Validate the incoming request
        $validatedData = $request->validate([
            'banner_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shadow_color' => 'nullable|string',
            'countdown_color' => 'nullable|string',
            'table_title_color' => 'nullable|string',
            'table_border_color' => 'nullable|string',
            'table_prizes_color' => 'nullable|string',
            'table_text_color' => 'nullable|string',
            'button_text_color' => 'nullable|string',
            'button_background_color' => 'nullable|string',
            'button_background_hover_color' => 'nullable|string',
            'text_color' => 'nullable|string',
            // Add validation for other fields as needed
        ]);

        $settings = Setting::firstOrNew(); // Assuming you have a `Settings` model to store these settings

        // Handle image uploads
        if ($request->hasFile('banner_img')) {
            $bannerImg = $request->file('banner_img');
            $bannerImgName = $bannerImg->getClientOriginalName(); // Get original file name
            $bannerImg->storeAs('images', $bannerImgName, 'public'); // Store image with the original name
            $settings->banner_img = $bannerImgName; // Save only the file name in the database
        }

        if ($request->hasFile('background_img')) {
            $backgroundImg = $request->file('background_img');
            $backgroundImgName = $backgroundImg->getClientOriginalName(); // Get original file name
            $backgroundImg->storeAs('images', $backgroundImgName, 'public'); // Store image with the original name
            $settings->background_img = $backgroundImgName; // Save only the file name in the database
        }


        // Update other fields
        $settings->shadow_color = $validatedData['shadow_color'] ?? $settings->shadow_color;
        $settings->countdown_color = $validatedData['countdown_color'] ?? $settings->countdown_color;
        $settings->table_title_color = $validatedData['table_title_color'] ?? $settings->table_title_color;
        $settings->table_border_color = $validatedData['table_border_color'] ?? $settings->table_border_color;
        $settings->table_prizes_color = $validatedData['table_prizes_color'] ?? $settings->table_prizes_color;
        $settings->table_text_color = $validatedData['table_text_color'] ?? $settings->table_text_color;
        $settings->button_text_color = $validatedData['button_text_color'] ?? $settings->button_text_color;
        $settings->button_background_color = $validatedData['button_background_color'] ?? $settings->button_background_color;
        $settings->button_background_hover_color = $validatedData['button_background_hover_color'] ?? $settings->button_background_hover_color;
        $settings->text_color = $validatedData['text_color'] ?? $settings->text_color;

        // Save the updated settings
        $settings->save();

        // Redirect back with success message
        return redirect()->back()->with('message', ["bg"=>"green","msg"=>'Settings updated successfully!']);
    }
}
