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

            {{-- <div class="form-group , select-box">
                
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
    </div> --}}

    <button type="button" id="addRowBtn" class="add-btn"><span>أضف تفاصيلاّ</span></button>

                <table id="dynamicTable"> 
                    <thead>

                    </thead>
                    <tbody>
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
                <br>

    <div class="form-group">
        <label for="ray_price">سعر الشعاع</label>
        <span id="ray_price_display">{{$ray_price->price}}</span>
    </div>

    {{-- <div class="form-group">
        <label for="price">التكلفة لأساسية</label>
        <span id="price_dispaly"></span>
        <input type="hidden" id="price" name="price" >
    </div>  --}}

@isset($lazer)
    

<div class="form-group">
    <label for="raysCount">سعر الشعاع</label>
    {{$ray_price->price}} 
</div>


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

    document.addEventListener("DOMContentLoaded", function() {
        const raysCountInput = document.getElementById("raysCount");
        const rayPrice = parseFloat(document.getElementById("ray_price_display").innerText);
        const totalPriceDisplay = document.getElementById("price_dispaly");
        const totalPriceInput = document.getElementById("price");

        function calculateTotalPrice() {
            const raysCount = parseInt(raysCountInput.value) || 0;
            const totalPrice = rayPrice * raysCount;
            totalPriceDisplay.innerText = totalPrice.toFixed(2);
            totalPriceInput.value = totalPrice;
        }

        raysCountInput.addEventListener('input', calculateTotalPrice);

        // Initial calculation
        calculateTotalPrice();
    });
</script>

<script>
    document.getElementById('addRowBtn').addEventListener('click', function() {
        // Get the table body element  
        var tableBody = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];

        // Create new row and cells  
        var newRow = document.createElement('tr');
        var pointCell = document.createElement('td');
        var powerCell = document.createElement('td');
        var speedCell = document.createElement('td');
        var pulseCell = document.createElement('td');
        var countCell = document.createElement('td');
        var actionCell = document.createElement('td'); // Add action cell for delete button

        // Create select element for point
        var pointSelect = document.createElement('select');
        pointSelect.setAttribute('name', 'dynamicPoint[]');
        pointSelect.setAttribute('required', true);
        pointSelect.className = 'inp';

        // Define options for the select
        var options1 = [
            { value: '', text: 'اختر المنطقة' },
            { value: 'وجه', text: 'وجه' },
            { value: 'ابطين', text: 'ابطين' },
            { value: 'بكيني', text: 'بكيني' },
            { value: 'ايدين', text: 'ايدين' },
            { value: 'ساقين', text: 'ساقين' },
            { value: 'فخذين', text: 'فخذين' },
            { value: 'فل بدي', text: 'فل بدي' },
            { value: 'فل بدي كامل', text: 'فل بدي كامل' },
            { value: 'بطن', text: 'بطن' },
            { value: 'ظهر', text: 'ظهر' },
            { value: 'أرداف', text: 'أرداف' },
            { value: 'شفة', text: 'شفة' }
        ];

        options1.forEach(function(optionData) {
            var option = document.createElement('option');
            option.value = optionData.value;
            option.text = optionData.text;
            pointSelect.appendChild(option);
        });

        // Create select element for device
        var devicetSelect = document.createElement('select');
        devicetSelect.setAttribute('name', 'dynamicDevice[]');
        devicetSelect.setAttribute('required', true);
        devicetSelect.className = 'inp5';

        // Define options for the select
        var options2 = [
            { value: '', text: 'اختر الجهاز' },
            { value: 'ax', text: 'ax' },
            { value: 'ay', text: 'ay' },
            { value: 'again', text: 'again' }
        ];

        options2.forEach(function(optionData) {
            var option = document.createElement('option');
            option.value = optionData.value;
            option.text = optionData.text;
            devicetSelect.appendChild(option);
        });

        // Create input elements
        var speedInput = document.createElement('input');
        speedInput.setAttribute('type', 'number');
        speedInput.setAttribute('name', 'dynamicSpeed[]');
        speedInput.setAttribute('placeholder', 'السرعة');

        speedInput.className = 'inp2';

        var powerInput = document.createElement('input');
        powerInput.setAttribute('type', 'number');
        powerInput.setAttribute('name', 'dynamicPower[]');
        powerInput.setAttribute('placeholder', 'الطاقة');

        powerInput.className = 'inp1';

        var pulseInput = document.createElement('input');
        pulseInput.setAttribute('type', 'text');
        pulseInput.setAttribute('name', 'dynamicPulse[]');
        pulseInput.setAttribute('placeholder', 'عرض النبضة');
        pulseInput.className = 'inp3';

        var countInput = document.createElement('input');
        countInput.setAttribute('type', 'number');
        countInput.setAttribute('name', 'dynamicCount[]');
        countInput.setAttribute('placeholder', 'عدد الأشعة');

        countInput.className = 'inp4';

        // Append input fields to their respective cells  
        pointCell.appendChild(pointSelect);
        powerCell.appendChild(powerInput);
        speedCell.appendChild(speedInput);
        pulseCell.appendChild(pulseInput);
        countCell.appendChild(countInput);

        // Create delete button  
        var deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Delete';
        deleteBtn.className = 'action-btn'; // Set class for the button  
        deleteBtn.addEventListener('click', function() {
            // Remove the row when the delete button is clicked  
            newRow.remove();
        });

        // Append the delete button to the action cell  
        actionCell.appendChild(deleteBtn);
        actionCell.className = 'action-td'; // Set class for the td  

        // Append cells to the new row  
        newRow.appendChild(pointCell);
        newRow.appendChild(devicetSelect);
        newRow.appendChild(powerCell);
        newRow.appendChild(speedCell);
        newRow.appendChild(pulseCell);
        newRow.appendChild(countCell);
        newRow.appendChild(actionCell);

        // Append the new row to the table body  
        tableBody.appendChild(newRow);
    });
</script>
</body>
</html>