<?php

namespace App\Http\Controllers;

use App\Models\Accounter;
use App\Models\APD;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientDept;
use Illuminate\Http\Request;

class AccounterController extends Controller
{
    public function index($apd_id)
    {
        // $patient = Patient::findOrFail($patient_id);
        
        $apd = APD::where('id',$apd_id)->first();
        $PD = PatientDept::where('id',$apd->PD_id)->first();
        $patient = Patient::where('id',$PD->patient_id)->first();
        $doctor = Doctor::where('id',$apd->doctor_id)->first();
        $dept = Department::where('id',$PD->dept_id)->first();

        return view('accounter.index',['apd'=>$apd,'patient'=>$patient,'PD'=>$dept ,'doctor'=>$doctor]);

    }
}
