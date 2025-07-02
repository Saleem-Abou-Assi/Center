<!DOCTYPE html>
<html>

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <title>Lazer Details</title>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    @include('layouts.navigation')

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .printable,
            .printable * {
                visibility: visible;
            }

            .printable {
                width: 80mm;
                max-width: 80mm;
                margin: 0;
                margin-left: -1mm;
                padding: 5mm;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title {
                text-align: center;
                margin-bottom: 5mm;
            }

            h1 {
                font-size: 16px;
                margin: 2mm 0;
            }

            h3 {
                font-size: 14px;
                margin: 2mm 0;
            }

            .container1 {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .table-container {
                width: 100%;
                margin-bottom: 5mm;
                display: flex;
                justify-content: flex-start;
            }

            .pron,
            .prin {
                width: 100%;
                display: flex;
                justify-content: flex-start;
            }

            .pron table,
            .prin table {
                width: 100%;
                display: flex;
                justify-content: flex-start;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }

            th,
            td {
                border: 1px solid #000;
                padding: 2mm;
                text-align: center;
                width: auto;
                min-width: 30mm;
            }

            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            .pron table {
                display: flex;
                flex-direction: column;
                width: 100%;
                justify-content: space-between;
                overflow: hidden;
            }

            .prin table {
                display: flex;
                flex-direction: row;
                width: 100%;
                justify-content: space-between;
                overflow: hidden;
            }

            .pron thead,
            .pron tbody,
            .prin thead,
            .prin tbody {
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .pron tr,
            .prin tr {
                display: flex;
                flex-direction: column;
                margin-right: 2mm;
                flex: 1;
            }

            .pron th,
            .pron td,
            .prin th,
            .prin td {
                display: block;
                width: 100%;
                text-align: center;
                border: 1px solid #000;
                padding: 2mm;
                font-size: 11px;
            }

            .botons {
                display: none;
            }

            .add-btn .custom-btn {
                visibility: hidden;
            }
        }
    </style>
</head>

<body>
    <div class="all">
        <div class="page-title printable">
            <h1>تفاصيل الليزر</h1>
        </div>

        <h3 style="color: white" class="printable">علاج الليزر للمريض {{$lazer->Patient->name}}</h3>

        <div class="container1 printable">
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