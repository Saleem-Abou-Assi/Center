<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>تقرير يومي</title>
    <style>
        body {
            font-family: "Cairo", sans-serif;
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

        th,
        td {
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
        <h1>تقرير يومي</h1>
        <div class="date">التاريخ: {{ now()->format('Y-m-d') }}</div>
    </div>

    @if(isset($data['patientDept']) && count($data['patientDept']) > 0)
    <div class="section">
        <div class="section-title">قسم المرضى</div>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>القسم</th>
                    <th>الطبيب</th>
                    <th>المرض</th>
                    <th>الوصف</th>
                    <th>العلاج</th>
                    <th>نوع الحجز</th>
                    <th>العلاج المقدم</th>
                    <th>الأدوات</th>
                    <th>الوقت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['patientDept'] as $item)
                <tr>
                    <td>{{ $item->patient->name }}</td>
                    <td>{{ $item->department->title }}</td>
                    <td>{{ $item->doctor_name }}</td>
                    <td>{{ $item->illness }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->cure }}</td>
                    <td>{{ $item->accounter->first()->pivot->check_in_type ?? 'غير متوفر' }}</td>
                    <td>{{ $item->accounter->first()->pivot->given_cure ?? 'غير متوفر' }}</td>
                    <td>{{ $item->accounter->first()->pivot->tools ?? 'غير متوفر' }}</td>
                    <td>{{ $item->created_at->format('H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if(isset($data['lazer']) && count($data['lazer']) > 0)
    <div class="section">
        <div class="section-title">جلسات الليزر</div>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>الطبيب</th>
                    <th>الجهاز</th>
                    <th>المنطقة</th>
                    <th>عدد الأشعة</th>
                    <th>الطاقة</th>
                    <th>السرعة</th>
                    <th>عرض النبضة</th>
                    <th>الوقت</th>
                    <th>السعر الفعلي</th>
                    <th>السعر</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['lazer'] as $session)
                    @foreach($session->Details as $detail)
                        <tr>
                            <td>{{ $session->patient->name }}</td>
                            <td>{{ $detail->doctor->user->name ?? 'غير متوفر' }}</td>
                            <td>{{ $detail->device }}</td>
                            <td>{{ $detail->point }}</td>
                            <td>{{ $detail->raysCount }}</td>
                            <td>{{ $detail->power }}</td>
                            <td>{{ $detail->speed }}</td>
                            <td>{{ $detail->pulse }}</td>
                            <td>{{ $session->created_at->format('H:i') }}</td>
                            <td>{{ $session->real_price }}</td>
                            <td>{{ $session->price }}</td>
                            <td>{{ $session->notes }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if(isset($data['skin']) && count($data['skin']) > 0)
    <div class="section">
        <div class="section-title">علاجات البشرة</div>
        <table>
            <thead>
                <tr>
                    <th>اسم المريض</th>
                    <th>الطبيب</th>
                    <th>العلاج</th>
                    <th>الوصف</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['skin'] as $treatment)
                <tr>
                    <td>{{ $treatment->patient->name }}</td>
                    <td>{{ $treatment->doctor->user->name }}</td>
                    <td>{{ $treatment->treatment }}</td>
                    <td>{{ $treatment->description }}</td>
                    <td>{{ $treatment->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="section">
        <div class="section-title">إحصائيات الأشعة</div>
        <table>
            <thead>
                <tr>
                    <th>النوع</th>
                    <th>عدد الأشعة في بداية اليوم</th>
                    <th>عدد الأشعة في نهاية اليوم</th>
                    <th>الفرق</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rayCounts = \App\Models\DailyRayCount::where('date', today())->first();
                @endphp
                <tr>
                    <td>AX</td>
                    <td>{{ $rayCounts->ax_start_count ?? 0 }}</td>
                    <td>{{ $rayCounts->ax_end_count ?? 0 }}</td>
                    <td>{{ ($rayCounts->ax_end_count ?? 0) - ($rayCounts->ax_start_count ?? 0) }}</td>
                </tr>
                <tr>
                    <td>AY</td>
                    <td>{{ $rayCounts->ay_start_count ?? 0 }}</td>
                    <td>{{ $rayCounts->ay_end_count ?? 0 }}</td>
                    <td>{{ ($rayCounts->ay_end_count ?? 0) - ($rayCounts->ay_start_count ?? 0) }}</td>
                </tr>
                <tr>
                    <td>Again</td>
                    <td>{{ $rayCounts->again_start_count ?? 0 }}</td>
                    <td>{{ $rayCounts->again_end_count ?? 0 }}</td>
                    <td>{{ ($rayCounts->again_end_count ?? 0) - ($rayCounts->again_start_count ?? 0) }}</td>
                </tr>
            </tbody>
        </table>
        @if($rayCounts && $rayCounts->notes)
            <div class="notes-section">
                <h4>ملاحظات:</h4>
                <p>{{ $rayCounts->notes }}</p>
            </div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">ملخص</div>
        <table>
            <tr>
                <th>إجمالي المرضى</th>
                <td>{{ count($data['patientDept']) + count($data['lazer']) }}</td>
            </tr>
             <tr>
                <th>إجمالي السعر الفعلي</th>
                <td>
                    @php
                        $totalRealPrice = 0;
                        foreach ($data['lazer'] as $lazer) {
                            $totalRealPrice += $lazer->real_price;
                        }
                    @endphp
                    {{ $totalRealPrice }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>