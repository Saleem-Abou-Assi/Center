<?php

namespace App\Http\Controllers;

use App\Models\LazerPrice;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        return view('admin.dashboard', compact('userCount'));
    }

    public function runBatchFile()
    {
        // Define the path to your batch file
        $batchFilePath = base_path('backup.bat');

        // Execute the batch file
        $output = shell_exec("start /b $batchFilePath");

        // Optionally, return the output or a response
        // return response()->json(['message' => 'Batch file executed', 'output' => $output]);
        return redirect()->back();
    }

    public function lazerPrice(Request $request)
    {
        // 

            $lazer_price = LazerPrice::first();

            $lazer_price->update([
            'ax_price'=> $request->ax_price,
            'ay_price'=> $request->ay_price,
            
            'again_price'=> $request->again_price,
        ]);



        return redirect()->back();
    }
}
