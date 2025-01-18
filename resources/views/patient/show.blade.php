<!DOCTYPE html>
<html lang="ar">

<head>
    <link rel="stylesheet" href="{{ asset(path: 'css/showPatiant.css') }}">
    <title>إدارة المرضى</title>
    @include('layouts.navigation')
</head>

<body>
    <div class="container">
        <h1>تفاصيل المريض</h1>
        <br>
       
        
        <div class="pi-con">
            <div class="patient-image">
                @if ($patient->profileImagePath)
                <img src="{{ asset('storage/'.$patient->profileImagePath) }}" alt="صورة المريض" >
                @else
                <p>لا توجد صورة متوفرة</p>
                @endif
                </div>
            </div>
        </div>
        <div class="lists-container">
          
            <ul class="ul">
                <li data-label="الاسم"><span>{{ $patient->name }}</span></li>
                <li data-label="الرقم"><span>{{ $patient->phone }}</span></li>
                <li data-label="العنوان"><span>{{ $patient->address }}</span></li>
                <li data-label="الجنس"><span>{{ $patient->Gender }}</span></li>
                <li data-label="العمر"><span>{{ $patient->age }}</span></li>
                <li data-label="الحالة الاجتماعية"><span>{{ $patient->relation }}</span></li>
                <li data-label="عدد الأطفال"><span>{{ $patient->childerCount }}</span></li>
            </ul>
            <ul class="ul">
                <li data-label="مدخن"><span>@if ($patient->smooking == 1)
                        نعم
                        @else{
                        لا
                        }
                        @endif</span></li>
                <li data-label="عمليات سابقة"><span>{{ $patient->oldSurgery }}</span></li>
                <li data-label="حساسية"><span>{{ $patient->alirgy }}</span></li>
                <li data-label="مرض مزمن"><span>{{ $patient->disease }}</span></li>
                <li data-label="الحمية الغذائية"><span>{{ $patient->dite }}</span></li>
                <li data-label="علاج متبع"><span>{{ $patient->permenantCure }}</span></li>
                <li data-label="عمليات تجميل سابقة"><span>{{ $patient->Cosmetic }}</span></li>
            </ul>

        </div>

        <div class="table-container1">
            <h3>تفاصيل إضافية</h3>
            <table>
                <tr>
                    <th>اسم الحقل</th>
                    <th>محتوى الحقل</th>
                </tr>
                @if ($patient->Field)
                @foreach ($patient->Field as $field)
                <tr>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->value }}</td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
        <div class="container2">
            <h3>معايانات مرضية</h3>
            <table class="table-container" >
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>القسم</th>
                        <th>المعالج</th>
                        <th>الشكوى </th>
                        <th>الوصف</th>
                        <th>التاريخ</th>
                        <th>تفاصيل</th>
                    </tr>
                </thead>
                @for ($i = 0; $i < count($patient->Dept); $i++)

                    <tr data-dept-operation-id="{{ $apds[$i]->PD_id }}" class="dept-operation-row">
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $patient->Dept[$i]->title }}</td>
                        <td>{{ $patient->Dept[$i]->pivot->doctor_name }}</td>
                        <td>{{ $patient->Dept[$i]->pivot->illness }}</td>
                        <td>{{ $patient->Dept[$i]->pivot->description }}</td>
                        <td>{{ $patient->Dept[$i]->created_at }}</td>
                        <td><a href="{{ route('accounter.index', $i+1) }}" class="action-btn">Show</a></td>
                    </tr>
                    @endfor
            </table>
            <br>
            <br>
            <h3>معايانات الليزر</h3>
            <table class="table-container">
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>اسم الدكتور</th>
                    
                        <th>تفاصيل</th>
                    </tr>
                </thead>
                @for ($i = 0; $i < count($patient->Lazer); $i++)
                    <tr data-laser-operation-id="{{ $patient->Lazer[$i]->id }}" class="laser-operation-row">
                        <td>{{$i + 1}}</td>
                        <td>{{$patient->Lazer[$i]->doctor->user->name}}</td>
                        {{-- @if($patient->Lazer[$i]->lazer_price)
                        <td>{{$patient->Lazer[$i]->lazer_price}} </td>
                        @else 
                        <td></td>
                        @endif
                        <td>{{$patient->Lazer[$i]->real_price}} </td> --}}
                        <td><a href="{{ route('lazer.show', $patient->lazer[$i]->id) }}" class="action-btn">تفاصيل</a>
                        <a href="{{ route('lazer.edit', $patient->lazer[$i]->id) }}" class="action-btn">تعديل</a></td>

                    </tr>
                    @endfor
            </table>
            <br>
            <button onclick="window.location='{{ route('reports.patient', $patient->id) }}'" class="add-btn">تصدير التقرير PDF</button>
            <div class="boton">
                <a href="{{ route('patient.index') }}" class="custom-btn btn-2">Go Back</a>
            </div>
        </div>

        <div>

        </div>

        <!-- Hidden iframe for printing -->
        <iframe id="printFrame" style="display: none;"></iframe>
    </div>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            let highlightOperationId = urlParams.get('highlight_operation');
            const operationType = urlParams.get('operation_type');

            // Log the highlight operation ID and type  
            console.log('Highlight Operation ID:', highlightOperationId);
            console.log('Operation Type:', operationType);

            // Ensure highlightOperationId is treated as a string  
            highlightOperationId = String(highlightOperationId).trim();

            // Log all department operation IDs  
            document.querySelectorAll('tr[data-dept-operation-id]').forEach(row => {
                console.log('Department Operation ID:', row.getAttribute('data-dept-operation-id'));
            });

            if (highlightOperationId && operationType) {
                let operationRow;

                if (operationType === 'patient_dept') {
                    operationRow = document.querySelector(`tr[data-dept-operation-id="${highlightOperationId}"]`);
                } else if (operationType === 'lazer') {
                    operationRow = document.querySelector(`tr[data-laser-operation-id="${highlightOperationId}"]`);
                }

                // Log output to help with debugging  
                console.log('Operation Row:', operationRow);
                if (operationRow) {
                    operationRow.classList.add('highlighted-operation');
                    operationRow.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                } else {
                    console.log('No corresponding row found for ID:', highlightOperationId);
                }
            }
        });

        function printPatientDeptReport() {
            const patientId = {{ $patient->id }};
            const printFrame = document.getElementById('printFrame');
            printFrame.src = `/report/patientDept/print/${patientId}`; // Adjust the route as necessary
            printFrame.onload = function() {
                printFrame.contentWindow.print();
            };
        }

        function printLazerReport() {
            const patientId = {{ $patient->id }};
            const printFrame = document.getElementById('printFrame');
            printFrame.src = `/report/lazer/print/${patientId}`; // Adjust the route as necessary
            printFrame.onload = function() {
                printFrame.contentWindow.print();
            };
        }
    </script>
    <script src="{{ asset('js/report-generator.js') }}"></script>
</body>

</html>