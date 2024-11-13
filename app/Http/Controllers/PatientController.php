<?php

namespace App\Http\Controllers;

use App\Models\Accounter;
use App\Models\APD;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        
        return view('patient.index',['patients'=>$patients]);
    }

    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request)
    {

        // تحقق من صحة الطلب
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'gender' => ['required',],
            'age' => ['required', 'integer'],
            
        ]);


        // إنشاء 
        $patient = Patient::create([
            'name' => $request->name,
             'phone'=> $request->phone,
             'address'=> $request->address,
             'Gender'=> $request->gender,
             'age'=> $request->age,
        ]);

        $account = Accounter::create([
            'patient_id' => $patient->id,   
        ]);



        return redirect()->route('patient.index'); // إعادة التوجيه بعد التخزين
    }
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patient.create', ['patient' => $patient]);
    }

    public function update(Request $request,$patient_id)
         {
            
            $patient = Patient::where('id',$patient_id)->first();
            
            $request->validate([
                'name' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'address' => ['required', 'string'],
                'gender' => ['required',],
                'age' => ['required', 'integer'],
                
            ]);
 
            $patient->update([
                'name' => $request->name,
                 'phone'=> $request->phone,
                 'address'=> $request->address,
                 'gender'=> $request->gender,
                 'age'=> $request->age,
            ]);
            
             
             return redirect()->route('patient.index'); 
            }

     public function destroy($patient_id)
     { 

        $patient = Patient::where('id',$patient_id)->first();

        $patient->delete();
      
        return redirect()->route('patient.index');
     
     }

    public function show($patient_id) {
        $patient = Patient::findOrFail($patient_id); // Fetch the product by ID
        $depts = $patient->Dept()->get();
        $account = Accounter::where('patient_id',$patient_id)->first();
        $apds = APD::where('A_id',$account->id)->get();
      
 
        return view('patient.show', ['patient'=>$patient,'depts'=>$depts,'apds'=>$apds]); // Pass the product to the view
    }
}
