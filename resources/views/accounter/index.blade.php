<!DOCTYPE html>
<html>
<head>
  <title>Table with Labels</title>
<style>
    body {
  font-family: Arial, sans-serif;
  margin: 20px;
}

header {
  text-align: center;
  margin-bottom: 20px;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}
</style>
</head>
<body>
  <header>
    <h1>حسابات</h1>
    <p>فاتورة المريض {{$patient->name}}</p>
  </header>

  <table>
    <thead>
    
      
    </thead>
    <tbody>
      <tr>
        <th>القسم المعني</th><td>{{$PD->title}}</td><td></td>
      </tr>
        <tr><th>الطبيب المعالج</th><td>{{$doctor->name}} </td><td></td>
        </tr>
        <tr>
        <th>نوع المعاينة</th><td>{{$apd->check_in_type}}</td><td></td>
      </tr>
      <tr>
        <th>الدواء الداخلي</th><td>{{$apd->given_cure}} </td><td>200</td>
      </tr>
      <tr>  
      <th>أدوات</th><td>{{$apd->tools}} </td><td>0</td>
    </tr>
    <tr>  
      <th>التكلفة الاجمالية</th><td>{{$apd->full_cost}} </td><td>{{$apd->full_cost}}</td>
    </tr>
    <tr>  
      <th>حالة الفاتورة</th><td>{{$apd->status}} </td><td></td>
      </tr>
    
    
    </tbody>
  </table>
</body>
</html>