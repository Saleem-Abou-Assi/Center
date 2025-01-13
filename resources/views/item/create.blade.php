<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>إدارة الأقسام</title>
    @include('layouts.navigation')
</head>
<body> 

    <div class="C-container">
        <h1>{{ isset($storage) ? 'عدل مادة' : 'أضف مادة' }}</h1>

        <form action="{{ isset($storage) ? route('item.update', $storage->id) : route('item.store') }}" method="POST">
            @csrf
            @if (isset($storage))
                @method('PUT')
            @endif
        
            <div class="form-group" >
                <label for="item">اسم المادة</label>
                <input type="text" id="item" name="item" required value="{{ isset($storage) ? $storage->item : '' }} " autofocus>
            </div>
            <div class="form-group" >
                <label for="quantity"> الكمية</label>
                <input type="number" id="quantity" name="quantity" required value="{{ isset($storage) ? $storage->quantity : '' }} ">
            </div>
        
        
            <button type="submit" class="cta">
                <span>{{ isset($storage) ? 'عدّل' : 'أنشئ' }}</span>
                <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
  
        </form>
        <div class="boton">
        <a href="{{ route('item.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
    </div>
</body>
</html>