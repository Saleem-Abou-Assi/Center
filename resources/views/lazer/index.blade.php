<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Lazer Management</title>
    @include('layouts.navigation')
</head>
<body>

    <div class="C-container">
    <h1>قسم الليزر</h1>
        <form action="{{ route('lazer.store') }}" method="POST">
            @csrf
          
        
            <div class="form-group">
                <div class="select-box">
                <label for="doctor_id">اسم المعالج</label>
                <select id="doctor_id" required name="doctor_id" autofocus >
                    <option value="">اختر معالج</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>

            <div class="form-group">
                <div class="select-box">
                <label for="patient_id">اسم المريض</label>
                <select id="patient_id" required name="patient_id" autofocus >
                    <option value="">اختر مريض</option>
                    @foreach ($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>

            <div class="form-group , select-box">
                
                <label for="device">نوع الجهاز</label>
                <select id="device" required name="device" autofocus >
                    <option value="">اختر الجهاز</option>
                    <option value="ax">AX</option>
                    <option value="ax">AY</option>
                    <option value="ax">Again</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="raysCount">عدد الأشعة</label>
                <input type="number" required id="raysCount" name="raysCount" >
            </div>
            
            <div class="form-group , select-box">
                <label for="point">المنطقة</label>
                <select id="point" required name="point" autofocus >
                    <option value="">اختر الجهاز</option>
                    <option value="وجه">وجه</option>
                    <option value="ابطين">ابطين</option>
                    <option value="بكيني">بكيني</option>
                    <option value="ايدين">ايدين</option>
                    <option value="ساقين">ساقين</option>
                    <option value="فخذين">فخذين</option>
                    <option value="فل بدي">فل بدي</option>
                    <option value="فل بدي كامل">فل بدي كامل</option>
                    <option value="بطن">بطن</option>
                    <option value="ظهر">ظهر</option>
                    <option value="أرداف">أرداف</option>
                    <option value="شفة">شفة</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="power">الطاقة</label>
                <input type="number" required id="power" name="power" >
            </div>
         
            <div class="form-group">
                <label for="speed">السرعة</label>
                <input type="number" required id="speed" name="speed" >
            </div>

            <div class="form-group">
                <label for="pulse">عرض النبضة</label>
                <div class="input-group ">
                    <div class="select-box">
                    <select id="pulse" name="pulse" required>
                        <option value="">اختر عرض النبضة</option>
                        <option value="low">Low</option>
                        <option value="mid">Mid</option>
                        <option value="high">High</option>

                        <!-- Add more options as needed -->
                    </select>
                </div>
                    <button type="button" class="toggle-button">تحويل إلى حقل نص</button>
                </div>
            </div>

            <button type="submit" class="cta"><span>{{ 'Input' }}</span>
                <svg width="15px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </form>   


    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const select = document.getElementById("pulse");
            const input = document.createElement("input");
            const toggleButton = document.querySelector(".toggle-button");
    
            input.type = "text";
            input.id = "pulse";
            input.name = "pulse";
            input.required = true;
    
            toggleButton.addEventListener("click", function() {
                if (select.style.display === "none") {
                    select.style.display = "block";
                    input.style.display = "none";
                } else {
                    select.style.display = "none";
                    input.style.display = "block";
                    input.value = select.value;
                }
            });
    
            // Add this line to move the input element before the select element
            select.parentNode.insertBefore(input, select);
    
            // Add this line to initially hide the input element
            input.style.display = "none";
        });
    </script>
</body>
</html>