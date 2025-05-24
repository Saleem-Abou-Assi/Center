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

        <h3>معايانات الليزر</h3>
        <div class="table-container lazer-details-table">
           
            <table>
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>المريض</th>
                        <th>التاريخ</th>
                        <th>التكلفة</th>
                        <th>تفاصيل الجلسة</th>
                        <th>عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctor->details as $i => $detail)
                        @foreach($detail->Lazers as $lazer)
                            <tr data-laser-operation-id="{{ $lazer->id }}" class="laser-operation-row">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $lazer->patient->name }}</td>
                                <td>{{ $lazer->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div>أساسي: {{ $lazer->price }}</div>
                                    <div>فعلي: {{ $lazer->real_price }}</div>
                                </td>
                                <td>
                                    <div class="lazer-session-details">
                                        <ul class="lazer-details-list">
                                            <li>
                                                <span class="detail-label">المعالج:</span>
                                                <span class="detail-value">{{ $detail->Doctor->user->name }}</span>
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
                                        </ul>
                                        @if($lazer->notes)
                                            <div class="lazer-notes">
                                                <strong>ملاحظات:</strong>
                                                <p>{{ $lazer->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="action-td">
                                    <a href="{{ route('lazer.show', $lazer->id) }}" class="action-btn">تفاصيل</a>
                                    <a href="{{ route('lazer.edit', $lazer->id) }}" class="action-btn">تعديل</a>
                                    <form id="deleteForm" action="{{ route('lazer.destroy', $lazer->id) }}" method="POST"
                                        onsubmit="return confirmCustom()" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn">إزالة</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
 </div>

        <div class="boton">
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    </div>
    </div>
</body>
</html>