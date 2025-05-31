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
                    <img src="{{ asset('storage/' . $patient->profileImagePath) }}" alt="صورة المريض">
                @else
                    <p>لا توجد صورة متوفرة</p>
                @endif
            </div>
        </div>
    </div>
    <div class="lists-container">

        <ul class="ul ul1">
            <li data-label="الاسم"><span>{{ $patient->name }}</span></li>
            <li data-label="الرقم"><span>{{ $patient->phone }}</span></li>
            <li data-label="العنوان"><span>{{ $patient->address }}</span></li>
            <li data-label="الجنس"><span>{{ $patient->Gender }}</span></li>
            <li data-label="المواليد"><span>{{ $patient->age }}</span></li>
            <li data-label="العمر"><span id="AGE"></span></li>
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
        <div class="boton">
            <button onclick="window.history.back();" class="custom-btn btn-2"><span class="fa fa-arrow-left"
                    style="font-size:25px"></span></button>
        </div>
        <table class="table-container">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>القسم</th>
                    <th>المعالج</th>
                    <th>الشكوى </th>
                    <th>الوصف</th>
                    <th>نوع المعاينة</th>
                    <th>الأدوات المستخدمة</th>
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
                    <td>{{ $patient->Dept[$i]->pivot->type }}</td>
                    <td>
                        @if($apds[$i]->storage->count() > 0)
                            <ul>
                                @foreach($apds[$i]->storage as $storage)
                                    <li>{{ $storage->item }} ({{ $storage->pivot->quantity }})</li>
                                @endforeach
                            </ul>
                        @else
                            لا توجد أدوات
                        @endif
                    </td>
                    <td>{{ $patient->Dept[$i]->pivot->created_at }}</td>
                    <td class="action-td">
                        <a href="{{ route('accounter.index', $apds[$i]->PD_id) }}"
                            class="action-btn">Show</a>
                        <a href="{{ route('patientDept.edit', $patient->Dept[$i]->pivot->id) }}" class="action-btn">Edit</a>
                        <form id="deleteForm" action="{{ route('Dept.destroy', $patient->Dept[$i]->pivot->id) }}"
                            method="POST" onsubmit="return confirmCustom()">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="action-btn">إزالة</button>
                        </form>
                    </td>
                </tr>
            @endfor
        </table>
        <br>
        <br>
        <h3>معايانات الليزر</h3>
        <table class="table-container lazer-details-table">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>التاريخ</th>
                   
                    <th>التكلفة</th>
                    <th>تفاصيل الجلسة</th>
                    <th>عمليات</th>
                </tr>
            </thead>
            @foreach($patient->Lazer as $i => $lazer)
                <tr data-laser-operation-id="{{ $lazer->id }}" class="laser-operation-row">
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $lazer->created_at->format('Y-m-d') }}</td>
                
                    <td>
                        <div>أساسي: {{ $lazer->price }} </div>
                        <div>فعلي: {{ $lazer->real_price }} </div>
                    </td>
                    <td>
                        <div class="lazer-session-details">
                            <ul class="lazer-details-list">
                                @foreach($lazer->Details as $detail) 
                                    <li>
                                        <span class="detail-label">المعالج:</span>
                                        <span class="detail-value">{{ $detail->Doctor->user->name }}</span>
                                        <span class="detail-label">الجهاز:</span>
                                        <span class="detail-value">{{ $detail->device }}</span>
                                        <span class="detail-label">النقطة:</span>
                                        <span class="detail-value">{{ $detail->point }}</span>
                                        <span class="detail-label">الأشعة:</span>
                                        <span class="detail-value">{{ $detail->raysCount }}</span>
                                        <span class="detail-label">القوة:</span>
                                        <span class="detail-value">{{ $detail->power }}</span>
                                        <span class="detail-label">السرعة:</span>
                                        <span class="detail-value">{{ $detail->speed }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            @if($lazer->notes)
                                <div class="lazer-notes">
                                    <strong>ملاحظات:</strong>
                                    <p>{{ $lazer->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="action-td">
                        <a href="{{ route('lazer.show', $lazer->id) }}" class="action-btn">تفاصيل</a>
                        <a href="{{ route('lazer.edit', $lazer->id) }}" class="action-btn">تعديل</a>
                        <form id="deleteForm" action="{{ route('lazer.destroy', $lazer->id) }}" method="POST"
                            onsubmit="return confirmCustom()" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn">إزالة</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <h3>معايانات البشرة</h3>
        <table class="table-container">
            <thead>
                <tr>
                    <th>الرقم</th>
                    <th>المعالج</th>
                    <th>الحالة </th>
                    <th>التكلفة</th>
                    <th>التاريخ</th>
                    <th>تفاصيل</th>
                </tr>
            </thead>
            @for ($i = 0; $i < count($patient->skin); $i++)

                <tr data-dept-operation-id="{{ $patient->skin[$i]->id }}" class="dept-operation-row">
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $patient->skin[$i]->doctor->user->name }}</td>
                    <td>{{ $patient->skin[$i]->options }}</td>
                    <td>{{ $patient->skin[$i]->cost }}</td>
                    <td>{{ $patient->skin[$i]->created_at }}</td>
                    <td>
                        <form id="deleteForm" action="{{ route('skin.destroy', $patient->skin[$i]->id) }}" method="POST"
                            onsubmit="return confirmCustom()">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="action-btn">إزالة</button>
                        </form>
                    </td>
                </tr>
            @endfor
        </table>

        <br>

        <button onclick="window.location='{{ route('reports.patient', $patient->id) }}'" class="add-btn">تصدير التقرير
            PDF</button>

    </div>



    <!-- Hidden iframe for printing -->
    <iframe id="printFrame" style="display: none;"></iframe>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const birthDateString = "{{ $patient->age }}"; // Ensure this is a valid date string like "YYYY-MM-DD"
            const ageDisplay = document.getElementById("AGE");

            function calculateAndDisplayAge() {
                const birthDate = new Date(birthDateString);
                if (isNaN(birthDate)) {
                    console.error("Invalid date format:", birthDateString);
                    ageDisplay.textContent = "Invalid date";
                    return;
                }

                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDifference = today.getMonth() - birthDate.getMonth();

                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                ageDisplay.textContent = age; // Display the calculated age
            }

            // Call the function on page load
            calculateAndDisplayAge();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
            printFrame.onload = function () {
                printFrame.contentWindow.print();
            };
        }

        function printLazerReport() {
            const patientId = {{ $patient->id }};
            const printFrame = document.getElementById('printFrame');
            printFrame.src = `/report/lazer/print/${patientId}`; // Adjust the route as necessary
            printFrame.onload = function () {
                printFrame.contentWindow.print();
            };
        }
    </script>
    <script src="{{ asset('js/report-generator.js') }}"></script>
    <script>
        function toggleLazerDetails(lazerId) {
            const detailsRow = document.getElementById(`lazer-details-${lazerId}`);
            if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
                detailsRow.style.display = 'table-row';
            } else {
                detailsRow.style.display = 'none';
            }
        }
    </script>
    <style>
        .lazer-details-table {
            width: 100%;

            margin-bottom: 20px;
        }

        .lazer-details-table th,
        .lazer-details-table td {

            padding: 8px;
            text-align: left;
        }

        .lazer-details-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .lazer-details-list li {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 5px;
            font-size: 0.9em;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
            margin-left: 5px;
        }

        .detail-value {
            color: #333;
        }



        .lazer-notes {
            margin-top: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .action-td {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .action-btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 3px;
            text-align: center;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #45a049;
        }

        /* Delete button specific styling */
        .action-btn:last-child {
            background-color: #f44336;
        }

        .action-btn:last-child:hover {
            background-color: #d32f2f;
        }
    </style>

    <script>
        function confirmCustom() {
            return confirm('هل أنت متأكد من حذف هذه الجلسة؟');
        }
    </script>
</body>

</html>