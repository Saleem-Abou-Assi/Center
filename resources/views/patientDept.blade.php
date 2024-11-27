<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>ادارة المرضى</title>
    @include('layouts.navigation')
</head>
<body>

    <div class="C-container">
    <h1>معاينات المريض</h1>
        <form action="{{ route('patientDept.store') }}" method="POST">
            @csrf
          
        
            <div class="form-group">
                <div class="select-box">
                <label for="department">عنوان العيادة</label>
                <select id="department" required name="department" autofocus >
                    <option value="">اختر عيادة</option>
                    @foreach ($depts as $dept)
                    <option value="{{$dept->id}}">{{$dept->title}}</option>

                    @endforeach
                </select>
                </div>
            </div>

            <div class="form-group">
            <div class="select-box">
                <label for="patient">اسم المريض</label>
                <select id="patient" required name="patient" >
                    <option value="">اختر مريضاّ</option>
                    @foreach ($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>
        
            <div class="form-group">
            <div class="select-box">
                <label for="doctor">اسم الطبيب</label>
                <select id="doctor" required name="doctor" >
                    <option value="">اختر طبيباّ</option>
                    @foreach ($doctors as $doctor)
                    @if ($doctor->user)

                    <option value="{{$doctor->id}}">{{$doctor->user->name}}</option>
                        
                    @endif
                    @endforeach
                </select>
                </div>
            </div>
        
            <div class="form-group">
                <label for="illness">المرض الحالي</label>
                <input type="text" required id="illness" name="illness" >
            </div>
            
            <div class="form-group">
                <label for="description">الوصفة الدوائيةالحالية</label>
                <input type="text" required id="description" name="description" >
            </div>

            <div class="form-group">
                <label for="cure">العلاج المتبع</label>
                <input type="text" required id="cure" name="cure" >
            </div>
            
            {{-- patient account details --}}
            <div class="form-group">
            <div class="select-box">
            
                <label for="check_in_type">مكان المعاينة</label>
                <select type="text" required id="check_in_type" name="check_in_type" >
                    <option value="">حدد</option>
                    <option value="eye">عين</option>
                    <option value="body">جسم</option>
                    <option value="bones">عضام</option>
                </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="given_cure">العلاج المعطى</label>
                <input type="text" required id="given_cure" name="given_cure" >
            </div>
            <div class="form-group">
                <label for="tools">الأدوات المستخدمة</label>
                <input type="text" required id="tools" name="tools" >
            </div>
      

            <button type="submit" class="cta"><span>{{ 'Input' }}</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
        </form>
        
         
    </div>
</body>
</html>