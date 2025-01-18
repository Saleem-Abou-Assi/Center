<!DOCTYPE html>
<html>
<head>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

  <title>Lazer Details</title>
  <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
  @include('layouts.navigation')
</head>
<body>
  <style>
    @media print {
      body * {
        visibility: hidden; /* Hide everything by default */
      }
      .all, .all * {
        visibility: visible; /* Show the content you want to print */
      }
      .all {
        position: absolute; /* Position the content for printing */
        left: 0;
        top: 0;
      }
    }
  </style>
<div class="all">
<div class="page-title">
    <h1>تفاصيل الليزر</h1>
</div>
    
    <h3 style="color: white">علاج الليزر للمريض  {{$lazer->Patient->name}}</h3>
 
 <div class="container1">
 
  <div class="table-container">
  <table id='lazerTable'>

    <tbody>
      <tr>
        <th>الطبيب</th><td>{{$lazer->Doctor->user->name}}</td>
      </tr>
      <tr>
        <th>التكلفة الأساسية</th><td>{{$lazer->price}}</td>
      </tr>
      <tr>
        <th> التكلفة الفعلية</th><td>{{$lazer->real_price}}</td>
      </tr>
      <tr>
        <th>سعر الشعاع</th><td>{{$lazer->lazer_price}}</td>
      </tr>
      <tr>
        <th>ملاحظات</th><td>{{$lazer->notes}}</td>
      </tr>
      <table>
        <thead>
          <tr>
            <th>عدد الأشعة </th>
            <th>المنطقة </th>
            <th>الطاقة </th>
            <th>السرعة </th>
            <th>عرض النبضة </th>
            <th>الجهاز </th>
          </tr>
        </thead>
        <tbody>
          @foreach($lazer->Details as $detail)
          <tr>
            <td>{{$detail->raysCount}}</td>
            <td>{{$detail->point}}</td>
            <td>{{$detail->power}}</td>
            <td>{{$detail->speed}}</td>
            <td>{{$detail->pulse}}</td>
            <td>{{$detail->device}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </tbody>
  </table>
  <br>
  </div>
  <div class="botons">
    <div class="boton">
    <button class="add-btn" onclick="printPage()">طباعة التفاصيل</button>

    </div>
    <div class="boton">
      <a href="javascript:void(0)" onclick="window.history.back()" class="custom-btn btn-2">Go Back</a>
    </div>
</div>

  </div>
  </div>
  <script>
    function printPage(){
      window.print();
    }
  </script>
 
  <script>
    function exportTableToExcel(tableID, filename = 'Lazer_Details_{{ $lazer->Patient->name }}.xlsx') {
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
