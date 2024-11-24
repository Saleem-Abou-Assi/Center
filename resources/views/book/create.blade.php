<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>الحجوزات</title>
    @include('layouts.navigation')
</head>
<body>
    <div class="C-container">
        <h1>{{ isset($book) ? 'تعديل' : 'إضافة حجز' }}</h1>

        <form action="{{ isset($book) ? route('book.update', $book->id) : route('book.store') }}" method="POST">
            @csrf
            @if (isset($book))
                @method('PUT')
            @endif
        
            <div class="form-group">
                <label for="patient_name">اسم المريض</label>
                <input type="text" id="patient_name" name="patient_name" required value="{{ isset($book) ? $book->patient_name : '' }}">
            </div>
        
            <div class="form-group">
                <label for="phone">رقم لمريض</label>
                <input type="text" id="phone" name="phone" required value="{{ isset($book) ? $book->phone : '' }}">
            </div>
        
            
            <div class="form-group">
                <div class="select-box">
                <label for="dept_id">القسم</label>
                <select id="dept_id" required name="dept_id">
                    <option value="">اختر قسماّ</option>
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->title }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            

            <div class="form-group">
            <div class="select-box">
                <label for="doctor_id">أسم الطبيب</label>
                <select id="doctor_id" required name="doctor_id" >
                    <option value="">اختر طبيباّ</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>
        
           
            <div class="form-group">
        <label for="bookDate">الموعد</label>
        <input type="datetime-local" required id="bookDate" name="bookDate" value="{{ isset($book) ? $book->bookDate : '' }}">
        </div>
        
            <button type="submit" class="cta"><span>{{ isset($book) ? 'عدّل' : 'احجز' }}</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
        </form>
        <div class="boton">
        <a href="{{ route('book.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
    </div>
</body>
</html>