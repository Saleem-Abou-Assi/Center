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
            @if (Auth::user()->hasRole('reciption') || Auth::user()->hasRole('admin'))               
           
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
            @endif

            <!-- Waiting List for the Selected Doctor -->
            <div class="list-section">
                <h2>قائمة الانتظار للمعالج</h2>
                <div class="col-container">
                    
                        <table>
                            <tr>
                            <th>اسم المريض</th>
                            <th>اسم الطبيب</th>
                            <th>ازالة</th>
                        </tr>
                        @foreach ($waitingList as $patient)
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('reciption'))
                        
                        <tr>
                        <td>
                            {{ $patient->patient->name }} 
                            </td>
                            <td>
                                {{$patient->doctor->user->name}}
                            
                            </td>
                            <td>    <form action="{{ route('waitingList.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn">إزالة</button>
                            </form>
                        </td>
                    </tr>
                    @elseif (Auth::user()->hasRole('doctor'))
                    @if ($patient->doctor->user->name == Auth::user()->name)
                    <tr>
                    <td>{{$patient->patient->name}}</td>
                        <td> {{$patient->doctor->user->name}}</td>
                        <td>    <form action="{{ route('waitingList.destroy', $patient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">إزالة</button>
                        </form>
                    </td>
                </tr>
                    @endif
                    @else
                    <p>لا يوجد مرضى في قائمة الانتظار</p>
                        @endif
                        @endforeach 
                    </table>
                    
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>