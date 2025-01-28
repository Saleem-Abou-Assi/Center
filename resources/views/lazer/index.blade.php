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
                <label for="patient_id">اسم المريض</label>
                <select id="patient_id" required name="patient_id" autofocus >
                    <option value="{{isset($lazer) ? $lazer->patient_id : ''}}">{{isset($lazer) ? $lazer->Patient->name : "اختر مريض" }}</option>
                    @foreach ($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->name}}</option>

                    @endforeach
                </select>
                </div>
            </div>

            

    <button type="button" id="addRowBtn" class="add-btn"><span>تفاصيل الليزر +</span></button>
    <br> 
    <br>    
    <div class="dynamic">
        <table id="dynamicTable" class="dyn"> 
        @isset($lazer)  <!-- Check if in edit mode -->
                    <thead>
                        <tr>
                            <th>الطبيب</th>
                            <th>المنطقة</th>
                            <th>الطاقة</th>
                            <th>السرعة</th>
                            <th>عرض النبضة</th>
                            <th>عدد الأشعة</th>
                            <th>الجهاز</th>
                            <th>إجراء</th>
                        </tr>
                    </thead>
                   @endisset
            <tbody>
                @if(isset($existingDetails) && count($existingDetails) > 0)
                    @foreach($existingDetails as $detail)
                        <tr class="row">
                            <td>
                                <div>
                                   
                                    <select id="doctor" required name="dynamicDoc[]" class="mini-select">
                                        <option value="{{$detail->doctor->id}}">{{$detail->doctor->user->name}}</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <select name="dynamicPoint[]" class="mini-select">
                                    <option value="{{ $detail->point }}">{{ $detail->point }}</option>
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
                            </td>
                            <td><input type="step" name="dynamicPower[]" value="{{ $detail->power }}"></td>
                            <td><input type="step" name="dynamicSpeed[]" value="{{ $detail->speed }}"></td>
                            <td><input type="text" name="dynamicPulse[]" value="{{ $detail->pulse }}"></td>
                            <td><input type="step" name="dynamicCount[]" value="{{ $detail->raysCount }}"></td>
                            <td>
                                <select name="dynamicDevice[]" class="mini-select">
                                    <option value="{{ $detail->device }}">{{ $detail->device }}</option>
                                    <option value="ax">AX</option>
                                    <option value="ay">AY</option>
                                    <option value="again">Again</option>
                                </select>
                            </td>
                            <td><button type="button" class="action-btn">حذف</button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
  
                <br>
         
<div>
    <span id="denamyCountSpan">0</span> <!-- Count for ax and ay -->
    <span id="dynamicCountSpan">0</span> <!-- Count for again -->
</div>


    

@isset($lazer)
    

<div class="form-group">
    <label for="axPrice">سعر الشعاع AX</label>
    {{$ray_price->ax_price}} 
    <label for="againPrice">سعر الشعاع Again</label>
    {{$ray_price->again_price}} 
</div>

<div class="form-group">
    <label for="price">التكلفة لأساسية</label>
    <span id="price_dispaly"></span>
    <input type="hidden" id="price" name="price" >
</div> 

<div class="form-group">
    <label for="real_price">التكلفة الفعلية</label>
    <input type="number"  id="real_price" name="real_price" value="{{isset($lazer) ? $lazer->real_price : ''}}">
</div>

@endisset
  
    <div class="form-group">
        <label for="notes">ملاحظات</label>
        <textarea id="notes" name="notes" rows="4" cols="50" >{{isset($lazer) ? $lazer->notes : ''}}</textarea>
    </div>
     


            <button type="submit" class="cta"><span>{{  isset($lazer) ? 'تعديل' : 'ادخال' }}</span>
                <svg width="15px" height="10px" viewBox="0 0 13 10">
                    <path d="M1,5 L11,5"></path>
                    <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </form>   


    </div>
    
<script>
    function updateDeviceCounts() {
        const tableBody = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];
        const rows = tableBody.getElementsByTagName('tr');
        let axAyCount = 0;
        let againCount = 0;

        for (let row of rows) {
            const deviceSelect = row.querySelector('select[name="dynamicDevice[]"]');
            const countInput = row.querySelector('input[name="dynamicCount[]"]');

            if (deviceSelect && countInput) {
                const deviceValue = deviceSelect.value;
                const countValue = parseInt(countInput.value) || 0;

                if (deviceValue === 'ax' || deviceValue === 'ay') {
                    axAyCount += countValue;
                } else if (deviceValue === 'again') {
                    againCount += countValue;
                }
            }
        }

        // Update the display or handle the counts as needed
        document.getElementById('denamyCountSpan').innerText = axAyCount;
        document.getElementById('dynamicCountSpan').innerText = againCount;
    }

    document.getElementById('addRowBtn').addEventListener('click', function() {
        console.log("Add button clicked"); // Debugging line
        // Get the table body element  
        var tableBody = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];

        // Create new row and cells  
        var newRow = document.createElement('tr');
        var docCell = document.createElement('td');
        var pointCell = document.createElement('td');
        var powerCell = document.createElement('td');
        var speedCell = document.createElement('td');
        var pulseCell = document.createElement('td');
        var countCell = document.createElement('td');
        var deviceCell = document.createElement('td'); // Cell for dynamicDevice
        var actionCell = document.createElement('td');

        newRow.className = 'nr';
        pointCell.className = 'sel';

        // Create select element for doctor
        var docSelect = document.createElement('select');
        docSelect.setAttribute('name', 'dynamicDoc[]');
        docSelect.setAttribute('required', true);
        docSelect.className = 'inp6';

        var options6 = [
            @foreach ($doctors as $doctor)
            { value: '{{$doctor->id}}', text: '{{$doctor->user->name}}' },
            @endforeach
        ];

        options6.forEach(function(optionData) {
            var option = document.createElement('option');
            option.value = optionData.value;
            option.text = optionData.text;
            docSelect.appendChild(option);
        });

        // Create select element for point
        var pointSelect = document.createElement('select');
        pointSelect.setAttribute('name', 'dynamicPoint[]');
        pointSelect.setAttribute('required', true);
        pointSelect.className = 'inp';

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
            { value: 'شفة', text: 'شفة' },
            { value: 'غير ذلك', text: 'غير ذلك' }
        ];

        options1.forEach(function(optionData) {
            var option = document.createElement('option');
            option.value = optionData.value;
            option.text = optionData.text;
            pointSelect.appendChild(option);
        });

        pointSelect.addEventListener('change', function() {
            if (this.value === 'غير ذلك') {
                this.disabled = true; // Disable the select
                var customInput = document.createElement('input'); // Create a text box
                customInput.setAttribute('type', 'text');
                customInput.setAttribute('name', 'dynamicPoint[]'); // Same name for form submission
                customInput.setAttribute('placeholder', 'أدخل قيمة أخرى');
                customInput.className = 'inp-custom'; // Optional: add a class for styling
                this.parentNode.appendChild(customInput); // Append the input next to the select
            }
        });

        // Create select element for device
        var deviceSelect = document.createElement('select');
        deviceSelect.setAttribute('name', 'dynamicDevice[]');
        deviceSelect.setAttribute('required', true);
        deviceSelect.className = 'inp6';

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
            deviceSelect.appendChild(option);
        });

        // Create input elements
        var speedInput = document.createElement('input');
        speedInput.setAttribute('type', 'step');
        speedInput.setAttribute('name', 'dynamicSpeed[]');
        speedInput.setAttribute('placeholder', 'السرعة');
        speedInput.className = 'inp2';

        var powerInput = document.createElement('input');
        powerInput.setAttribute('type', 'step');
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
        docCell.appendChild(docSelect);
        pointCell.appendChild(pointSelect);
        powerCell.appendChild(powerInput);
        speedCell.appendChild(speedInput);
        pulseCell.appendChild(pulseInput);
        countCell.appendChild(countInput);
        deviceCell.appendChild(deviceSelect);

        // Create delete button  
        var deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'حذف';
        deleteBtn.className = 'action-btn'; // Set class for the button  
        deleteBtn.addEventListener('click', function() {
            // Remove the row when the delete button is clicked  
            newRow.remove();
            updateDeviceCounts(); // Update counts after row deletion
        });

        // Append the delete button to the action cell  
        actionCell.appendChild(deleteBtn);
        actionCell.className = 'action-td'; // Set class for the td  

        // Append cells to the new row  
        newRow.appendChild(docCell);
        newRow.appendChild(deviceCell);
        newRow.appendChild(pointCell);
        newRow.appendChild(powerCell);
        newRow.appendChild(speedCell);
        newRow.appendChild(pulseCell);
        newRow.appendChild(countCell);
        newRow.appendChild(actionCell);

        // Append the new row to the table body  
        tableBody.appendChild(newRow);

        // Call updateDeviceCounts after adding a new row
        updateDeviceCounts();

        // Add event listener to the count input
        countInput.addEventListener('input', updateDeviceCounts);
    });


    document.addEventListener("DOMContentLoaded", function() {
        const AXraysCountInput = document.getElementById("denamyCountSpan");
        const AgainraysCountInput = document.getElementById("dynamicCountSpan");
        const totalPriceDisplay = document.getElementById("price_dispaly");
        const totalPriceInput = document.getElementById("price");
        if (AXraysCountInput) { // Check if the element exists
            const axPrice = {{$ray_price->ax_price}};
            const agianPrice = {{$ray_price->again_price}}
            
           

            function calculateTotalPrice() {
                const AXraysCount = parseInt(AXraysCountInput.innerText) || 0; // Use innerText to get the displayed value
                const AgainraysCount = parseInt(AgainraysCountInput.innerText) || 0; // Use innerText to get the displayed value
                
                const totalPriceAX = axPrice * AXraysCount;
                const totalPriceAgain = agianPrice * AgainraysCount; // Corrected to use agianPrice
                const total = totalPriceAX + totalPriceAgain;
                totalPriceDisplay.innerText = total.toFixed(2);
                totalPriceInput.value = total;
            }

            // Initial calculation
            updateDeviceCounts();
            calculateTotalPrice(); // Ensure this is called to calculate the price on load

            // Add event listeners to update counts and recalculate price when inputs change
            document.querySelectorAll('input[name="dynamicCount[]"]').forEach(input => {
                input.addEventListener('input', function() {
                    updateDeviceCounts();
                    calculateTotalPrice();
                });
            });
        }
    });
</script>
</body>
</html>