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
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #000;
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
            display: flex;
            justify-content: space-evenly;
        }
        @media print{
             body {
            font-family: "Cairo", sans-serif;
            padding: 20px;
            direction: rtl;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #000;
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
            display: flex;
            justify-content: space-evenly;
        }

        }

    </style>
</head>

<body>
    <div class="header">
        <h1>ملخص تقرير العمل اليومي</h1>
        <div class="date">
            <h3>ليوم: {{ now()->locale('ar')->isoFormat('dddd') }}</h3>
            <h3>التاريخ: {{ now()->format('Y-m-d') }}</h3>
    
        </div>
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
                        <th>نوع العملية</th>
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
                            <td>{{ $item->type ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @php
        $customTypeItems = collect($data['patientDept'])->filter(function ($item) {
            return $item->type === 'custom_type';
        });
    @endphp

    @if($customTypeItems->count() > 0)
        <div class="section">
            <div class="section-title">عمليات النوع المخصص</div>
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
                        <th>نوع العملية</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customTypeItems as $item)
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
                            <td>{{ $item->type ?? '-' }}</td>
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
   
        <h1>احصائيات اليوم</h1>
    @if(isset($data['lazer']) && count($data['lazer']) > 0)
        <div class="section">
            <div class="section-title">احصائيات الليزر</div>
            <h2>عدد الجلسات الكلي: {{ count($data['lazer']) }}</h2>
            <table>
                <thead>
                    <tr>
                        <th>الجهاز</th>
                        <th>عدد الجلسات</th>
                        <th>الأشعة المستهلكة</th>
                        <th>القيمة المستوفاة</th>
                        <th>السعر الافتراضي</th>
                        <th>القسم المالي</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $axSessions = 0;
                        $aySessions = 0;
                        $agSessions = 0;
                        $axRays = 0;
                        $ayRays = 0;
                        $agRays = 0;
                        $axRevenue = 0;
                        $ayRevenue = 0;
                        $agRevenue = 0;
                        $axDefaultPrice = 0;
                        $ayDefaultPrice = 0;
                        $agDefaultPrice = 0;
                        $axFinancial = 0;
                        $ayFinancial = 0;
                        $agFinancial = 0;
                    @endphp

                    @foreach($data['lazer'] as $lazer)
                        @foreach($lazer->Details as $detail)
                            @php
                                if ($detail->device == 'ax') {
                                    $axSessions++;
                                    $axRays += $detail->raysCount;
                                    $axRevenue += $lazer->real_price;
                                    $axDefaultPrice += $lazer->price;
                                    $axFinancial += $lazer->lazer_price;
                                } elseif ($detail->device == 'ay') {
                                    $aySessions++;
                                    $ayRays += $detail->raysCount;
                                    $ayRevenue += $lazer->real_price;
                                    $ayDefaultPrice += $lazer->price;
                                    $ayFinancial += $lazer->lazer_price;
                                } elseif ($detail->device == 'again') {
                                    $agSessions++;
                                    $agRays += $detail->raysCount;
                                    $agRevenue += $lazer->real_price;
                                    $agDefaultPrice += $lazer->price;
                                    $agFinancial += $lazer->lazer_price;
                                }
                            @endphp
                        @endforeach
                    @endforeach

                    @if($axSessions > 0)
                        <tr>
                            <td>AX</td>
                            <td>{{ $axSessions }}</td>
                            <td>{{ $axRays }}</td>
                            <td>{{ $axRevenue }}</td>
                            <td>{{ $axDefaultPrice }}</td>
                            <td></td>
                        </tr>
                    @endif

                    @if($aySessions > 0)
                        <tr>
                            <td>AY</td>
                            <td>{{ $aySessions }}</td>
                            <td>{{ $ayRays }}</td>
                            <td>{{ $ayRevenue }}</td>
                            <td>{{ $ayDefaultPrice }}</td>
                            <td></td>
                        </tr>
                    @endif

                    @if($agSessions > 0)
                        <tr>
                            <td>AG</td>
                            <td>{{ $agSessions }}</td>
                            <td>{{ $agRays }}</td>
                            <td>{{ $agRevenue }}</td>
                            <td>{{ $agDefaultPrice }}</td>
                            <td></td>
                        </tr>
                    @endif

                    <tr class="total-row">
                        <td>المجموع</td>
                        <td>{{ $axSessions + $aySessions + $agSessions }}</td>
                        <td>{{ $axRays + $ayRays + $agRays }}</td>
                        <td>{{ $axRevenue + $ayRevenue + $agRevenue }}</td>
                        <td>{{ $axDefaultPrice + $ayDefaultPrice + $agDefaultPrice }}</td>
                        <td>    </td>
                    </tr>
                </tbody>
            </table>
            <h3>اجمالي الدخل اليومي لليزر: {{ $axRevenue + $ayRevenue + $agRevenue }}</h3>
        </div>
    @endif

    @if(isset($data['patientDept']) && count($data['patientDept']) > 0)
        <div class="section">
            <div class="section-title">احصائيات العيادات:</div>
            <table>
                <thead>
                    <tr>
                        <th>اسم العيادة</th>
                        <th>الطبيب</th>
                        <th>عدد الاستشارات</th>
                        <th>القيمة المستوفاة</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $deptStats = [];
                        $totalDeptRevenue = 0;
                    @endphp

                    @foreach($data['patientDept'] as $item)
                        @php
                            $deptKey = $item->department->title . '-' . $item->doctor_name;
                            if (!isset($deptStats[$deptKey])) {
                                $deptStats[$deptKey] = [
                                    'department' => $item->department->title,
                                    'doctor' => $item->doctor_name,
                                    'count' => 0,
                                    'revenue' => 0
                                ];
                            }
                            $deptStats[$deptKey]['count']++;

                            // Calculate revenue from accounter pivot
                            $revenue = 0;
                            foreach ($item->Accounter as $accounter) {
                                $revenue += $accounter->pivot->full_cost ?? 0;
                            }
                            $deptStats[$deptKey]['revenue'] += $revenue;
                            $totalDeptRevenue += $revenue;
                        @endphp
                    @endforeach

                    @foreach($deptStats as $stat)
                        <tr>
                            <td>{{ $stat['department'] }}</td>
                            <td>{{ $stat['doctor'] }}</td>
                            <td>{{ $stat['count'] }}</td>
                            <td>{{ $stat['revenue'] }}</td>
                        </tr>
                    @endforeach

                    <tr class="total-row">
                        <td colspan="2">المجموع</td>
                        <td>{{ count($data['patientDept']) }}</td>
                        <td>{{ $totalDeptRevenue }}</td>
                    </tr>
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
                        <th>اسم العيادة</th>
                        <th>الطبيب</th>
                        <th>عدد الاستشارات</th>
                        <th>القيمة المستوفاة</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $skinStats = [];
                        $totalSkinRevenue = 0;
                    @endphp

                    @foreach($data['skin'] as $treatment)
                        @php
                            $skinKey = 'علاجات البشرة-' . $treatment->doctor->user->name;
                            if (!isset($skinStats[$skinKey])) {
                                $skinStats[$skinKey] = [
                                    'department' => 'علاجات البشرة',
                                    'doctor' => $treatment->doctor->user->name,
                                    'count' => 0,
                                    'revenue' => 0
                                ];
                            }
                            $skinStats[$skinKey]['count']++;
                            $skinStats[$skinKey]['revenue'] += $treatment->cost;
                            $totalSkinRevenue += $treatment->cost;
                        @endphp
                    @endforeach

                    @foreach($skinStats as $stat)
                        <tr>
                            <td>{{ $stat['department'] }}</td>
                            <td>{{ $stat['doctor'] }}</td>
                            <td>{{ $stat['count'] }}</td>
                            <td>{{ $stat['revenue'] }}</td>
                        </tr>
                    @endforeach

                    <tr class="total-row">
                        <td colspan="2">المجموع</td>
                        <td>{{ count($data['skin']) }}</td>
                        <td>{{ $totalSkinRevenue }}</td>
                    </tr>
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
                    <td>AG</td>
                    <td>{{ $rayCounts->again_start_count ?? 0 }}</td>
                    <td>{{ $rayCounts->again_end_count ?? 0 }}</td>
                    <td>{{ ($rayCounts->again_end_count ?? 0) - ($rayCounts->again_start_count ?? 0) }}</td>
                </tr>
            </tbody>
        </table>

        @php
            $totalLazerRevenue = 0;
            if (isset($data['lazer']) && count($data['lazer']) > 0) {
                foreach ($data['lazer'] as $lazer) {
                    $totalLazerRevenue += $lazer->real_price;
                }
            }

            $totalDeptRevenue = 0;
            if (isset($data['patientDept']) && count($data['patientDept']) > 0) {
                foreach ($data['patientDept'] as $item) {
                    foreach ($item->Accounter as $accounter) {
                        $totalDeptRevenue += $accounter->pivot->full_cost ?? 0;
                    }
                }
            }

            $totalSkinRevenue = 0;
            if (isset($data['skin']) && count($data['skin']) > 0) {
                foreach ($data['skin'] as $treatment) {
                    $totalSkinRevenue += $treatment->cost;
                }
            }

            $grandTotal = $totalLazerRevenue + $totalDeptRevenue + $totalSkinRevenue;
        @endphp

        <h2>اجمالي دخل المركز: {{ $grandTotal }}</h2>
        <br>
        @if($rayCounts && $rayCounts->notes)
            <div class="date">
                <h4>الإدارة</h4>
                <h4>اعداد التقرير:</h4>
            </div>
        @endif
    </div>
</body>

</html>