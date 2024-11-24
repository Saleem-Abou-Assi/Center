<?php

namespace App\Http\Controllers;

use App\Models\APD;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientDept;
use Illuminate\Http\Request;

class PatientDeptController extends Controller
{
    public function index()
    {
        $depts = Department::all();
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('patientDept' , ['depts' => $depts,'patients'=>$patients,'doctors'=>$doctors]);
    }

    public function store(Request $request)
    {

        $patient = Patient::find($request->patient);
        $accounter_id = $patient->accounter()->first()->id;
        $doctor = Doctor::findOrFail($request->doctor);

        $patientDept = PatientDept::create([
            'dept_id' => $request->department,
            'patient_id' => $patient->id    ,
            'doctor_name' => $doctor->name,
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
            'tools'=> $request->tools,
            'full_cost'=> 000,
            'status' => 'unpaid',
        ]);

        

        return redirect()->route('patientDept.index')->with('success', 'Patient has been assigned to department.');
    }
}
