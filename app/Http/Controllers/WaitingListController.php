<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaitingListController extends Controller
{
    public function index(Request $request)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $selectedDoctor = null;
        if ($request->has('doctor_id')) {
            $selectedDoctor = Doctor::find($request->doctor_id);
        }

        return view('waitingList.index', ['doctors' => $doctors, 'patients' => $patients, 'selectedDoctor' => $selectedDoctor]);
    }


    public function store(Request $request)
    {
       
        $doctor = Doctor::find($request->doctor_id);
        $patient = Patient::find($request->patient_id);

        $doctor->waitinglist()->attach($patient->id, [
            'expires_at' => now()->addDays(1),
        ]);

        return redirect()->back()->with('success', 'Patient added to the waiting list.');
    }

    public function destroy($entryId)
{
    $entry = WaitingList::find($entryId);
    $entry->delete();

    return redirect()->back()->with('success', 'Patient removed from the waitlist.');
}

}
