<!DOCTYPE html>
<html>
<head>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

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
  <table id='myTable'>

    <tbody>
  
      <tr>
        <th>القسم المعني</th><td>{{$account->PatientDept[0]->Department->title}}</td>
      </tr>
        <tr><th>الطبيب المعالج</th><td>{{$account->PatientDept[0]->doctor_name}} </td>
        </tr>
        <tr>
        <th>نوع المعاينة</th><td>{{$account->PatientDept[0]->pivot->check_in_type}}</td>
      </tr>
      <tr>
        <th>المرض</th><td>{{$account->PatientDept[0]->illness}} </td>
      </tr>
      <tr>
        <th>الوصف</th><td>{{$account->PatientDept[0]->description}} </td>
      </tr>
      <tr>
        <th>العلاج</th><td>{{$account->PatientDept[0]->cure}} </td>
      </tr>
      <tr>
      <tr>
        <th>الدواء الداخلي</th><td>{{$account->PatientDept[0]->pivot->given_cure}} </td>
      </tr>
      <tr>
        <th>الأدوات</th><td>{{$account->PatientDept[0]->pivot->tools}} </td>
      </tr>
      <tr>  
      <th>أدوات</th><td>{{$account->PatientDept[0]->pivot->tools}} </td>
    </tr>

    
    
    </tbody>
  </table>
  </div>
  <div class="boton">
    <button onclick="exportTableToExcel('myTable', )"  class="add-btn"><span>Export to Excel</span></button>
    </div>
  </div>
  </div>
 
  <script>
    function exportTableToExcel(tableID, filename = 'فاتورة المريض {{ $patient->name }}.xlsx') {
        var downloadLink;
        var dataType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
        // Specify file name
        filename = filename ? filename  : 'excel_data.xlsx';
    
        // Create download link element
        downloadLink = document.createElement("a");
    
        document.body.appendChild(downloadLink);
    
        var workbook = XLSX.utils.table_to_book(tableSelect, {sheet: "Sheet1"});
        var excelBuffer = XLSX.write(workbook, {bookType: 'xlsx', type: 'array'});
        var blob = new Blob([excelBuffer], {type: dataType});
    
        // Create a link to the file
        var url = URL.createObjectURL(blob);
        downloadLink.href = url;
    
        // Setting the file name
        downloadLink.download = filename;
    
        // Triggering the function
        downloadLink.click();
    }
    </script>
    
</body>
</html>