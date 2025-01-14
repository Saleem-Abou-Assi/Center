<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;

use App\Models\Lazer;
use App\Models\LazerPrice;
use App\Models\Notification;

class LazerController extends Controller
{
    

    public function index()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $ray_price = LazerPrice::first();
        return view('lazer.index',['doctors'=>$doctors,'patients'=>$patients,'ray_price'=>$ray_price]);
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

        $ray_price = LazerPrice::first();
        $real_price = 0;

        if($request->real_price)
        {
            $real_price = $request->real_price;
        }
        

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
            'real_price'=>$request->real_price,
            'lazer_price'=> $ray_price->price,
            'notes'=>$request->notes,
            'price'=> $request->price,

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

    public function edit($lazer_id)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $ray_price = LazerPrice::first();
        $lazer = Lazer::where('id',$lazer_id)->with('Doctor','Patient')->first();
        
        return view('lazer.index',['doctors'=>$doctors,'patients'=>$patients,'ray_price'=>$ray_price,'lazer'=>$lazer]);
    }
    public function update(Request $request, $lazer_id)
    {
        $request->validate([
            'patient_id' => ['required', 'integer'],
            'doctor_id' => ['required', 'integer'],
            'raysCount' => ['required', 'integer'],
            'point' => ['required', 'string'],
            'power' => ['required', 'integer'],
            'speed' => ['required', 'integer'],
            'pulse' => ['required', 'string'],
            'device' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $ray_price = LazerPrice::first();
        $lazer = Lazer::find($lazer_id);

        $lazer->update([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'raysCount' => $request->raysCount,
            'point' => $request->point,
            'power' => $request->power,
            'speed' => $request->speed,
            'pulse' => $request->pulse,
            'device' => $request->device,
            'real_price' => $request->real_price,
            'lazer_price' => $ray_price->price,
            'notes' => $request->notes,
            'price'=> $request->price,
        ]);

        $patient = Patient::findOrFail($request->patient_id);

        return redirect()->back()->with('success', 'Lazer updated successfully.');
    }

    public function show($lazer_id)
    {
        $lazer = Lazer::where('id',$lazer_id)->with('Doctor','Patient')->first();
        $ray_price = LazerPrice::first();


        return view('lazer.show',['ray_price'=>$ray_price,'lazer'=>$lazer]);

    }

}
