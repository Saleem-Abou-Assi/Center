<!DOCTYPE html>
<html>

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <title>Lazer Details</title>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    @include('layouts.navigation')

    <style>
          .basic {
                display: flex;
                flex-direction: row;
                justify-content: space-evenly;
                gap: 15mm;
            }
            .note{
                visibility: hidden;
                display: none;
            }
        @media print {
            body * {
                visibility: hidden;
            }

            .printable,
            .printable * {
                visibility: visible;
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

            .printable h3 {
                text-align: end;
            }

            .container1 {
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 2cm;
                visibility: visible;
                place-self: flex-start;
                transform: translateY(-6cm);
                max-height:14.5cm;
            }

            table {
                width: 18cm;
                /* Full width for tables */

                /* Collapse borders */
                margin: 0 auto;
                /* Center the table */
                font-size: 12px;
            }
            .prin{
                border:1px solid #000;
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

            .botons,
            .botons * {
                visibility: hidden;
            }

            .basic {
                display: flex;
                flex-direction: row;
                justify-content: space-evenly;
                gap: 15mm;
            }
            .note{
                visibility: visible;
                display: block;
                text-align: end;
            }

        }
    </style>
</head>

<body>
    <div class="all">
        <div class="page-title">
            <h1>تفاصيل الليزر</h1>
        </div>


        <div class="container1 printable">
            <div class="basic">
                
                <h3 style="color: black; text-align:center;">معاينة الليزر للمريض {{$lazer->Patient->name}}</h3>
            </div>
            <div class="table-container pron">
                <table id='lazerTable'>
                    <tbody>

                        <tr>
                            <th>التكلفة الأساسية</th>
                            <td>{{$lazer->price}}</td>
                        </tr>
                        <tr>
                            <th>التكلفة الفعلية</th>
                            <td>{{$lazer->real_price}}</td>
                        </tr>
                        <tr>
                            <th>ملاحظات</th>
                            <td>{{$lazer->notes}}</td>

                        </tr>
                        <tr>
                            <th>التاريخ</th>
                            <td>{{$lazer->created_at}}</td>

                        </tr>


                    </tbody>
                </table>
                <br>
            </div>

            <div class="table-container prin">
                <table>
                    <thead>
                        <tr>
                            <th>اسم الدكتور</th>
                            <th>عدد الأشعة</th>
                            <th>المنطقة</th>
                            <th>الطاقة</th>
                            <th>السرعة</th>
                            <th>عرض النبضة</th>
                            <th>الجهاز</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lazer->Details as $detail)
                            <tr>
                                <td>{{$detail->doctor->user->name}}</td>
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
                <h3 class="note">: ملاحظات </h3>
            </div>

            <div class="botons">
                <div class="boton">
                    <button class="add-btn" onclick="printPage()">طباعة التفاصيل</button>
                </div>
                <div class="boton">
                    <a href="javascript:void(0)" onclick="window.history.back()" class="custom-btn btn-2"><span
                            class="fa fa-arrow-left" style="font-size:25px"></span></a>
                </div>
            </div>
          
        </div>
    </div>
    <script>
        function printPage() {
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