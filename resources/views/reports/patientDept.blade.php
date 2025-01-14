<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Patient Department Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            direction: rtl;
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
                <td>{{$patient->patient->name}}</td>
                <td>{{ $patient->department->title }}</td>
                <td>{{ $patient->doctor_name }}</td>
                <td>{{ $patient->illness }}</td>
                <td>{{ $patient->description }}</td>
                <td>{{ $patient->cure }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.onload = function() {
            window.print(); // Automatically open the print dialog when the page loads
        };
    </script>
</body>
</html>
