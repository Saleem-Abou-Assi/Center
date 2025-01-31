<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    
    <title>ادارة العيادات</title>
    @include('layouts.navigation')
</head>
<body>
    <div class="page-title">
        <h1>العيادات</h1>
    </div>
    <div class="container">
    <div class="but">
    <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:23px"></span></button>
    </div>
        <a href="{{ route('department.create') }}" class="cta"> <span>أنشئ عيادة</span>
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
                    <th>عنوان العيادة</th>
                    <th>تاريخ الانشاء</th>
                    <th>آخر تعديل</th>
                    <th>تفاصيل</th>  
                </tr>
            </thead>
            <tbody>
                <!-- Add your patient data rows here -->
                @foreach ($departments as $department)
                @php
                   
                @endphp
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->title }}</td>
                        <td>{{ $department->created_at }}</td>
                        <td>{{ $department->updated_at }}</td>
    
                        <td class="action-td">
                            <a href="{{ route('department.edit', $department->id) }}" class="action-btn">عدّل</a>                        
                                <!-- <form action="{{ route('department.destroy', $department->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn">Delete</button>
                                </form> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        
    </div>
    
</body>
</html>