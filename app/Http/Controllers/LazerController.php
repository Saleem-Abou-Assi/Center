<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;

use App\Models\Lazer;
use App\Models\Notification;

class LazerController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('lazer.index',['doctors'=>$doctors,'patients'=>$patients]);
    }

    public function store(Request $request)
    {

        // dd($request->point);
        $request->validate([
            'raysCount' => ['required', 'integer'],
            'point' => ['required', 'string'],
            'power' => ['required', 'integer'],
            'speed' => ['required', 'integer'],
            'pulse' => ['required', 'string'],
            'device' => ['required', 'string']
        ]);

        // إنشاء 
        $lazer = Lazer::create([
            'patient_id'=>$request->patient_id,
            'doctor_id'=>$request->doctor_id,
            'raysCount' => $request->raysCount,
            'point'=> $request->point,
            'power'=> $request->power,
            'speed'=> $request->speed,
            'pulse'=> $request->pulse,
            'device'=>$request->device,

        ]);

        $patient = Patient::findOrFail($request->patient_id);

        Notification::create([
            'type' => 'lazer',
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'message' => "تمت إضافة معاينة ليزر جديدة للمريض {$patient->name}",
            'operation_id' => $lazer->id
            
        ]);
        
        return redirect()->route('lazer.index')->with('success', 'Lazer created successfully.');

    }
}
