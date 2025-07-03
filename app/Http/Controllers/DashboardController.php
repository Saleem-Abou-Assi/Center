<?php

namespace App\Http\Controllers;

use App\Models\LazerPrice;
use App\Models\User;
use App\Models\Doctor;
use App\Models\LDetails;
use App\Models\DailyRayCount;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $doctors = Doctor::with('user')->get();
        
        // Get today's ray counts
        $todayCounts = DailyRayCount::where('date', today())->first();
        
        return view('admin.dashboard', compact('userCount', 'doctors', 'todayCounts'));
    }

    public function storeStartCounts(Request $request)
    {
        $request->validate([
            'ax_start_count' => 'required|integer|min:0',
            'ay_start_count' => 'required|integer|min:0',
            'again_start_count' => 'required|integer|min:0',
        ]);

        DailyRayCount::updateOrCreate(
            ['date' => today()],
            [
                'ax_start_count' => $request->ax_start_count,
                'ay_start_count' => $request->ay_start_count,
                'again_start_count' => $request->again_start_count,
                'ax_end_count' => 0,
                'ay_end_count' => 0,
                'again_end_count' => 0,
            ]
        );

        return redirect()->back()->with('success', 'تم حفظ عدد الأشعة في بداية اليوم بنجاح');
    }

    public function storeEndCounts(Request $request)
    {
        $request->validate([
            'ax_end_count' => 'required|integer|min:0',
            'ay_end_count' => 'required|integer|min:0',
            'again_end_count' => 'required|integer|min:0',
            'notes' => 'nullable|string'
        ]);

        DailyRayCount::updateOrCreate(
            ['date' => today()],
            [
                'ax_end_count' => $request->ax_end_count,
                'ay_end_count' => $request->ay_end_count,
                'again_end_count' => $request->again_end_count,
                'notes' => $request->notes
            ]
        );

        return redirect()->back()->with('success', 'تم حفظ عدد الأشعة في نهاية اليوم بنجاح');
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
