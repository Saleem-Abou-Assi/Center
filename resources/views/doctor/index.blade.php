<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
   
    <title>إدارة الاطباء</title>
    @include('layouts.navigation')
</head>
<body>
    <div class="page-title">
    <h1>الأطباء</h1>
    </div>
    <div class="container">

        
 <a href="{{ route('doctor.create') }}" class="cta"><span>أضف طبيباّ</span>
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
                <th>الاسم</th>  
                <th>الايميل</th>
                <th>الرقم</th>  
                <th>العوان</th>  
                <th>التخصص</th>  
                <th>تاريخ الإضافة</th>  
                <th>آخر تعديل</th>  
                <th>التفاصيل</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach ($doctors as $doctor)  
                <tr>  
                    <td>{{ $doctor->id }}</td>  
                    <td>{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->user->email }}</td>
                    <td>{{ $doctor->phone }}</td>  
                    <td>{{ $doctor->address }}</td>  
                    <td>{{ $doctor->specialization }}</td>  
                    <td>{{ $doctor->created_at }}</td>  
                    <td>{{ $doctor->updated_at }}</td>  
                    <td class="action-td">  
                        <a href="{{ route('doctor.edit', $doctor->id) }}" class="action-btn">تعديل</a>  
                        <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" style="display:inline;">  
                            @csrf  
                            @method('DELETE')  
                            <button type="submit" class="action-btn">إزالة</button>  
                        </form>  
                        <a href="{{ route('doctor.show', $doctor->id) }}" class="action-btn">عرض</a>  
                    </td>  
                </tr>  
            @endforeach  
        </tbody>  
    </table>  
</div>

       
    </div>
</body>
</html>