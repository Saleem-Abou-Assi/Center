<!DOCTYPE html>
<html>
<head>
    
    <title>إدارة الأطباء</title>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    @include('layouts.navigation')
</head>
<body>
    <div class="C-container">
        <h1>{{ isset($doctor) ? 'عدل على بيانات طبيب' : 'أضف طبيباً' }}</h1>

        <form action="{{ isset($doctor) ? route('doctor.update', $doctor->id) : route('doctor.store') }}" method="POST">
            @csrf
            @if (isset($doctor))
                @method('PUT')
            @endif
        
            <div class="form-group">
                <label for="name">الاسم</label>
                <input type="text" id="name" name="name" required value="{{ isset($doctor) ? $doctor->user->name : '' }}" autofocus>
            </div>
            
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" required value="{{ isset($doctor) ? $doctor->user->email : '' }}">
            </div>
            
            {{-- min 8 char ehaaaaaab --}}
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" {{ isset($doctor) ? '' : 'required' }}>
            </div>
            
            <!-- Rest of the form fields remain the same -->
        
            <div class="form-group">
                <label for="phone">الرقم</label>
                <input type="text" id="phone" name="phone" required value="{{ isset($doctor) ? $doctor->phone : '' }}">
            </div>
        
            <div class="form-group">
                <label for="address">العنوان</label>
                <input type="text" id="address" name="address" required value="{{ isset($doctor) ? $doctor->address : '' }}">
            </div>
        
        
            <div class="form-group">
                <label for="specialization">التخصص</label>
                <input type="text" required id="specialization" name="specialization" value="{{ isset($doctor) ? $doctor->specialization : '' }}">
            </div>

            <div class="form-group">
                <div class="select-box">
                    <label for="department">القسم</label>
                <select id="department" required name="department" >
                    <option value="">اختر قسماّ</option>
                    @foreach ($depts as $dept)
                    <option value="{{$dept->id}}">{{$dept->title}}</option>
                </div>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
            <button type="submit" class="cta"><span>{{ isset($doctor) ? 'تعديل' : 'إضافة' }}</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
        </form>
        <br/>
        <div class="boton">
        <a href="{{ route('doctor.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
    </div>
</body>
</html>