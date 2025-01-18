<!DOCTYPE html>
<html>
<head>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

  <title>Table with Labels</title>
  <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
  @include('layouts.navigation')
  </head>
<body>
<div class="all">
<div class="page-title">
    <h1>حسابات</h1>
</div>
    
    <h3 style="color: white">فاتورة المريض {{$patient->name}}</h3>
 

   
 
   
 <div class="container1">
 
  <div class="table-container">
  <table id='myTable' class="tab">

    <tbody>
  
      <tr>
        <th>القسم المعني</th><td>{{$patientDept->Department->title}}</td>
      </tr>
        <tr><th>الطبيب المعالج</th><td>{{$patientDept->doctor_name}} </td>
        </tr>
        <tr>
        <th>نوع المعاينة</th><td>{{$patientDept->Accounter[0]->pivot->check_in_type}}</td>
      </tr>
      <tr>
        <th>المرض</th><td>{{$patientDept->illness}} </td>
      </tr>
      <tr>
        <th>الوصف</th><td>{{$patientDept->description}} </td>
      </tr>
      <tr>
        <th>العلاج</th><td>{{$patientDept->cure}} </td>
      </tr>
      <tr>
      <tr>
        <th>الدواء الداخلي</th><td>{{$patientDept->Accounter[0]->pivot->given_cure}} </td>
      </tr>
      <tr>
        <th>اجرة الطبيب</th><td>{{$patientDept->Accounter[0]->pivot->full_cost}} </td>
      </tr>
      
      <div class="storage-container">
     
        <table>
            <thead>
                <tr>
                    <th>اسم الأداة</th>
                    <th>الكمية المستخدمة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apd[0]->storage as $storage)
                    <tr>
                        <td>{{ $storage->item }}</td>
                        <td>{{ $storage->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    
    
         </tbody>
       </table>
       <br>
     <div class="botons">
         <div class="boton">
         <button class="add-btn" onclick="printPage()">طباعة التفاصيل</button>

         </div>
         <div class="boton">
        <a href="{{ url()->previous() }}" class="custom-btn btn-2">Go Back</a>
         </div>
     </div>
  </div>
 
  </div>
  </div>
  <style>@media print {
            body * {
                visibility: hidden; /* Hide everything */
            }
            table, table * {
                visibility: visible; /* Show the table and its contents */
               
            }
            .tab {
                
                position: absolute; /* Position the table for printing */
                left: 0;
                top: 0;
              
            }
            .storage-container{
              position: relative;
              
            }
          
            
        }</style>
  <script>
        function printPage() {
            window.print(); // Trigger the print dialog
        }
    </script>
 
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