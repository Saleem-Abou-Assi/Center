<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>تعديل معاينة البشرة</title>
    @include('layouts.navigation')
</head>

<body>
    <div class="C-container">
        <h1>تعديل معاينة البشرة</h1>
        <form action="{{ route('skin.update', $skin->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="select-box">
                    <label for="patient">اسم المريض</label>
                    <input type="text" id="patientSearch" placeholder="بحث..." class="search-box" style="width:48%">
                    <select id="patient" required name="patient" autofocus>
                        <option value="">اختر مريضاّ</option>
                        @foreach ($patients as $patient)
                            <option value="{{$patient->id}}" {{ $skin->patient_id == $patient->id ? 'selected' : '' }}>
                                {{$patient->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="select-box">
                    <label for="doctor">اسم الطبيب</label>
                    <select id="doctor" required name="doctor">
                        <option value="">اختر طبيباّ</option>
                        @foreach ($doctors as $doctor)
                            @if ($doctor->user)
                                <option value="{{$doctor->id}}" {{ $skin->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    {{$doctor->user->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="select-box">
                    <label for="options">الحالة</label>
                    <select id="options" required name="options">
                        <option value="">اختر الحالة</option>
                        <option value="دايموند" {{ $skin->options == 'دايموند' ? 'selected' : '' }}>دايموند</option>
                        <option value="نوتوياج" {{ $skin->options == 'نوتوياج' ? 'selected' : '' }}>نوتوياج</option>
                        <option value="هيدروفيشال" {{ $skin->options == 'هيدروفيشال' ? 'selected' : '' }}>هيدروفيشال
                        </option>
                        <option value="ملكبة" {{ $skin->options == 'ملكبة' ? 'selected' : '' }}>ملكية</option>
                        <option value="كافيتاشن" {{ $skin->options == 'كافيتاشن' ? 'selected' : '' }}>كافيتاشن</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="select-box">
                    <label for="cost">التكلفة</label>
                    <input type="number" required name="cost" id="cost" value="{{ $skin->cost }}">
                </div>
            </div>
            <button type="submit" class="save-btn">حفظ التعديلات</button>
            <div class="boton">
                <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left"
                        style="font-size:23px"></span></button>
            </div>
        </form>
        <script>
            document.getElementById('patientSearch').addEventListener('input', function () {
                const searchValue = this.value.toLowerCase();
                const options = document.querySelectorAll('#patient option');
                options.forEach(option => {
                    if (option.textContent.toLowerCase().includes(searchValue)) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                });
            });
        </script>
    </div>
</body>

</html>