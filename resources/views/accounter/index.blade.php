<!DOCTYPE html>
<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

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
  <table id='myTable'>
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
  <button onclick="exportTableToExcel('myTable', )">Export Table to Excel</button>

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