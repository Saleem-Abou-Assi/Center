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

        //  dd($request);
     
        $request->validate([
            'patient_id' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],

        ]);

        $ray_price = LazerPrice::first();
        $real_price = $request->real_price ?? 0;

        $lazer = Lazer::create([
            'patient_id' => $request->patient_id,
     
            'real_price' => $real_price,
            'lazer_price' => $ray_price->ax_price,
            'notes' => $request->notes,
            'price' => 0,
        ]);

        // Handle dynamic details
        if ($request->has('dynamicPoint')) {
            foreach ($request->dynamicPoint as $index => $point) {
                $lazer->Details()->create([
                    'point' => $point,
                    'power' => $request->dynamicPower[$index],
                    'speed' => $request->dynamicSpeed[$index],
                    'pulse' => $request->dynamicPulse[$index],
                    'device' => $request->dynamicDevice[$index],
                    'raysCount' => $request->dynamicCount[$index],
                    'doctor_id' => $request->dynamicDoc[$index],

                ]);
            }
        }

        $patient = Patient::findOrFail($request->patient_id);

        Notification::create([
            'type' => 'lazer',
           
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
            'notes' => ['nullable', 'string'],

        ]);

        $ray_price = LazerPrice::first();
        $lazer = Lazer::find($lazer_id);

        $lazer->update([
            'patient_id' => $request->patient_id,

            'real_price' => $request->real_price,
            'lazer_price' => $ray_price->ax_price,
            'notes' => $request->notes,
            'price' => $request->price,
        ]);

        // Update dynamic details
        $lazer->Details()->delete(); // Remove existing details
        if ($request->has('dynamicPoint')) {
            foreach ($request->dynamicPoint as $index => $point) {
                $lazer->Details()->create([
                    'point' => $point,
                    'power' => $request->dynamicPower[$index],
                    'speed' => $request->dynamicSpeed[$index],
                    'pulse' => $request->dynamicPulse[$index],
                    'device' => $request->dynamicDevice[$index],
                    'raysCount' => $request->dynamicCount[$index],
                    'doctor_id' => $request->dynamicDoc[$index],
                ]);
            }
        }

        $patient = Patient::findOrFail($request->patient_id);

        return redirect()->back()->with('success', 'Lazer updated successfully.');
    }

    public function show($lazer_id)
    {
        $lazer = Lazer::where('id',$lazer_id)->with('Doctor','Patient','Details')->first();
        $ray_price = LazerPrice::first();

// dd($lazer);
        return view('lazer.show',['ray_price'=>$ray_price,'lazer'=>$lazer]);

    }

}
