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

        .lazer-details-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .lazer-details-list li {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 5px;
            font-size: 0.9em;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
            margin-left: 5px;
        }

        .detail-value {
            color: #333;
        }

        .lazer-session-details {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 10px;
        }

        .lazer-notes {
            margin-top: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            font-size: 0.9em;
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
                        <th>الرقم</th>
                        <th>التاريخ</th>
                        <th>الطبيب</th>
                        <th>التكلفة</th>
                        <th>تفاصيل الجلسة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['lazer'] as $index => $session)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $session->created_at->format('Y-m-d') }}</td>
                            <td>{{ $session->Doctor->user->name ?? 'غير محدد' }}</td>
                            <td>
                                <div>أساسي: {{ $session->price }} </div>
                                <div>فعلي: {{ $session->real_price }} </div>
                            </td>
                            <td>
                                <div class="lazer-session-details">
                                    <ul class="lazer-details-list">
                                        @foreach($session->Details as $detail)
                                        <li>
                                            <span class="detail-label">المعالج:</span> 
                                            <span class="detail-value">{{ $detail->doctor->user->name }}</span>
                                            <span class="detail-label">الجهاز:</span> 
                                            <span class="detail-value">{{ $detail->device }}</span>
                                            <span class="detail-label">النقطة:</span> 
                                            <span class="detail-value">{{ $detail->point }}</span>
                                            <span class="detail-label">الأشعة:</span> 
                                            <span class="detail-value">{{ $detail->raysCount }}</span>
                                            <span class="detail-label">القوة:</span> 
                                            <span class="detail-value">{{ $detail->power }}</span>
                                            <span class="detail-label">السرعة:</span> 
                                            <span class="detail-value">{{ $detail->speed }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @if($session->notes)
                                    <div class="lazer-notes">
                                        <strong>ملاحظات:</strong> 
                                        <p>{{ $session->notes }}</p>
                                    </div>
                                    @endif
                                </div>
                            </td>
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