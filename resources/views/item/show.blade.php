<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>ادارة المواد</title>
    @include('layouts.navigation')
</head>

<body>
    <div class="page-title">
        <h1>{{$storageItem->item}}</h1>
    </div>


   
    <div class="container">
        <a href="{{ route('item.index') }}" class="cta"> <span>رجوع</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </a>
    <p></p>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Doctor Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add your patient data rows here -->
                    @foreach ($records as $record)
                    <tr>
                        <td>{{$record['name']}}</td>
                        <td>{{$record['quantity']}}</td>
                        <td>{{$record['date']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>