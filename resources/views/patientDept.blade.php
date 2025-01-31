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
            

                <label for="check_in_type">مكان المعاينة</label>
                <input type="text" required id="check_in_type" name="check_in_type" >
                </select>
                
            </div>
            
            <div class="form-group">
                <label for="given_cure">العلاج المعطى</label>
                <input type="text" required id="given_cure" name="given_cure" >
            </div>

            <div class="form-group">
                <label for="full_cost">أجرة الطبيب</label>
                <input type="number" required id="full_cost" name="full_cost" >
            </div>

          <div class="form-group">
    <div class="select-box">
        <label for="tools">الأدوات المستخدمة</label>
        <div id="tools-container">
            
            <select id="tool-select" name="tool_select" >
                <option value="">اختر أداة</option>
                @foreach ($storages as $storage)
                    @if ($storage->quantity > 0)
                        <option value="{{ $storage->id }}">{{ $storage->item }} </option>
                    @endif
                @endforeach
            </select>
            </div>
            <div class="br" ></div>
            <input type="number" id="tool-quantity" name="tool_quantity" min="1"   placeholder="الكمية">
            <button type="button" id="add-tool-button" class="add-btn-2">أضف اداة</button>
        </div>
        <br>
        <div id="added-tools-container" class="added-stuf"></div>
   
</div>

<script>
document.getElementById('add-tool-button').addEventListener('click', function() {
    const toolSelect = document.getElementById('tool-select');
    const toolQuantity = document.getElementById('tool-quantity');
    const addedToolsContainer = document.getElementById('added-tools-container');

    if (toolSelect.value && toolQuantity.value > 0) {
        const toolName = toolSelect.options[toolSelect.selectedIndex].text;
        const quantity = toolQuantity.value;

        // Create a new entry for the added tool
        const toolEntry = document.createElement('div');
        toolEntry.textContent = `${toolName} - كمية: ${quantity}`;
        
        // Create hidden inputs to store the selected tool ID and quantity
        const toolIdInput = document.createElement('input');
        toolIdInput.type = 'hidden';
        toolIdInput.name = 'selected_tools[]';
        toolIdInput.value = toolSelect.value;

        const toolQuantityInput = document.createElement('input');
        toolQuantityInput.type = 'hidden';
        toolQuantityInput.name = 'quantities[]';
        toolQuantityInput.value = quantity;

        // Append the hidden inputs to the form
        addedToolsContainer.appendChild(toolEntry);
        addedToolsContainer.appendChild(toolIdInput);
        addedToolsContainer.appendChild(toolQuantityInput);

        // Optionally, clear the selection after adding
        toolSelect.value = '';
        toolQuantity.value = 1;
    } else {
        alert('يرجى اختيار أداة وكمية صحيحة.');
    }
});
</script>
  

            <button type="submit" class="cta"><span>{{ 'Input' }}</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
                </svg>
            </button>
            <div class="boton">
    <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:23px"></span></button>
    </div>
        </form>
        
         
    </div>

    <style>
    .tools-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px; /* Space between items */
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ddd;
        padding: 10px;
    }

    .tool-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        width: calc(33% - 10px); /* Adjust width for three items per row */
    }

    .tool-item.disabled {
        opacity: 0.5;
        background-color: #f5f5f5;
    }

    .tool-quantity {
        width: 60px;
        padding: 2px 5px;
    }

    .tool-label {
        flex-grow: 1; /* Allow label to take available space */
    }
    </style>

  
</body>
</html>