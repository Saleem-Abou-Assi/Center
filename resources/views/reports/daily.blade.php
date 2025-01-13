<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            direction: rtl;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }
        th {
            background-color: #f5f5f5;
        }
        .date {
            text-align: left;
            margin-bottom: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>تقارير يومية</h1>
        <div class="date">Date: {{ now()->format('Y-m-d') }}</div>
    </div>

    @if(count($data['patientDept']) > 0)
    <div class="section">
        <div class="section-title">Patients visits</div>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Department</th>
                    <th>Doctor</th>
                    <th>Illness</th>
                    <th>Description</th>
                    <th>Cure</th>
                    <th>Check In Type</th>
                    <th>Given Cure</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>

                @foreach($data['patientDept'] as $patient)
                @php
                    $p = App\Models\Patient::findOrFail($patient->patient_id);
                    $apd_id=$patient->accounter->first()->pivot->id;
                    $apd = App\Models\APD::findOrFail($apd_id);
                @endphp
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $patient->department->title }}</td>
                    <td>{{ $patient->doctor_name }}</td>
                    <td>{{ $patient->illness }}</td>
                    <td>{{ $patient->description }}</td>
                    <td>{{ $patient->cure }}</td>
                    <td>{{ $patient->accounter->first()->pivot->check_in_type ?? 'N/A' }}</td>
                    <td>{{ $patient->accounter->first()->pivot->given_cure ?? 'N/A' }}</td>
                    <td>{{ $apd->storage->first()->item  }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if(count(value: $data['lazer']) > 0)
    <div class="section">
        <div class="section-title">Lazer</div>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Device</th>
                    <th>Point</th>
                    <th>Rays number</th>
                    <th>Power</th>
                    <th>Speed</th>
                    <th>Pulse</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['lazer'] as $session)
                <tr>
                    <td>{{ $session->patient->name }}</td>
                    <td>{{ $session->doctor->user->name }}</td>
                    <td>{{ $session->device }}</td>
                    <td>{{ $session->point }}</td>
                    <td>{{ $session->raysCount }}</td>
                    <td>{{ $session->power }}</td>
                    <td>{{ $session->speed }}</td>
                    <td>{{ $session->pulse }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Summary</div>
        <table>
            <tr>
                <th>Total Patients</th>
                <td>{{ count($data['patientDept']) + count($data['lazer']) }}</td>
            </tr>
           
        </table>
    </div>
</body>
</html>