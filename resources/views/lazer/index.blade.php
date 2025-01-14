<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>Lazer Management</title>
    @include('layouts.navigation')
</head>
<body>

    {{-- 
    custmize this page styling and change the orientation of the elements
    --}}
    <div class="C-container">
    <h1>قسم الليزر</h1>
        <form action="{{ isset($lazer) ? route('lazer.update',$lazer->id) : route('lazer.store') }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            @if (isset($lazer))
            @method('PUT')
            @endif
        
            <div class="form-group">
                <div class="select-box">
                <label for="doctor_id">اسم المعالج</label>
                <select id="doctor_id" required name="doctor_id" autofocus >
                    <option value="{{isset($lazer) ? $lazer->doctor_id : ""}}">{{isset($lazer) ? $lazer->Doctor->user->name : "اختر طبيب"}}</option>

                    @foreach ($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->user->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>

            <div class="form-group">
                <div class="select-box">
                <label for="patient_id">اسم المريض</label>
                <select id="patient_id" required name="patient_id" autofocus >
                    <option value="{{isset($lazer) ? $lazer->patient_id : ''}}">{{isset($lazer) ? $lazer->Patient->name : "اختر مريض" }}</option>
                    @foreach ($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>

            <div class="form-group , select-box">
                
                <label for="device">نوع الجهاز</label>
                <select id="device" required name="device" autofocus >
                    <option value="{{isset($lazer) ? $lazer->device : ''}}">{{isset($lazer)? $lazer->device : "اختر الجهاز"}}</option>
                    <option value="ax">AX</option>
                    <option value="ay">AY</option>
                    <option value="again">Again</option>
                </select>
            </div>
            
            
            <div class="form-group , select-box">
                <label for="point">المنطقة</label>
                <select id="point" required name="point" autofocus value="{{isset($lazer) ? $lazer->point : ''}}" >
                    <option value="{{isset($lazer) ? $lazer->point : ''}}">{{isset($lazer)? $lazer->point : "اختر المنطقة"}}</option>
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
                <input type="number" required id="power" name="power" value="{{isset($lazer) ? $lazer->power : ''}}">
            </div>
         
            <div class="form-group">
                <label for="speed">السرعة</label>
                <input type="number" required id="speed" name="speed" value="{{isset($lazer) ? $lazer->speed : ''}}">
            </div>

            <form id="myForm">  
    <div class="form-group">  
        <label for="pulse">عرض النبضة</label>  
        <div class="input-group">  
            <select id="pulse" name="pulse"  value="{{isset($lazer) ? $lazer->pulse : ''}}">  
                <option value="{{isset($lazer) ? $lazer->pulse : ''}}">{{isset($lazer)? $lazer->pulse : "اختر عرض النبضة"}}</option>
                <option value="low">Low</option>  
                <option value="mid">Mid</option>  
                <option value="high">High</option>  
            </select>  
            <input type="text" id="pulse-input" name="pulse" placeholder="أدخل عرض النبضة" value="{{isset($lazer)? $lazer->pulse : ""}}" style="margin-left: 10px;">  
        </div>  
    </div>  

    <div class="form-group">
        <label for="raysCount">عدد الأشعة</label>
        <input type="number" required id="raysCount" name="raysCount" value="{{isset($lazer) ? $lazer->raysCount : ''}}" >
    </div>
@isset($lazer)
    

<div class="form-group">
    <label for="raysCount">سعر الشعاع</label>
    {{$ray_price->price}} 
</div>
{{-- 
<div class="form-group">
    <label for="raysCount">التكلفة الكلية</label>
    {{$ray_price*}}
</div> --}}

<div class="form-group">
    <label for="real_price">التكلفة الفعلية</label>
    <input type="number"  id="real_price" name="real_price" value="{{isset($lazer) ? $lazer->real_price : ''}}">
</div>

@endisset
  
    <div class="form-group">
        <label for="notes">ملاحظات</label>
        <textarea id="notes" name="notes" rows="4" cols="50" required>{{isset($lazer) ? $lazer->notes : ''}}</textarea>
    </div>
     


            <button type="submit" class="cta"><span>{{  isset($lazer) ? 'تعديل' : 'ادخال' }}</span>
                <svg width="15px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </form>   


    </div><script>
    document.addEventListener("DOMContentLoaded", function() {
        const select = document.getElementById("pulse");
        const input = document.getElementById("pulse-input");
        const form = document.querySelector("form"); // Select the form

        // Function to toggle input states
        function toggleInputs() {
            if (select.value) {
                input.value = ""; // Clear input if select has a value
                input.disabled = true; // Disable input
            } else {
                input.disabled = false; // Enable input if select is empty
            }

            if (input.value) {
                select.value = ""; // Clear select if input has a value
                select.disabled = true; // Disable select
            } else {
                select.disabled = false; // Enable select if input is empty
            }
        }

        // Event listeners for select and input
        select.addEventListener('change', toggleInputs);
        input.addEventListener('input', toggleInputs);

        // Handle form submission
        form.addEventListener('submit', function(event) {
            // Check if the select has a value
            if (select.value) {
                input.value = ""; // Clear input value if select is used
            } else if (input.value) {
                select.value = input.value; // Set select's value to input's value if input is used
            } else {
                // Prevent submission if both are empty
                event.preventDefault();
                alert("Please select a value or enter a value in the textbox.");
            }
        });

        // Initial state setup
        toggleInputs(); // Call to set initial states
    });
</script>
</body>
</html>