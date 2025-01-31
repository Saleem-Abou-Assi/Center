<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>قسم البشرة</title>
    @include('layouts.navigation')
</head>
<body>

    <div class="C-container">
    <h1>معاينات البشرة</h1>
        <form action="{{ route('skin.store') }}" method="POST">
            @csrf
          
        
          

            <div class="form-group">
            <div class="select-box">
                <label for="patient">اسم المريض</label>
                <select id="patient" required name="patient" autofocus>
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
                <div class="select-box">
                    <label for="options">الحالة</label>
                    <select id="options" required name="options" >
                        <option value="">اختر الحالة</option>
                        <option value="دايموند">دايموند</option>
                        <option value="نوتوياج">نوتوياج</option>
                        <option value="هيدروفيشال">هيدروفيشال</option>
                        <option value="ملكبة">ملكبة</option>
                        <option value="كافيتاشن">كافيتاشن</option>

                    </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="select-box">
                        <label for="cost">التكلفة</label>
                       <input type="number" required name="cost" id="cost" value="0">
                        </div>
                    </div>

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