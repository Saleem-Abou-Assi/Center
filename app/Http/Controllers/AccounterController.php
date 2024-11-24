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
        $account = Accounter::with('PatientDept.Department')->find($Dept_id);
         $patient = Patient::findOrFail($account->patient_id);

        return view('accounter.index',['account'=>$account,'patient'=>$patient]);
    }
}
 