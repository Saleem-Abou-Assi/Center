<!DOCTYPE html>
<html>
<head>
  
  <title>Table with Labels</title>
  <link rel="stylesheet" href="{{ asset('css/accountant.css') }}">
  @include('layouts.navigation')
</head>
<body>
<div class="all">
<div class="page-title">
    <h1>حسابات</h1>
    <p>فاتورة المريض {{$patient->name}}</p>
  </div>  
    <br>
    <br>
 <div class="container">
 
  <div class="table-container">
  <table>
    <thead>
    
      
    </thead>
    <tbody>
      <tr>
        <th>القسم المعني</th><td>{{$PD->title}}</td><td class="cost"></td>
      </tr>
        <tr><th>الطبيب المعالج</th><td>{{$doctor->name}} </td><td class="cost"></td>
        </tr>
        <tr>
        <th>نوع المعاينة</th><td>{{$apd->check_in_type}}</td><td class="cost"></td>
      </tr>
      <tr>
        <th>الدواء الداخلي</th><td>{{$apd->given_cure}} </td><td class="cost">200</td>
      </tr>
      <tr>  
      <th>أدوات</th><td>{{$apd->tools}} </td><td class="cost">0</td>
    </tr>
    <tr>  
      <th>التكلفة الاجمالية</th><td>{{$apd->full_cost}} </td><td class="cost">{{$apd->full_cost}}</td>
    </tr>
    <tr>  
      <th>حالة الفاتورة</th><td>{{$apd->status}} </td><td class="cost"></td>
      </tr>
    
    
    </tbody>
  </table>
  </div>
  </div>
  </div>
</body>
</html>