<?php

namespace App\Http\Controllers;

use App\Models\Accounter;
use App\Models\APD;
use App\Models\Field;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{

    public function index()
    {
        $patients = Patient::paginate(200);

        return view('patient.index', ['patients' => $patients]);
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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $profileImagePath = null;

        if ($request->hasFile('image')) {
            $profileImagePath = $request->file('image')->store('patient_images', 'public');
        }

        // إنشاء 
        $patient = Patient::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'Gender' => $request->gender,
            'age' => $request->age,
            'job' => $request->job,
            'relation' => $request->relation,
            'childerCount' => $request->children,
            'smooking' => $request->smooking,
            'oldSurgery' => $request->oldSurgery,
            'alirgy' => $request->alirgy,
            'disease' => $request->disease,
            'dite' => $request->dite,
            'permenantCure' => $request->permenantCure,
            'Cosmetic' => $request->cosmetic,
            'CurrentDiseas' => $request->currentDisease,
            'profileImagePath' => $profileImagePath
        ]);

        // Get the dynamic field names and values
        $dynamicFieldNames = $request->input('dynamicFieldName');
        $dynamicFieldValues = $request->input('dynamicFieldValue');

        // Process the dynamic fields (e.g., save to the database)
        if ($dynamicFieldNames) {
            foreach ($dynamicFieldNames as $key => $fieldName) {
                $fieldValue = $dynamicFieldValues[$key];
                $field = Field::firstOrCreate(['name' => $fieldName, 'value' => $fieldValue]);

                // Attach the field to the patient
                $patient->Field()->attach($field);
            }
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

    public function update(Request $request, $patient_id)
    {

        $patient = Patient::where('id', $patient_id)->first();

        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'gender' => ['required',],
            'age' => ['required', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $profileImagePath = null;

        if ($request->hasFile('image')) {
            // Store the image in the 'public/patient_images' directory
            $profileImagePath = $request->file('image')->store('patient_images', 'public');
        }

        $patient->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'Gender' => $request->gender,
            'age' => $request->age,
            'job' => $request->job,
            'relation' => $request->relation,
            'childerCount' => $request->children,
            'smooking' => $request->smooking,
            'oldSurgery' => $request->oldSurgery,
            'alirgy' => $request->aligry,
            'disease' => $request->disease,
            'dite' => $request->dite,
            'permenantCure' => $request->parmenantCure,
            'Cosmetic' => $request->cosmetic,
            'CurrentDiseas' => $request->currentDisease,
            'profileImagePath' => $profileImagePath
        ]);

        $dynamicFieldNames = $request->input('dynamicFieldName');
        $dynamicFieldValues = $request->input('dynamicFieldValue');


        if ($dynamicFieldNames) {
            foreach ($dynamicFieldNames as $key => $fieldName) {
                $fieldValue = $dynamicFieldValues[$key];

                // Update or create the field
                $field = Field::updateOrCreate(
                    ['name' => $fieldName], // Condition to check
                    ['value' => $fieldValue] // Values to update or create
                );
                $field->save();
                // Attach the field to the patient
                $patient->Field()->syncWithoutDetaching([$field->id]);
            }
        }

        return redirect()->route('patient.index');
    }

    public function destroy($patient_id)
    {
        try {
            $patient = Patient::where('id', $patient_id)->first();
            if ($patient->image_path) {
                Storage::delete('public/' . $patient->image_path);
            }
            if ($patient) {
                $patient->delete();
                session()->flash('success', 'Patient deleted successfully.');
            } else {
                session()->flash('error', 'Patient not found.');
            }

            return redirect()->route('patient.index');
        } catch (Exception $e) {
            session()->flash('error', 'you can\' delete patient because he has stored data.');
            return redirect()->route('patient.index');
        }
    }

    public function show($patient_id)
    {
        $patient = Patient::with('Dept', 'Field', 'Lazer.doctor', 'accounter')->find($patient_id);

        $account = Accounter::where('patient_id', $patient_id)->first();
        $apds = APD::where('A_id', $account->id)->get();
        return view('patient.show', ['patient' => $patient, 'apds' => $apds]);
    }
}
