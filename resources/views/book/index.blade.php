<!DOCTYPE html>
<html>
<head>
@include('layouts.navigation')
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>إدارة الحجوزات</title>
    
</head>
<body>
    <div class="page-title"><h1>الحجوزات</h1></div>
    <div class="all">
    <div class="container">
    <div class="but">
    <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:23px"></span></button>
    </div>
    <a href="{{ route('book.create') }}" class="cta"><span>إضافة حجز</span>
    <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg>
    </a>
    <br>
    <br>
      

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>اسم المريض</th>
                    <th>رقم المريض</th>
                    <th>القسم</th>
                    <th>الطبيب المعالج</th>
                    <th>الموعد</th>
                    <th>موعد الانشاء</th>
                    <!-- <th>Updated At</th> -->
                    <th>تفاصيل</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add your patient data rows here -->
                @foreach ($books as $book)

                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->patient_name }}</td>
                        <td>{{ $book->phone }}</td>
                  
                        <td>{{ $book->doctor_id }}</td>
                        <td>{{ $book->bookDate }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td>{{ $book->updated_at }}</td>
                        <td class="action-td">
                            <a href="{{ route('book.edit', $book->id) }}" class="action-btn">عدّل</a>
                        
                                <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn">حذف</button>
                                </form>                   

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
    </div>
    </div>
</body>
</html>