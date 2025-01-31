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
                    <option value="{{$doctor->id}}">{{$doctor->user->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>
        
           
            <div class="form-group">
        <label for="bookDate">الموعد</label>
        <input type="datetime-local" required id="bookDate" name="bookDate" value="{{ isset($book) ? $book->bookDate : '' }}">
        </div>
        
            <button type="submit" class="save-btn">{{ isset($book) ? 'عدّل' : 'احجز' }}</span></button>
            </button>
           
        
            
        </form>
        
        <div class="boton">
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    </div>
        
    </div>
    <script>
        save_btn=document.querySelector(".save-btn");

save_btn.onclick= function(){
    this.innerHTML="<div class=loader></div>";
}
    </script>
</body>
</html>