<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset(path: 'css/showPatiant.css') }}">
    <title>إدارة المرضى</title>
    @include('layouts.navigation')
   
    
</head>
<body>
    <div class="container">
        <h1>تفاصيل المريض</h1>
        <div class="lists-container">
            <ul class="ul">
                <li data-label="الاسم"><span>{{ $patient->name }}</span></li>
                <li data-label="الرقم"><span>{{ $patient->phone }}</span></li>
                <li data-label="العنوان"><span>{{ $patient->address }}</span></li>
                <li data-label="الجنس"><span>{{ $patient->Gender }}</span></li>
                <li data-label="الرقم"><span>{{ $patient->age }}</span></li>
                <li data-label="الحالة الاجتماعية"><span>{{ $patient->relation }}</span></li>
                <li data-label="عدد الأطفال"><span>{{ $patient->childerCount }}</span></li>
            </ul>
            <ul class="ul">
                <li data-label="مدخن"><span>{{ $patient->smooking }}</span></li>
                <li data-label="عمليات سابقة"><span>{{ $patient->oldSurgery }}</span></li>
                <li data-label="حساسية"><span>{{ $patient->alirgy }}</span></li>
                <li data-label="مرض مزمن"><span>{{ $patient->disease }}</span></li>
                <li data-label="الحمية الغذائية"><span>{{ $patient->dite }}</span></li>
                <li data-label="علاج متبع"><span>{{ $patient->permenantCure }}</span></li>
                <li data-label="عمليات تجميل سابقة"><span>{{ $patient->Cosmetic }}</span></li>
                <!-- <li data-label="المرض الحالي"><span>{{ $patient->CurrentDiseas }}</span></li> -->
            </ul>
        </div>
        <div class="table-container1">
            <h3>تفاصيل إضافية</h3>
        <table>
            <tr>
                <th>اسم الحقل</th>
                <th>محتوى الحقل</th>
            </tr>
            @if ($patient->Field)
            @foreach ($patient->Field as $field)
            <tr>
                <td>{{ $field->name }}</td>
                <td>{{ $field->value }}</td>
            </tr>
            @endforeach
            @endif
            
        </table>
        </div>
        <div class="container2">
        <table class="table-container">
            <thead>
            <tr>
                <th>الرقم</th>
                <th>القسم</th>
                <th>المعالج</th>
                <th>الشكوى </th>
                <th>الوصف</th>
                <th>التاريخ</th>
                <th>تفاصيل</th>

            </tr>
            </thead>
            @for ($i = 0; $i < count($patient->Dept); $i++)
            
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$patient->Dept[$i]->title  }}</td>
                <td>{{$patient->Dept[$i]->pivot->doctor_name }}</td>
                <td>{{$patient->Dept[$i]->pivot->illness }}</td> 
                <td>{{$patient->Dept[$i]->pivot->description }}</td>
                <td>{{$patient->Dept[$i]->created_at}} </td>
                
                <td><a href="{{ route('accounter.index', $patient->accounter->id) }}" class="action-btn">Show</a>   </td>
                                     

            </tr>
            @endfor
    

          
            <tr>

            </tr>


        </table>
        <br>
        <br>
       <h3>Lazer Information</h3>
        <table class="table-container">
            <thead>
            <tr>
                <th>الرقم</th>
                <th>اسم الدكتور</th>
                <th>الجهاز</th>
                <th>المنطقة</th>
                <th>عدد الأشعة </th>
                <th>الطاقة</th>
                <th>السرعة</th>
                <th>عرض النبضة</th>
            </tr>
            </thead>
            @for ($i = 0; $i < count($patient->Lazer); $i++)
            
            <tr>
                <td>{{$i+1}} </td>
                <td>{{$patient->Lazer[$i]->doctor->user->name  }}</td>
                <td>{{$patient->Lazer[$i]->device }}</td> 
                <td>{{$patient->Lazer[$i]->point }}</td>
                <td>{{$patient->Lazer[$i]->raysCount }}</td>
                <td>{{$patient->Lazer[$i]->power }}</td>
                <td>{{$patient->Lazer[$i]->speed }}</td>
                <td>{{$patient->Lazer[$i]->pulse }}</td>
                
            </tr>
            @endfor
    

          
            <tr>

            </tr>


        </table>
       
       
        <div class="boton">
        <a href="{{ route('patient.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
        </div>
        </div>
        
</body>
</html>