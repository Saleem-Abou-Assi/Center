<!DOCTYPE html>
<html>

<head>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

  <title>قسم المحاسبة</title>
  <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
  @include('layouts.navigation')
  <style>
    @media print {
      body * {
        visibility: hidden;
        /* Hide everything by default */
      }

      .printable,
      .printable * {
        visibility: visible;
        /* Show only the printable elements */
      }

      .printable {
        width: 148mm;
        /* Set width to A5 */
        max-width: 148mm;
        margin: 0 auto;
        /* Center the content */
        padding: 10mm;
        display: flex;
        place-content: center;
      }

      table {
        width: 100%;
        /* Full width for tables */
        border-collapse: collapse;
        /* Collapse borders */
        margin: 0 auto;
        /* Center the table */
        font-size: 12px;
      }

      th,
      td {
        border: 1px solid #000;
        /* Solid border for cells */
        padding: 4px;
        /* Padding for cells */
        text-align: center;
        /* Center align text */
      }

      th {
        background-color: #f2f2f2;
        /* Light background for headers */
        font-weight: bold;
      }

      h1 {
        font-size: 18px;
        margin: 3mm 0;
        text-align: center;
      }

      h3 {
        font-size: 16px;
        margin: 3mm 0;
        text-align: center;
        /* Center headings */
      }

      .botons {
        display: none;
        /* Hide buttons during print */
      }


      .trtr {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        column-gap: 1px;
      }

      .page-title {
        text-align: center;
        margin-bottom: 8mm;
        width: 100%;
      }

      .container1 {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 2cm;
        visibility: visible;
      }

      .table-container {
        width: 100%;
        margin-bottom: 8mm;
        color: black;
      }

      .tab {
        position: absolute;
        left: 0;
        top: 0;
        padding: 15mm;
        margin-top: 20mm;
      }

      .tab2 {
        position: absolute;
        left: 0;
        top: 11cm;
        padding: 15mm;
        margin-top: 20mm;
      }

      .storage-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 2cm;
        visibility: visible;
      }

      .trtr1 {
        place-self: center;
      }

      .printable-text {
        visibility: visible;
        top: 0;
        place-self: center;
        position: absolute;
        color: black;
      }
    }
  </style>
</head>

<body>
  <div class="all">
    <div class="page-title">
      <h1>حسابات</h1>
    </div>


    <div class="container1 printable">
      <h3 style="text-align:center;" class="printable-text">فاتورة المريض {{$patient->name}}</h3>
      <div class="table-container">
        <table id='myTable' class="tab">
          <tbody>
            <tr>
              <td>{{$patientDept->Department->title}}</td>
              <th>القسم المعني</th>
            </tr>
            <tr>
              <td>{{$patientDept->doctor_name}} </td>
              <th>الطبيب المعالج</th>
            </tr>
            <tr>
              <td>{{$patientDept->Accounter[0]->pivot->check_in_type}}</td>
              <th>نوع المعاينة</th>
            </tr>
            <tr>
              <td>{{$patientDept->illness}} </td>
              <th>المرض</th>
            </tr>
            <tr>
              <td>{{$patientDept->description}} </td>
              <th>الوصف</th>
            </tr>
            <tr>
              <td>{{$patientDept->cure}} </td>
              <th>العلاج</th>
            </tr>
            <tr>
              <td>{{$patientDept->Accounter[0]->pivot->given_cure}} </td>
              <th>الدواء الداخلي</th>
            </tr>
            <tr>
              <td>{{$patientDept->Accounter[0]->pivot->full_cost}} </td>
              <th>اجمالي الفاتورة</th>  
            </tr>
          </tbody>
        </table>
      </div>

      <div class="storage-container printable">
        <table class="tab2">
          <thead>
            <tr class="trtr">
              <div class="trtr1">
                <th>اسم الأداة</th>
                <th>الكمية المستخدمة</th>
              </div>
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

      <br>
      <div class="botons">
        <div class="boton">
          <button class="add-btn" onclick="printPage()">طباعة التفاصيل</button>
        </div>
        <div class="boton">
          <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left"
              style="font-size:25px"></span></a>
        </div>
      </div>
    </div>
  </div>

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
      filename = filename ? filename : 'excel_data.xlsx';

      // Create download link element
      downloadLink = document.createElement("a");

      document.body.appendChild(downloadLink);

      var workbook = XLSX.utils.table_to_book(tableSelect, { sheet: "Sheet1" });
      var excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
      var blob = new Blob([excelBuffer], { type: dataType });

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