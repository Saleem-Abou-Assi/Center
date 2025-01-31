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
            <button type="submit" class="save-btn">أنشئ</button>
            
        </form>
        <br/>
        <div class="boton">
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    </div>
    </div>
    <script>
        save_btn=document.querySelector(".save-btn");

save_btn.onclick= function(){
    this.innerHTML="<div class=loader></div>";
    setTimeout(()=>{
        this.innerHTML="<span class="fa-check"></span>"
    },200)
}
    </script>
</body>
</html>