<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Skin;
use Illuminate\Http\Request;

class SkinController extends Controller
{
     public function index()
    {
      
        $patients = Patient::all();
        $doctors = Doctor::all();
        

        return view('skin.index' , ['patients'=>$patients,'doctors'=>$doctors ]);
    }

    public function store(Request $request)
    {

        $patient = Patient::find($request->patient);
     
       
        $skin = Skin::create([
            'patient_id' => $patient->id    ,
            'doctor_id' => $request->doctor,
            'options'=>$request->options,
            'cost'=>$request->cost,

            
        ]);
  
        Notification::create([
            'type' => 'skin',
            'doctor_id' => $request->doctor,
            'patient_id' => $patient->id,
            'message' => "تمت إضافة معاينة جديدة للمريض {$patient->name} ",
            'operation_id' => $skin->id,
        ]);

        return redirect()->route('skin.index')->with('success', 'Patient has been assigned to department.');
    }


    public function destroy($skin_id)
    { 
       
       $dept = Skin::where('id',$skin_id)->first();

        $dept->delete();
      
        return redirect()->back();

    }

}
