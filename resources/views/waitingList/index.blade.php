<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>Waiting List</title>
    @include('layouts.navigation')
</head>
<body>
{{$selectedDoctor=null}}
<div class="C-container">
    <h1>لائحة الانتظار</h1>
    <form action="{{ route('waitingList.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="select-box">
                <label for="doctor_id">اسم المعالج</label>
                <select id="doctor_id" required name="doctor_id" autofocus>
                    <option value="">اختر معالج</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{$doctor->id}}">{{$doctor->user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="select-box">
                <label for="patient_id">اسم المريض</label>
                <select id="patient_id" required name="patient_id" autofocus>
                    <option value="">اختر مريض</option>
                    @foreach ($patients as $patient)
                        <option value="{{$patient->id}}">{{$patient->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="cta"><span>إضافة إلى القائمة</span></button>
    </form>

    {{-- Display the waiting list for a selected doctor --}}
    <div class="waiting-list">
        <h2>قائمة الانتظار للمعالج</h2>
        <ul id="waiting-list">
            <div class="select-box">
                <label for="doctor_id">اسم المعالج</label>
                <select id="doctor_id" required name="doctor_id" autofocus>
                    <option value="">اختر معالج</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{$doctor->id}}">{{$doctor->user->name}}</option>
                    @endforeach
                </select>
            </div>
            @foreach ($waitingList as $entry)
                <li>
                    {{ $entry->patient->name }}
                    <form action="{{ route('waitingList.remove', $entry->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">إزالة</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>

   
<script>
   
</script>

</body>
</html>