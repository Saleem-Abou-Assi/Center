<!DOCTYPE html>
<html>
<head>
@include('layouts.navigation')
<link rel="stylesheet" href="{{ asset(path: 'css/merged.css') }}">
    <title>إدارة الأطباء</title>
    
    
</head>
<body>
<div class="show-head">
<div class="page-title1"><h1>تفاصيل الطبيب</h1></div>
<div class="ul">
<ul>
    <li data-label="الاسم:">{{ $doctor->user->name }}</li>
    <li data-label="الرقم:">{{ $doctor->phone }}</li>
    <li data-label="العوان:">{{ $doctor->address }}</li>
    <li data-label="التخصص:">{{ $doctor->specialization }}</li>
    <li data-label="القسم:">{{$doctor->Dept->title}}</li>
</ul>
</div>
</div>
    <div class="container">
       
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>القسم  </th>
                    <th>اسم المريض</th>
                    <th>نوع المعاينة</th>
                    <th>العلاج المعطى</th>
                    <th>الأدوات المستخدمة</th>
                    <th>الفاتورة</th>
                </tr>
            </thead>
           <tbody>
            @foreach ($doctor->APD as $apd)
            <tr>
                <td>{{$doctor->Dept->title  }}</td>
                <td>{{$apd->patient_name }}</td>
                <td>{{$apd->check_in_type }}</td> 
                <td>{{$apd->given_cure }}</td>
                <td>
                    @if($apd->storage->count() > 0)
                        <ul>
                            @foreach($apd->storage as $storage)
                                <li>{{ $storage->item }} ({{ $storage->pivot->quantity }})</li>
                            @endforeach
                        </ul>
                    @else
                        لا توجد أدوات
                    @endif
                </td>
                <td><a href="{{ route('accounter.index', $apd->id) }}" class="action-btn">عرض</a></td>
            </tr>
            @endforeach 
            </tbody>
        </table>

        <h4>معاينة الليزر</h4>
        <div class="table-container lazer-details-table">
            <table>
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>التاريخ</th>
                        <th>المريض</th>
                        <th>التكلفة</th>
                        <th>تفاصيل الجلسة</th>
                   
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctor->lazer as $i => $lazer)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $lazer->created_at->format('Y-m-d') }}</td>
                        <td>{{ $lazer->patient->name ?? 'غير محدد' }}</td>
                        <td>
                            <div>أساسي: {{ $lazer->price }} </div>
                            <div>فعلي: {{ $lazer->real_price }} </div>
                        </td>
                        <td>
                            <div class="lazer-session-details">
                                <ul class="lazer-details-list">
                                    @foreach($lazer->Details as $detail)
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
                                @if($lazer->notes)
                                <div class="lazer-notes">
                                    <strong>ملاحظات:</strong> 
                                    <p>{{ $lazer->notes }}</p>
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($lazer->Details->count() > 0)
                                <ul>
                                    @foreach($lazer->Details as $detail)
                                        <li>{{ $detail->device }}</li>
                                    @endforeach
                                </ul>
                            @else
                                لا توجد أدوات
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="boton">
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    </div>
    </div>
</body>
</html>