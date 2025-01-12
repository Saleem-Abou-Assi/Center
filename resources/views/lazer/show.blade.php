<!DOCTYPE html>
<html>
<head>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

  <title>Lazer Details</title>
  <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
  @include('layouts.navigation')
</head>
<body>
<div class="all">
<div class="page-title">
    <h1>Lazer Details</h1>
</div>
    
    <h3 style="color: white">Lazer Treatment for Patient {{$lazer->Patient->name}}</h3>
 
 <div class="container1">
 
  <div class="table-container">
  <table id='lazerTable'>

    <tbody>
      <tr>
        <th>Doctor</th><td>{{$lazer->Doctor->user->name}}</td>
      </tr>
      <tr>
        <th>Rays Count</th><td>{{$lazer->raysCount}}</td>
      </tr>
      <tr>
        <th>Power</th><td>{{$lazer->power}}</td>
      </tr>
      <tr>
        <th>Speed</th><td>{{$lazer->speed}}</td>
      </tr>
      <tr>
        <th>Pulse</th><td>{{$lazer->pulse}}</td>
      </tr>
      <tr>
        <th>Device</th><td>{{$lazer->device}}</td>
      </tr>
      <tr>
        <th>Point</th><td>{{$lazer->point}}</td>
      </tr>
      <tr>
        <th>Real Price</th><td>{{$lazer->real_price}}</td>
      </tr>
      <tr>
        <th>Lazer Price</th><td>{{$lazer->lazer_price}}</td>
      </tr>
      <tr>
        <th>Notes</th><td>{{$lazer->notes}}</td>
      </tr>
    </tbody>
  </table>
  <br>
  </div>
  <div class="botons">
    <div class="boton">
  <button onclick="exportTableToExcel('lazerTable', )"  class="add-btn"><span>Export to Excel</span></button>
    </div>
    <div class="boton">
      <a href="javascript:void(0)" onclick="window.history.back()" class="custom-btn btn-2">Go Back</a>
    </div>
</div>

  </div>
  </div>
  
 
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
