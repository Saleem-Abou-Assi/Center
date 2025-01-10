<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class WaitingListController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('waitingList.index',['doctors'=>$doctors,'patients'=>$patients]);
    }

}
