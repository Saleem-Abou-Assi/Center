<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>تقرير مخصص</title>
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
        <h1>تقرير مخصص</h1>
        <p>الفترة: {{ $data['summary']['start_date'] }} إلى {{ $data['summary']['end_date'] }}</p>
    </div>

    @if(isset($data['grouped_data']) && count($data['grouped_data']) > 0)
        @foreach($data['grouped_data'] as $date => $dayData)
            <div class="date-section">
                <div class="date-header">
                    <h2>{{ $date }}</h2>
                </div>

                @if(isset($dayData['patientDept']) && count($dayData['patientDept']) > 0)
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
                                <th>سعر الحجز</th>
                                <th>الوقت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dayData['patientDept'] as $item)
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
                                <td>{{ $item->total_cost }}</td>
                                <td>{{ $item->created_at->format('H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if(isset($dayData['lazer']) && count($dayData['lazer']) > 0)
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
                                <th>السعر الافتراضي</th>
                                <th>السعر الحقيقي</th>
                                <th>ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dayData['lazer'] as $session)
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
                <div class="section">
                    <div class="section-title">إحصائيات الأشعة</div>
                    <table>
                        <thead>
                            <tr>
                                <th>النوع</th>
                                <th>العدد</th>
                                <th>السعر</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $axCount = 0;
                                $ayCount = 0;
                                $againCount = 0;
                                $totalCount = 0;
                            @endphp
                            @foreach($dayData['lazer'] as $lazer)
                                @foreach($lazer->Details as $detail)
                                    @switch($detail->device)
                                        @case('ax')
                                            @php $axCount += $detail->raysCount; @endphp
                                            @break
                                        @case('ay')
                                            @php $ayCount += $detail->raysCount; @endphp
                                            @break
                                        @case('again')
                                            @php $againCount += $detail->raysCount; @endphp
                                            @break
                                    @endswitch
                                    @php $totalCount += $detail->raysCount; @endphp
                                @endforeach
                            @endforeach
                            @php
                                $axPrice = 0;
                                $ayPrice = 0;
                                $againPrice = 0;
                                $totalPrice = 0;
                            @endphp
                            @foreach($dayData['lazer'] as $lazer)
                                @foreach($lazer->Details as $detail)
                                    @switch($detail->device)
                                        @case('ax')
                                            @php $axPrice += $lazer->price; @endphp
                                            @break
                                        @case('ay')
                                            @php $ayPrice += $lazer->price; @endphp
                                            @break
                                        @case('again')
                                            @php $againPrice += $lazer->price; @endphp
                                            @break
                                    @endswitch
                                    @php $totalPrice += $lazer->price; @endphp
                                @endforeach
                            @endforeach
                            <tr>
                                <td>AX</td>
                                <td>{{ $axCount }}</td>
                                <td>{{ $axPrice }}</td>
                            </tr>
                            <tr>
                                <td>AY</td>
                                <td>{{ $ayCount }}</td>
                                <td>{{ $ayPrice }}</td>
                            </tr>
                            <tr>
                                <td>Again</td>
                                <td>{{ $againCount }}</td>
                                <td>{{ $againPrice }}</td>
                            </tr>
                            <tr>
                                <td>المجموع</td>
                                <td>{{ $totalCount }}</td>
                                <td>{{ $totalPrice }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="daily-summary">
                    <p>إجمالي المرضى اليومي: {{ $dayData['summary']['total_patients'] }}</p>
                    <p>إجمالي الإيرادات اليومي: {{ $dayData['summary']['total_revenue'] }}</p>
                    <p>إجمالي السعر الفعلي: 
                        @php
                            $totalRealPrice = 0;
                            foreach ($dayData['lazer'] as $lazer) {
                                $totalRealPrice += $lazer->real_price;
                            }
                        @endphp
                        {{ $totalRealPrice }}
                    </p>
                </div>
            </div>
                @endif

                @if(isset($dayData['skin']) && count($dayData['skin']) > 0)
                <div class="section">
                    <div class="section-title">علاجات البشرة</div>
                    <table>
                        <thead>
                            <tr>
                                <th>اسم المريض</th>
                                <th>الطبيب</th>
                               
                                <th>الحالة</th>
                                <th>التكلفة</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dayData['skin'] as $treatment)
                            <tr>
                                <td>{{ $treatment->patient->name }}</td>
                                <td>{{ $treatment->doctor->user->name }}</td>
                                
                                <td>{{ $treatment->options }}</td>
                                <td>{{ $treatment->cost }}</td>
                                <td>{{ $treatment->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        @endforeach
    @endif

    <div class="summary">
        <h3>ملخص عام</h3>
        <p>إجمالي المرضى: {{ $data['summary']['total_patients'] }}</p>
    </div>
</body>

</html>