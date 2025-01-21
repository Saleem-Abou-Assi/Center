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
            @foreach ($doctor->APD as $apd)
            </thead>
           <tbody>
            <tr>
                <td>{{$doctor->Dept->title  }}</td>
                <td>{{$apd->patient_name }}</td>
                <td>{{$apd->check_in_type }}</td> 
                <td>{{$apd->given_cure }}</td>
                <td>{{$apd->tools }}</td>
            
                <td><a href="{{ route('accounter.index', $apd->id) }}" class="action-btn">عرض</a></td>
                                     

            </tr>
            @endforeach 
    

          
            <tr>

            </tr>

            </tbody>
        </table>

        <h4 >معاينة الليزر</h4>
        <table class="table-container">
            <thead>
            <tr>
                <th>الرقم</th>
                <th>اسم المريض</th>
                <th>الجهاز</th>
                <th>المنطقة</th>
                <th>عدد الأشعة </th>
                <th>الطاقة</th>
                <th>السرعة</th>
                <th>عرض النبضة</th>
            </tr>
            </thead>
            @for ($i = 0; $i < count($doctor->Lazer); $i++)
            
            <tr>
                <td>{{$i+1}} </td>
                <td>{{$doctor->Lazer[$i]->patient->name  }}</td>
                <td>{{$doctor->Lazer[$i]->device }}</td> 
                <td>{{$doctor->Lazer[$i]->point }}</td>
                <td>{{$doctor->Lazer[$i]->raysCount }}</td>
                <td>{{$doctor->Lazer[$i]->power }}</td>
                <td>{{$doctor->Lazer[$i]->speed }}</td>
                <td>{{$doctor->Lazer[$i]->pulse }}</td>
                
            </tr>
            @endfor

        </table>
       
        </div>
        <div class="boton">
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    </div>
    </div>
</body>
</html>