<?php

namespace App\Http\Controllers;

use App\Models\PatientDept;
use App\Models\Lazer;
use Illuminate\Http\Request;
use App\Exports\DailyReportExport;
use App\Exports\CustomReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use App\Models\Patient;
use App\Models\Skin;
use App\Models\Doctor;

class ReportController extends Controller
{
    public function generateDailyReport(Request $request)
    {
        $reportDate = $request->input('report_date', today()->toDateString());
        $data = [
            'patientDept' => PatientDept::with(['Department', 'Accounter'])
                ->whereDate('created_at', $reportDate)
                ->get(),
            'lazer' => Lazer::with(['Patient', 'Doctor.user', 'Details.doctor'])
                ->whereDate('created_at', $reportDate)
                ->get()
            ,
            'skin' => Skin::with(['patient', 'doctor'])
                ->whereDate('created_at', $reportDate)
                ->get()
        ];

        // Calculate patient type statistics
        $data['patientStats'] = [
            'patientDept' => count($data['patientDept']),
            'lazer' => count($data['lazer']),
            'skin' => count($data['skin']),
            'total' => count($data['patientDept']) + count($data['lazer']) + count($data['skin'])
        ];

        if ($request->export_type === 'pdf') {
            $mpdf = new Mpdf([
                'default_font_size' => 9,
                'default_font' => 'Cairo'
            ]);
            $html = view('reports.daily', ['data' => $data, 'report_date' => $reportDate])->render();
            $mpdf->WriteHTML($html);
            return $mpdf->Output('daily-report.pdf', 'D'); // 'D' for download
        }

        return Excel::download(new DailyReportExport($data), 'daily-report.xlsx');
    }

    public function generateCustomReport(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:patientDept,lazer,skin,all',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'export_type' => 'required|in:pdf,excel'
        ]);

        $data = [];
        $groupedData = [];

        // Get data based on report type
        if ($request->report_type === 'all' || $request->report_type === 'patientDept') {
            $patientDeptData = PatientDept::with(['Department', 'Accounter'])
                ->whereBetween('created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ])
                ->get();

            // Group patient department data by date
            foreach ($patientDeptData as $record) {
                $date = $record->created_at->format('Y-m-d');
                $groupedData[$date]['patientDept'][] = $record;
            }
        }

        if ($request->report_type === 'all' || $request->report_type === 'lazer') {
            $lazerData = Lazer::with(['Patient', 'Doctor.user'])
                ->whereBetween('created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ])
                ->get();

            // Group lazer data by date
            foreach ($lazerData as $record) {
                $date = $record->created_at->format('Y-m-d');
                $groupedData[$date]['lazer'][] = $record;
            }
        }

        if ($request->report_type === 'all' || $request->report_type === 'skin') {
            $skinData = Skin::with(['patient', 'doctor'])
                ->whereBetween('created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ])
                ->get();

            // Group skin data by date
            foreach ($skinData as $record) {
                $date = $record->created_at->format('Y-m-d');
                $groupedData[$date]['skin'][] = $record;
            }
        }

        // Sort dates
        ksort($groupedData);

        // Calculate totals
        $totalPatients = 0;
        $totalRevenue = 0;

        foreach ($groupedData as $date => $dayData) {
            $patientCount = (isset($dayData['patientDept']) ? count($dayData['patientDept']) : 0) +
                (isset($dayData['lazer']) ? count($dayData['lazer']) : 0) +
                (isset($dayData['skin']) ? count($dayData['skin']) : 0);

            $dayRevenue = 0;
            if (isset($dayData['patientDept'])) {
                foreach ($dayData['patientDept'] as $record) {
                    $dayRevenue += $record->total_cost;
                }
            }
            if (isset($dayData['lazer'])) {
                foreach ($dayData['lazer'] as $record) {
                    $dayRevenue += $record->cost;
                }
            }
            if (isset($dayData['skin'])) {
                foreach ($dayData['skin'] as $record) {
                    $dayRevenue += $record->cost; // Assuming 'cost' is a field in the Skin model
                }
            }

            $groupedData[$date]['summary'] = [
                'total_patients' => $patientCount,
                'total_revenue' => $dayRevenue
            ];

            $totalPatients += $patientCount;
            $totalRevenue += $dayRevenue;
        }

        $data = [
            'grouped_data' => $groupedData,
            'summary' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'report_type' => $request->report_type,
                'total_patients' => $totalPatients,
                'total_revenue' => $totalRevenue
            ]
        ];

        if ($request->export_type === 'pdf') {
            $mpdf = new Mpdf();
            $html = view('reports.custom', ['data' => $data])->render();
            $mpdf->WriteHTML($html);
            return $mpdf->Output('custom-report.pdf', 'D'); // 'D' for download
        }

        return Excel::download(new CustomReportExport($data), 'custom-report.xlsx');
    }

    public function generatePatientReport(Request $request, $patientId)
    {
        $patientDeptData = PatientDept::with(['Department', 'Accounter'])
            ->where('patient_id', $patientId)
            ->get();

        $lazerData = Lazer::with(['Patient', 'Doctor.user'])
            ->where('patient_id', $patientId)
            ->get();

        $skinData = Skin::with(['patient', 'doctor'])
            ->where('patient_id', $patientId)
            ->get();

        // Check if there are no records in all tables
        if ($patientDeptData->isEmpty() && $lazerData->isEmpty() && $skinData->isEmpty()) {
            return redirect()->back()->with('error', 'لا توجد بيانات لتصدير التقرير.');
        }

        $data = [
            'patientDept' => $patientDeptData,
            'lazer' => $lazerData,
            'skin' => $skinData  // Changed from skinCheckups to skin to match the view
        ];

        $mpdf = new Mpdf();
        $html = view('reports.patient', ['data' => $data])->render();

        // Get the patient's name for the filename
        $patient = Patient::findOrFail($patientId);
        $filename = "{$patient->name}-report.pdf";

        $mpdf->WriteHTML($html);
        return $mpdf->Output($filename, 'D');
    }

    public function printPatientReport($patientId)
    {
        $patientDeptData = PatientDept::with(['Department', 'Accounter', 'patient'])
            ->where('patient_id', $patientId)
            ->get();

        $lazerData = Lazer::with(['Patient'])
            ->where('patient_id', $patientId)
            ->get();
        $skinData = Skin::with(['patient', 'doctor'])
            ->where('patient_id', $patientId)
            ->get();

        $data = [
            'patientDept' => $patientDeptData,
            'lazer' => $lazerData,
            'skin' => $skinData
        ];

        return view('reports.patient', ['data' => $data]); // Use the same view for printing
    }
    public function printPatientDeptReport($patientId)
    {
        $patientDeptData = PatientDept::with(['Department', 'Accounter'])
            ->where('patient_id', $patientId)
            ->get();

        $data = [
            'patientDept' => $patientDeptData,
        ];

        return view('reports.patientDept', ['data' => $data]); // Create a view for printing patient department report
    }

    public function printLazerReport($patientId)
    {
        $lazerData = Lazer::with(['Patient', 'Doctor.user'])
            ->where('patient_id', $patientId)
            ->get();

        $data = [
            'lazer' => $lazerData,
        ];

        return view('reports.lazer', ['data' => $data]); // Create a view for printing lazer report
    }

    public function generateDoctorReport(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'export_type' => 'required|in:pdf,excel'
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);

        // Fetch patient department visits
        $patientDeptData = PatientDept::with(['patient', 'department', 'apd'])
            ->where('doctor_name', $doctor->user->name)
            ->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ])
            ->get();

        // Fetch laser sessions
        $lazerData = Lazer::with(['patient', 'Details'])
            ->whereHas('Details', function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id);
            })
            ->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ])
            ->get();

        // Fetch skin treatments
        $skinData = Skin::with(['patient'])
            ->where('doctor_id', $doctor->id)
            ->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ])
            ->get();

        $data = [
            'doctor' => $doctor,
            'summary' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_patients' => $patientDeptData->count() + $lazerData->count() + $skinData->count(),
                'total_revenue' => $patientDeptData->sum('full_cost') +
                    $lazerData->sum('real_price') +
                    $skinData->sum('cost')
            ],
            'patientDept' => $patientDeptData,
            'lazer' => $lazerData,
            'skin' => $skinData
        ];

        if ($request->export_type === 'pdf') {
            $mpdf = new Mpdf();
            $html = view('reports.doctor', ['data' => $data])->render();
            $mpdf->WriteHTML($html);
            return $mpdf->Output('doctor-report.pdf', 'D');
        }

        // Add Excel export logic if needed
    }
}
