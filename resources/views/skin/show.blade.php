<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>تفاصيل معاينة البشرة</title>
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
                width: 148mm;
                max-width: 148mm;
                margin: 0 auto;
                padding: 10mm;
                display: flex;
                flex-direction: column;
                align-items: start;
                justify-content: center;
            }
            .boton, .add-btn{
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="C-container printable">
        <h1>تفاصيل معاينة البشرة</h1>
        <table class="table-container">
            <tr>
                <th>اسم المريض</th>
                <td>{{ $skin->patient->name ?? '' }}</td>
            </tr>
            <tr>
                <th>اسم الطبيب</th>
                <td>{{ $skin->doctor->user->name ?? '' }}</td>
            </tr>
            <tr>
                <th>الحالة</th>
                <td>{{ $skin->options }}</td>
            </tr>
            <tr>
                <th>التكلفة</th>
                <td>{{ $skin->cost }}</td>
            </tr>
            <tr>
                <th>تاريخ الإنشاء</th>
                <td>{{ $skin->created_at }}</td>
            </tr>
        </table>
        <div class="boton">
            <a href="{{ route('skin.edit', $skin->id) }}" class="custom-btn btn-2">تعديل</a>
            <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left"
            style="font-size:23px"></span></button>
        </div>
        <button onclick="printPage()" class="add-btn">طباعة التفاصيل</button>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</body>

</html>