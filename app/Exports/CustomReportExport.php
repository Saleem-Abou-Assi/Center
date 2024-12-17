<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomReportExport implements WithMultipleSheets
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        $sheets = [];
        
        // Create Patient Department and Lazer sheets for each date
        foreach ($this->data['grouped_data'] as $date => $dayData) {
            if (isset($dayData['patientDept']) && count($dayData['patientDept']) > 0) {
                $sheets[$date . ' - Patient Department'] = new PatientDeptSheet($dayData['patientDept']);
            }
            if (isset($dayData['lazer']) && count($dayData['lazer']) > 0) {
                $sheets[$date . ' - Lazer Sessions'] = new LazerSheet($dayData['lazer']);
            }
        }
        
        return $sheets;
    }
}

class PatientDeptSheet implements FromCollection, WithTitle, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data)->map(function ($item) {
            return [
                'patient_name' => mb_convert_encoding($item->patient_name, 'UTF-8', 'auto'),
                'department' => mb_convert_encoding($item->department->title, 'UTF-8', 'auto'),
                'doctor_name' => mb_convert_encoding($item->doctor_name, 'UTF-8', 'auto'),
                'illness' => mb_convert_encoding($item->illness, 'UTF-8', 'auto'),
                'description' => mb_convert_encoding($item->description, 'UTF-8', 'auto'),
                'cure' => mb_convert_encoding($item->cure, 'UTF-8', 'auto'),
                'check_in_type' => mb_convert_encoding($item->check_in_type ?? 'N/A', 'UTF-8', 'auto'),
                'given_cure' => mb_convert_encoding($item->given_cure ?? 'N/A', 'UTF-8', 'auto'),
                'tools' => mb_convert_encoding($item->tools ?? 'N/A', 'UTF-8', 'auto'),
                'date' => $item->created_at->format('Y-m-d H:i')
            ];
        });
    }

    public function title(): string
    {
        return 'Patient Department';
    }

    public function headings(): array
    {
        return array_map(function($heading) {
            return mb_convert_encoding($heading, 'UTF-8', 'auto');
        }, [
            'Patient Name',
            'Department',
            'Doctor',
            'Illness',
            'Description',
            'Cure',
            'Check-in Type',
            'Given Cure',
            'Tools',
            'Date'
        ]);
    }
}

class LazerSheet implements FromCollection, WithTitle, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data)->map(function ($item) {
            return [
                'patient_name' => $item->patient->name,
                'doctor_name' => $item->doctor->user->name,
                'device' => $item->device,
                'point' => $item->point,
                'rays_count' => $item->raysCount,
                'power' => $item->power,
                'speed' => $item->speed,
                'pulse' => $item->pulse,
                'date' => $item->created_at->format('Y-m-d H:i')
            ];
        });
    }

    public function title(): string
    {
        return 'Lazer Sessions';
    }

    public function headings(): array
    {
        return [
            'Patient Name',
            'Doctor',
            'Device',
            'Point',
            'Rays Count',
            'Power',
            'Speed',
            'Pulse',
            'Date'
        ];
    }
}