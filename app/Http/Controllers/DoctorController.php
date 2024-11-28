<?php

namespace App\Http\Controllers;

use App\Models\Accounter;
use App\Models\APD;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
   
    public function index()
    {
        $doctors = Doctor::all();
        
        return view('doctor.index',['doctors'=>$doctors]);
    }

    public function create()
    {
        $depts = Department::all();

        return view('doctor.create',['depts'=>$depts]);
    }

    public function store(Request $request)
{
    // Validate request
    $request->validate([
        'name' => ['required', 'string'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:6'],
        'phone' => ['required', 'string'],
        'address' => ['required', 'string'],
        'specialization' => ['required'],
    ]);

    // Create user first
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Assign doctor role
    $user->assignRole('doctor');

    // Create associated doctor record
    $doctor = Doctor::create([
        'user_id' => $user->id,
        'phone' => $request->phone,
        'address' => $request->address,
        'specialization' => $request->specialization,
        'dept_id' => $request->department,
    ]);

    return redirect()->route('doctor.index');
}
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $depts = Department::all();
        return view('doctor.create', ['doctor' => $doctor,'depts'=>$depts]);
    }

    public function update(Request $request, $doctor_id)
{
    $doctor = Doctor::where('id', $doctor_id)->first();
    
    $request->validate([
        'name' => ['required', 'string'],
        'email' => ['required', 'email', 'unique:users,email,' . $doctor->user_id],
        'phone' => ['required', 'string'],
        'address' => ['required', 'string'],
        'specialization' => ['required'],
    ]);

    // Update user information
    $doctor->user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // Update password if provided
    if ($request->filled('password')) {
        $doctor->user->update([
            'password' => Hash::make($request->password)
        ]);
    }

    // Update doctor information
    $doctor->update([
        'phone' => $request->phone,
        'address' => $request->address,
        'specialization' => $request->specialization,
        'dept_id' => $request->department,
    ]);
    
    return redirect()->route('doctor.index');
}
     public function destroy($doctor_id)
     { 
        
        $doctor = Doctor::where('id',$doctor_id)->first();

         $doctor->delete();
       
         return redirect()->route('doctor.index');

     }

    public function show($doctor_id) {
        $doctor = Doctor::with('Dept','APD','Lazer.patient')->find($doctor_id); // Fetch the product by ID
        return view('doctor.show', ['doctor'=>$doctor]); // Pass the product to the view
    }

}
