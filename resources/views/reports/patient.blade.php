<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Patient Report</title>
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
    </style>
</head>
<body>
    <div class="header">
       
        @php
        $patient_id = $data['patientDept']->first()->patient_id;
        $patient = App\Models\Patient::find($patient_id);
        

        @endphp
         <h1>تقرير المريض: {{ $patient->name }}</h1>

    </div>

    @if(count($data['patientDept']) > 0)
    <div class="section">
        <h2>معاينات المريض</h2>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>القسم</th>
                    <th>الطبيب</th>
                    <th>المرض</th>
                    <th>الوصف</th>
                    <th>العلاج</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['patientDept'] as $patient)
                <tr>
                   
                    <td>{{ $patient->department->title }}</td>
                    <td>{{ $patient->doctor_name }}</td>
                    <td>{{ $patient->illness }}</td>
                    <td>{{ $patient->description }}</td>
                    <td>{{ $patient->cure }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if(count($data['lazer']) > 0)
    <div class="section">
        <h2>جلسات الليزر</h2>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>الطبيب</th>
                    <th>الجهاز</th>
                    <th>النقطة</th>
                    <th>عدد الأشعة</th>
                    <th>القوة</th>
                    <th>السرعة</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <script>
        window.onload = function() {
            window.print(); // Automatically open the print dialog when the page loads
        };
    </script>   
</body>
</html>