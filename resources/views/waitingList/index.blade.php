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
                    <div class="grid">
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
                            <input type="text" id="patientSearch" placeholder="بحث..." class="search-box" style="width:48%">
                            <select id="patient_id" required name="patient_id" autofocus>
                                <option value="">اختر مريض</option>
                                @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="select-box">
                            <label for="device">الجهاز</label>
                            <select id="device" required name="device" autofocus onchange="toggleCustomDeviceInput()">
                                <option value="">اختر جهاز</option>
                                <option value="AX">AX</option>
                                <option value="AY">AY</option>
                                <option value="Again">Again</option>
                                <option value="custom">خدمة</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="custom-device-input" style="display: none;">
                    <label for="custom_device">أدخل قيمة مخصصة</label>
                    <input type="text" id="custom_device" name="custom_device" placeholder="أدخل قيمة مخصصة">
                </div>
                <button type="submit" class="cta cta1" onclick="setCustomDeviceValue()"><span>إضافة إلى القائمة</span></button>

                  
                </form>
            </div>
            @endif

            <!-- Waiting List for the Selected Doctor -->
            <div class="list-section">
                <h2>قائمة الانتظار للمعالج</h2>
                <div class="col-container">
                    
                        <table id="waiting-list-table">
                            <tr>
                            <th>اسم المريض</th>
                            <th>اسم الطبيب</th>
                            <th>الخدمة
                                
                            </th>
                            <th>ازالة</th>
                        </tr>
                        @foreach ($waitingList as $patient)
                                    @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('reciption'))

                                            <tr>
                                            <td>
                                                <a href="{{ route('patient.show', $patient->patient->id) }}" style="color: inherit; text-decoration: none; background-color:#0674c272; border-radius: 5px; padding:5px; ">{{ $patient->patient->name }}</a>
                                                </td>
                                                <td>
                                                    {{$patient->doctor->user->name}}

                                                </td>
                                                <td>
                                                    {{$patient->device}}
                                                </td>
                                                <td>    <form action="{{ route('waitingList.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-btn">إزالة</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @elseif (Auth::user()->hasRole('doctor'))
                                @if ($patient->doctor->user->name == Auth::user()->name)
                                <tr>
                                <td>{{$patient->patient->name}}</td>
                                    <td> {{$patient->doctor->user->name}}</td>
                                    <td>
                                        {{$patient->device}}
                                    </td>
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
    <script>
        window.setTimeout(function() {
            window.location.reload();
        }, 60000); // 60000 milliseconds = 1 minute
        
        // Refresh every 10 seconds
        </script>
       
    <script>
        function toggleCustomDeviceInput() {
            var deviceSelect = document.getElementById('device');
            var customInputDiv = document.getElementById('custom-device-input');
            
            if (deviceSelect.value === 'custom') {
                customInputDiv.style.display = 'block'; // Show textbox
            } else {
                customInputDiv.style.display = 'none'; // Hide textbox
            }
        }

        function setCustomDeviceValue() {
            var customInput = document.getElementById('custom_device');
            var deviceSelect = document.getElementById('device');

            if (deviceSelect.value === 'custom') {
                // Create a new option element
                var newOption = document.createElement('option');
                newOption.value = customInput.value; // Set the value of the new option
                newOption.text = customInput.value; // Set the display text of the new option

                // Append the new option to the select element
                deviceSelect.appendChild(newOption);

                // Select the new option
                deviceSelect.value = customInput.value; 
            }
        }

        document.getElementById('patientSearch').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const options = document.querySelectorAll('#patient_id option');

            options.forEach(option => {
                if (option.textContent.toLowerCase().includes(searchValue)) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>