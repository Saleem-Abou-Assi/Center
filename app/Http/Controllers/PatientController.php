<?php

namespace App\Http\Controllers;

use App\Models\Accounter;
use App\Models\APD;
use App\Models\Field;
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
            'job'=>$request->job,
            'relation'=>$request->relation,
            'childerCount'=>$request->children,
            'smooking'=>$request->smooking,
            'oldSurgery'=>$request->oldSurgery,
            'alirgy'=>$request->aligry,
            'disease'=>$request->disease,
            'dite'=>$request->dite,
            'permenantCure'=>$request->parmenantCure,
            'Cosmetic'=>$request->cosmetic,
            'CurrentDiseas'=>$request->currentDisease
        ]);

         // Get the dynamic field names and values
    $dynamicFieldNames = $request->input('dynamicFieldName');
    $dynamicFieldValues = $request->input('dynamicFieldValue');

    // Process the dynamic fields (e.g., save to the database)
    foreach ($dynamicFieldNames as $key => $fieldName) {
        $fieldValue = $dynamicFieldValues[$key];
        $field = Field::firstOrCreate(['name' => $fieldName, 'value' => $fieldValue]);

        // Attach the field to the patient
        $patient->Field()->attach($field);
    }

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
                'Gender'=> $request->gender,
                'age'=> $request->age,
                'job'=>$request->job,
                'relation'=>$request->realtion,
                'childerCount'=>$request->children,
                'smooking'=>$request->smooking,
                'oldSurgery'=>$request->oldSurgery,
                'alirgy'=>$request->aligry,
                'disease'=>$request->disease,
                'dite'=>$request->dite,
                'permenantCure'=>$request->parmenantCure,
                'Cosmetic'=>$request->cosmetic,
                'CurrentDiseas'=>$request->currentDisease
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
        // $patient1 = Patient::findOrFail($patient_id); // Fetch the product by ID
        // $depts = $patient->Dept()->get();
        $patient = Patient::with('Dept','Field')->where('id', $patient_id)->first();
        
        $account = Accounter::where('patient_id',$patient_id)->first();
        $apds = APD::where('A_id',$account->id)->get();

        return view('patient.show', ['patient'=>$patient,'apds'=>$apds]); // Pass the product to the view
    }
}
