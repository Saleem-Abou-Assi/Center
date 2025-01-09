<?php

namespace App\Http\Controllers;

use App\Models\PatientDept;
use App\Models\Lazer;
use Illuminate\Http\Request;
use App\Exports\DailyReportExport;
use App\Exports\CustomReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class ReportController extends Controller
{
    public function generateDailyReport(Request $request)
    {
        $data = [
            'patientDept' => PatientDept::with(['Department', 'Accounter'])
                ->whereDate('created_at', today())
                ->get(),
            'lazer' => Lazer::with(['Patient', 'Doctor.user'])
                ->whereDate('created_at', today())
                ->get()
        ];

        if ($request->export_type === 'pdf') {
            $mpdf = new Mpdf();
            $html = view('reports.daily', ['data' => $data])->render();
            $mpdf->WriteHTML($html);
            return $mpdf->Output('daily-report.pdf', 'D'); // 'D' for download
        }

        return Excel::download(new DailyReportExport($data), 'daily-report.xlsx');
    }

    public function generateCustomReport(Request $request)
    {
        $request->validate([
            'report_type' => 'required|in:patientDept,lazer,all',
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

        // Sort dates
        ksort($groupedData);

        // Calculate totals
        $totalPatients = 0;
        $totalRevenue = 0;

        foreach ($groupedData as $date => $dayData) {
            $patientCount = (isset($dayData['patientDept']) ? count($dayData['patientDept']) : 0) +
                           (isset($dayData['lazer']) ? count($dayData['lazer']) : 0);
            
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

        $data = [
            'patientDept' => $patientDeptData,
            'lazer' => $lazerData,
        ];

        $mpdf = new Mpdf();
        $html = view('reports.patient', ['data' => $data])->render();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('patient-report.pdf', 'D'); // 'D' for download
    }
}