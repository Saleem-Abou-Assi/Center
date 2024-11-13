<?php

namespace App\Http\Controllers;

use App\Models\Accounter;
use App\Models\APD;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
   
    public function index()
    {
        $doctors = Doctor::all();
        
        return view('doctor.index',['doctors'=>$doctors]);
    }

    public function create()
    {
        $depts = Department::all();

        return view('doctor.create',['depts'=>$depts]);
    }

    public function store(Request $request)
    {

        // تحقق من صحة الطلب
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'specialization' => ['required',],
            
        ]);

        // إنشاء 
        $doctor = Doctor::create([
            'name' => $request->name,
             'phone'=> $request->phone,
             'address'=> $request->address,
             'specialization'=> $request->specialization,
             'dept_id'=> $request->department,
        ]);

        return redirect()->route('doctor.index'); // إعادة التوجيه بعد التخزين
    }
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('doctor.create', ['doctor' => $doctor]);
    }

    public function update(Request $request,$doctor_id)
         {
            
            $doctor = Doctor::where('id',$doctor_id)->first();
            
            $request->validate([
                'name' => ['required', 'string'],
                'phone' => ['required', 'string'],
                'address' => ['required', 'string'],
                'specialization' => ['required',],

            ]);
 
            $doctor->update([
                'name' => $request->name,
                 'phone'=> $request->phone,
                 'address'=> $request->address,
                 'specialization'=> $request->specialization,
                 'department'=> $request->dept_id,
            ]);
            
             
             return redirect()->route('doctor.index'); 
            }

     public function destroy($doctor_id)
     { 
        
        $doctor = Doctor::where('id',$doctor_id)->first();

         $doctor->delete();
       
         return redirect()->route('doctor.index');

     }

    public function show($doctor_id) {
        $doctor = Doctor::findOrFail($doctor_id); // Fetch the product by ID
        $dept = Department::findOrFail($doctor->dept_id);
        // $depts = $doctor->Dept()->get();
        $apds = APD::where('doctor_id',$doctor_id)->get();

        

        return view('doctor.show', ['doctor'=>$doctor,'dept','apds'=>$apds]); // Pass the product to the view
    }

}
