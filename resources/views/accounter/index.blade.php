<!DOCTYPE html>
<html>
<head>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

  <title>قسم المحاسبة</title>
  <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
  @include('layouts.navigation')
  <style>
   @media print{
      body * {
        visibility: hidden; /* Hide everything by default */
      }
      .printable, .printable * {
        visibility: visible; /* Show only the printable elements */
      }
      .printable {
        width: 21cm; /* Set width to A5 landscape */
        margin: 0 auto; /* Center the content */
      }
      table {
        width: 100%; /* Full width for tables */
        border-collapse: collapse; /* Collapse borders */
        margin: 0 auto; /* Center the table */
      }
      th, td {
        border: 2px solid #000; /* Solid border for cells */
        padding: 8px; /* Padding for cells */
        text-align: center; /* Right align text for Arabic */
      }
      th {
        background-color: #f2f2f2; /* Light background for headers */
      }
     h3 {
        text-align: center; /* Center headings */
      }
      .botons {
        display: none; /* Hide buttons during print */
      }
      .storage-container{
        position: inherit;
       width: 91.5% ;
        padding-top:69px;
       
      }
    .hrh{
      width: 100%;
      transform: translateX(-53px);
    }
    .trtr{
      display: grid;
      grid-template-columns: repeat(2,1fr);
      column-gap: 1px;
    }
  }
  </style>
  </head>
<body>
<div class="all">
<div class="page-title">
    <h1>حسابات</h1>
</div>
    
    <h3 style="color: white" class="printable">فاتورة المريض {{$patient->name}}</h3>
 

   
 
   
 <div class="container1 printable">
 
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
      </tbody>
      </table>
      </div>

      <div class="storage-container printable" >
          <div class="hrh">
        <table>
            <thead>
                <tr class="trtr">
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
      </div>
    
    
        
       <br>
     <div class="botons">
         <div class="boton">
         <button class="add-btn" onclick="printPage()">طباعة التفاصيل</button>

         </div>
         <div class="boton">
        <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
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