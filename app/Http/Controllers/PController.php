<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PController extends Controller
{
    public function getAllPatients()  
    {  
        $patients = Patient::all();  
        
        return response()->json($patients);  
    }
    
}
