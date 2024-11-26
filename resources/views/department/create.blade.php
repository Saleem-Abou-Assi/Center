<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>إدارة العيادات</title>
    @include('layouts.navigation')
</head>
<body>

    <div class="C-container">
        <h1>{{ isset($department) ? 'عدل قسماّ' : 'أضف قسماّ' }}</h1>

        <form action="{{ isset($department) ? route('department.update', $department->id) : route('department.store') }}" method="POST">
            @csrf
            @if (isset($department))
                @method('PUT')
            @endif
        
            <div class="form-group" >
                <label for="title">عنوان القسم</label>
                <input type="text" id="title" name="title" required value="{{ isset($department) ? $department->name : '' }} " autofocus>
            </div>
        
        
            <button type="submit" class="cta">
                <span>{{ isset($department) ? 'عدّل' : 'أنشئ' }}</span>
                <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
  
        </form>
        <div class="boton">
        <a href="{{ route('department.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
    </div>
</body>
</html>