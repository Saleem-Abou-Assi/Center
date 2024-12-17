<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Custom Report</title>
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
        .date-section {
            margin-bottom: 40px;
            page-break-inside: avoid;
        }
        .date-header {
            background-color: #f5f5f5;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Custom Report</h1>
        <p>Period: {{ $data['summary']['start_date'] }} to {{ $data['summary']['end_date'] }}</p>
    </div>

    @foreach($data['grouped_data'] as $date => $dayData)
    <div class="date-section">
        <div class="date-header">
            <h2>{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}</h2>
        </div>

        @if(isset($dayData['patientDept']) && count($dayData['patientDept']) > 0)
        <div class="section">
            <div class="section-title">Patient Department</div>
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Department</th>
                        <th>Doctor</th>
                        <th>Illness</th>
                        <th>Description</th>
                        <th>Cure</th>
                        <th>Check-in Type</th>
                        <th>Given Cure</th>
                        <th>Tools</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dayData['patientDept'] as $item)
                    <tr>
                        <td>{{ $item->patient_name }}</td>
                        <td>{{ $item->department->title }}</td>
                        <td>{{ $item->doctor_name }}</td>
                        <td>{{ $item->illness }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->cure }}</td>
                        <td>{{ $item->check_in_type ?? 'N/A' }}</td>
                        <td>{{ $item->given_cure ?? 'N/A' }}</td>
                        <td>{{ $item->tools ?? 'N/A' }}</td>
                        <td>{{ $item->created_at->format('H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if(isset($dayData['lazer']) && count($dayData['lazer']) > 0)
        <div class="section">
            <div class="section-title">Lazer Sessions</div>
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Device</th>
                        <th>Point</th>
                        <th>Rays Count</th>
                        <th>Power</th>
                        <th>Speed</th>
                        <th>Pulse</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dayData['lazer'] as $item)
                    <tr>
                        <td>{{ $item->patient->name }}</td>
                        <td>{{ $item->doctor->user->name }}</td>
                        <td>{{ $item->device }}</td>
                        <td>{{ $item->point }}</td>
                        <td>{{ $item->raysCount }}</td>
                        <td>{{ $item->power }}</td>
                        <td>{{ $item->speed }}</td>
                        <td>{{ $item->pulse }}</td>
                        <td>{{ $item->created_at->format('H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="daily-summary">
            <p>Daily Total Patients: {{ $dayData['summary']['total_patients'] }}</p>
        </div>
    </div>
    @endforeach

    <div class="summary">
        <h3>Overall Summary</h3>
        <p>Total Patients: {{ $data['summary']['total_patients'] }}</p>
    </div>
</body>
</html>