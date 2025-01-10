<!DOCTYPE html>
<html lang="ar">

<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>Waiting List</title>
    @include('layouts.navigation')

</head>

<body>
    <div class="C-container">
        <div class="col-container"> <!-- Add to Waiting List Form -->
            <div class="form-section">
                <h1>إضافة إلى قائمة الانتظار</h1>
                <form action="{{ route('waitingList.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="select-box">
                            <label for="doctor_id">اسم طبيب</label>
                            <select id="doctor_id" required name="doctor_id" autofocus>
                                <option value="">اختر طبيب</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
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
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="cta"><span>إضافة إلى القائمة</span></button>
                </form>
            </div>

            <!-- Waiting List for the Selected Doctor -->
            <div class="list-section">
                <h2>قائمة الانتظار للمعالج</h2>
                <div class="col-container">
                    <div class="select-box">
                        <label for="doctor_id">اسم طبيب</label>
                        <form method="GET" action="{{ route('waitingList.index') }}">
                            <select id="doctor_id" required name="doctor_id" onchange="this.form.submit()">
                                <option value="">اختر طبيب</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->user->name }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    @if(isset($selectedDoctor))
                    <ul>
                        @foreach ($selectedDoctor->waitingList as $patient)
                        <li>
                            {{ $patient->name }}
                            <form action="{{ route('waitingList.destroy', $patient->pivot->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn">إزالة</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>لا توجد قائمة انتظار لهذا الطبيب.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>