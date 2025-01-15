<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lazer Report</title>
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
    <script>
        window.onload = function() {
            window.print(); // Automatically open the print dialog when the page loads
        };
    </script>
</body>
</html>