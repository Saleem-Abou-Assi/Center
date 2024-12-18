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

        if($request->has('selected_tools')) {
            dd($request->selected_tools);
            $selectedTools = $request->input('selected_tools');
            foreach($selectedTools as $toolId) {
                $quantity = $request->input("tool_quantity.$toolId", 1);
                $storage = Storage::find($toolId);
                
                if($storage && $storage->quantity >= $quantity) {
                    $storage->decrement('quantity', $quantity);
                    
                    $apd->storage()->attach($storage->id, ['quantity' => $quantity]);
                }
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
