<?php

namespace App\Http\Controllers;

use App\Models\APD;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientDept;
use App\Models\Storage;
use Illuminate\Http\Request;

class PatientDeptController extends Controller
{
    public function index()
    {
        $depts = Department::all();
        $patients = Patient::all();
        $doctors = Doctor::all();
        $storages = Storage::all();

        return view('patientDept' , ['depts' => $depts,'patients'=>$patients,'doctors'=>$doctors ,'storages'=>$storages]);
    }

    public function store(Request $request)
    {

        $patient = Patient::find($request->patient);
        $accounter_id = $patient->accounter()->first()->id;
        $doctor = Doctor::findOrFail($request->doctor);

        $patientDept = PatientDept::create([
            'dept_id' => $request->department,
            'patient_id' => $patient->id    ,
            'doctor_name' => $doctor->user->name,
            'illness' => $request->illness,
            'description' => $request->description,
            'cure' => $request->cure,
            
        ]);

        

        $apd = APD::create([
            'PD_id' => $patientDept->id,
            'A_id' => $accounter_id,
            'doctor_id' => $request->doctor,
            'patient_name' => $patient->name,
            'check_in_type' => $request->check_in_type,
            'given_cure' => $request->given_cure,
            'full_cost'=> 000,
            'status' => 'unpaid',
        ]);

        // Capture selected tools and their quantities
        $selectedTools = $request->input('selected_tools', []);
        $toolQuantities = $request->input('quantities', []);
        // Loop through selected tools
        for($i = 0; $i < count($selectedTools); $i++) 
        {
            $quantity = $toolQuantities[$i] ?? 1; // Default to 1 if not set
            $storage = Storage::find($selectedTools[$i]);        
            if ($storage && $storage->quantity >= $quantity) {
                $storage->decrement('quantity', $quantity);
                
                // Attach the tool to the APD or any relevant model
                $apd->storage()->attach($storage->id, ['quantity' => $quantity]);
            }
        }        
            
        
 
        Notification::create([
            'type' => 'patient_dept',
            'doctor_id' => $request->doctor,
            'patient_id' => $patient->id,
            'message' => "تمت إضافة معاينة جديدة للمريض {$patient->name} مع الدكتور {$doctor->user->name}",
            'operation_id' => $patientDept->id,
        ]);

        return redirect()->route('patientDept.index')->with('success', 'Patient has been assigned to department.');
    }
}
