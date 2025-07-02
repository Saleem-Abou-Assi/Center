<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>تقرير الطبيب</title>
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
    <h1>تقرير الطبيب: {{ $data['doctor']->user->name }}</h1>
    <p>الفترة: {{ $data['summary']['start_date'] }} إلى {{ $data['summary']['end_date'] }}</p>
    <p>إجمالي المرضى: {{ $data['summary']['total_patients'] }}</p>


    @if(count($data['patientDept']) > 0)
        <h2>معاينات المرضى</h2>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>القسم</th>
                    <th>المرض</th>
                    <th>العلاج</th>
                    <th>التكلفة</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['patientDept'] as $visit)
                    <tr>
                        <td>{{ $visit->patient->name }}</td>
                        <td>{{ $visit->department->title }}</td>
                        <td>{{ $visit->illness }}</td>
                        <td>{{ $visit->cure }}</td>
                        <td>{{ $visit->apd ? $visit->apd->full_cost : '-' }}</td>
                        <td>{{ $visit->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(count($data['lazer']) > 0)
        <h2>جلسات الليزر</h2>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>الجهاز</th>
                    <th>النقطة</th>
                    <th>القوة</th>
                    <th>السرعة</th>
                    <th>السعر الافتراضي</th>
                    <th>السعر الحقيقي</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['lazer'] as $session)
                    @foreach($session->Details as $detail)
                        <tr>
                            <td>{{ $session->patient->name }}</td>
                            <td>{{ $detail->device }}</td>
                            <td>{{ $detail->point }}</td>
                            <td>{{ $detail->power }}</td>
                            <td>{{ $detail->speed }}</td>
                            <td>{{ $session->real_price }}</td>
                            <td>{{ $session->price }}</td>
                            <td>{{ $session->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    @if(count($data['skin']) > 0)
        <h2>معاينات البشرة</h2>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>الخيارات</th>
                    <th>التكلفة</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['skin'] as $treatment)
                    <tr>
                        <td>{{ $treatment->patient->name }}</td>
                        <td>{{ $treatment->options }}</td>
                        <td>{{ $treatment->cost }}</td>
                        <td>{{ $treatment->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>