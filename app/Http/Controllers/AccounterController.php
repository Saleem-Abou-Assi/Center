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
    public function index($Dept_id)
    {
    $patientDept = PatientDept::with('Accounter')->find($Dept_id);
    
        $patient = Patient::findOrFail($patientDept->patient_id);
         $apd = APD::with('storage')->where('PD_id',$patientDept->id)->get();

        
        return view('accounter.index',['patientDept'=>$patientDept,'patient'=>$patient,'apd'=>$apd]);
    }
}
 