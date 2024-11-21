<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;

use App\Models\Lazer;

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
        $request->validate([
            'rayscount' => ['required', 'integer'],
            'point' => ['required', 'string'],
            'power' => ['required', 'integer'],
            'speed' => ['required','integer'],
            'pulse' => ['required', 'string'],
            'device' => ['required','string']
            
        ]);


        // إنشاء 
        $lazer = Lazer::create([
            'patient_id'=>$request->patient_id,
            'doctor_id'=>$request->doctor_id,
            'rayscount' => $request->rayscount,
            'point'=> $request->point,
            'power'=> $request->power,
            'speed'=> $request->speed,
            'pulse'=> $request->pulse,
            'device'=>$request->device,

        ]);

    }
}
