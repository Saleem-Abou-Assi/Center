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

        th,
        td {
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
        <h1>تقرير المريض</h1>
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
        </div>
    @endif

    @if(count($data['lazer']) > 0)
        <div class="section">
            <h2>جلسات الليزر</h2>
            <table>
                <thead>
                    <tr>
                
                        <th>التكلفة الفعلية</th>
                        <th>التكلفة الأساسية</th>
                        <th>الملاحظات</th>

                        <th>التاريخ</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data['lazer'] as $session)
                        <tr>
                            <td>{{ $session->price }}</td>
                            <td>{{ $session->real_price }}</td>
                            <td>{{ $session->notes }}</td>

                            <td>{{ $session->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif


    @if(count($data['skin']) > 0)
        <div class="section">
            <h2>معاينات البشرة</h2>
            <table>
                <thead>
                    <tr>
                        <th>الطبيب</th>
                        <th>العلاج</th>

                        <th>التكلفة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['skin'] as $checkup)
                        <tr>

                            <td>{{ $checkup->doctor->user->name }}</td>
                            <td>{{ $checkup->options }}</td>
                            <td>{{ $checkup->cost }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



</body>

</html>