
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
        <h1>المستودع</h1>
    </div>
    <div class="container">
        
        <a href="{{ route('item.create') }}" class="cta"> <span>إضافة مادة</span>
        <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg>
</a>
        <br/>
        <br/>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>عنوان المادة</th>
                    <th>الكمية</th>
                    <th>تاريخ الانشاء</th>
                    <th>آخر تعديل</th>
                    <th>تفاصيل</th>  
                </tr>
            </thead>
            <tbody>
                <!-- Add your patient data rows here -->
                @foreach ($storages as $storage)
                @php
                   
                @endphp
                    <tr>
                        <td>{{ $storage->id }}</td>
                        <td>{{ $storage->item }}</td>
                        <td>{{$storage->quantity}}</td>
                        <td>{{ $storage->created_at }}</td>
                        <td>{{ $storage->updated_at }}</td>
    
                        <td class="action-td">
                            <a href="{{ route('item.edit', $storage->id) }}" class="action-btn">عدّل</a>                        
                            <a href="{{ route('item.show', $storage->id) }}" class="action-btn">حركة</a>                        

                        </td>
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        
    </div>
    
</body>
</html>