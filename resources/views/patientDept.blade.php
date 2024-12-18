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
                <input type="text" required id="check_in_type" name="check_in_type" >
                </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="given_cure">العلاج المعطى</label>
                <input type="text" required id="given_cure" name="given_cure" >
            </div>
            <div class="form-group">
                <div class="select-box">

                    
                    {{-- <label for="tools">الأدوات المستخدمة</label>
                    <div id="tools-container" class="tools-container">
                        @foreach ($storages as $storage)
                            <div class="tool-item {{ $storage->quantity <= 0 ? 'disabled' : '' }}">
                                <input type="checkbox" 
                                       id="tool_{{$storage->id}}" 
                                       name="selected_tools[]" 
                                       value="{{$storage->id}}"
                                       {{ $storage->quantity <= 0 ? 'disabled' : '' }}>
                                <label for="tool_{{$storage->id}}" class="tool-label">
                                    {{$storage->name}} (المتبقي: {{$storage->quantity}})
                                </label>
                                <input type="number" 
                                       name="tool_quantity[{{$storage->id}}]" 
                                       min="1" 
                                       max="{{$storage->quantity}}" 
                                       value="1" 
                                       class="tool-quantity"
                                       {{ $storage->quantity <= 0 ? 'disabled' : '' }}>
                            </div>
                        @endforeach
                    </div> --}}
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toolItems = document.querySelectorAll('.tool-item:not(.disabled)');
        
        toolItems.forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            const quantityInput = item.querySelector('input[type="number"]');
            
            // Initially disable quantity input
            quantityInput.disabled = true;
            
            checkbox.addEventListener('change', function() {
                quantityInput.disabled = !this.checked;
                if (!this.checked) {
                    quantityInput.value = 1;
                }
            });
            
            quantityInput.addEventListener('change', function() {
                const max = parseInt(this.max);
                const value = parseInt(this.value);
                
                if (value > max) {
                    this.value = max;
                } else if (value < 1) {
                    this.value = 1;
                }
            });
        });
    });
    </script>
</body>
</html>