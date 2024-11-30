<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'is_admin' => 'boolean'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
            'is_admin' => 'boolean'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;

        if ($request->filled('password'))
        {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function asign_prompt($userId, $promptId)
    {
        $user = User::find($userId);
        // $user = User::where("id",$userId)->with("prompts")->first();
        // dd($user);
        // $user->prompts()->attach($promptId);
        $user->prompts()->detach($promptId);

        return true;
    }

    public function user_patients($userId){
        $user = User::where("id",$userId)->with("patients")->first();
        if($user){
            return view("admin.user-patients",compact('user'));
        }else{
            return redirect()->route('admin.users')->with("message",["color"=>'red','msg'=>'User not found']);
        }
    }

    public function user_patients_delete($userId,$patientId){
        $deleted = Patient::where("id",$patientId)->delete();
        if($deleted){
            Document::where("patient_id",$patientId)->delete();
            return redirect()->route('admin.users.patients',$userId)->with("message",['color'=>'green','msg'=>'Patient deleted successfully.']);
        }else{
            return redirect()->route('admin.users.patients',$userId)->with("message",['color'=>'red','msg'=>'Something went wrong with deleting patient']);
        }
        
    }

    public function user_patient_documents($userId,$patientId){
        $patient = Patient::where("id",$patientId)->with(['user',"documents"])->first();
        if($patient){
            return view("admin.user-patient-documents",compact('patient'));
        }else{
            return redirect()->route('admin.users.patients',$userId)->with("message",["color"=>'red','msg'=>'Patient not found']);
        }
    }

    public function user_patient_documents_delete($userId,$patientId,$docId){
        $deleted = Document::where("id",$docId)->delete();
        if($deleted){
            return redirect()->route('admin.users.patients.documents',[$userId,$patientId])->with("message",['color'=>'green','msg'=>'Document deleted successfully.']);
        }else{
            return redirect()->route('admin.users.patients.documents',[$userId,$patientId])->with("message",['color'=>'red','msg'=>'Something went wrong with deleting document']);
        }
    }
}
