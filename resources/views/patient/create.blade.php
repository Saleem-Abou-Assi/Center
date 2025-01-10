<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>إدارة المرضى</title>
    @include('layouts.navigation')
</head>

<body>
    <div class="C-container">
        <h1>{{ isset($patient) ? 'عدل على مريض' : 'أضف مريضاً' }}</h1>
        <div class="form-container1">
            <form action="{{ isset($patient) ? route('patient.update', $patient->id) : route('patient.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($patient))
                @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">الاسم</label>
                    <input type="text" id="name" name="name" required value="{{ isset($patient) ? $patient->name : '' }}" autofocus>
                </div>

                <div class="form-group">
                    <label for="phone">الرقم</label>
                    <input type="text" id="phone" name="phone" required value="{{ isset($patient) ? $patient->phone : '' }}">
                </div>

                <div class="form-group">
                    <label for="address">العنوان</label>
                    <input type="text" id="address" name="address" required value="{{ isset($patient) ? $patient->address : '' }}">
                </div>

                <div class="form-group">
                    <div class="select-box">
                        <label for="gender">الجنس</label>
                        <select id="gender" required name="gender">
                            <option value="">حدد الجنس</option>
                            <option value="male" {{ isset($patient) && $patient->gender == 'male' ? 'selected' : '' }}>ذكر</option>
                            <option value="female" {{ isset($patient) && $patient->gender == 'female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="age">العمر</label>
                    <input type="number" required id="age" name="age" value="{{ isset($patient) ? $patient->age : '' }}">
                </div>

                <div class="form-group">
                    <label for="job">الوظيفة</label>
                    <input type="text" id="job" name="job" required value="{{ isset($patient) ? $patient->job : '' }}">
                </div>
                <div class="form-group">
                    <div class="select-box">
                        <label for="relation">الحالة الاجتماعية</label>
                        <select id="relation" required name="relation">
                            <option value="">اختر حالة</option>
                            <option value="married" {{ isset($patient) && $patient->relation == 'married' ? 'selected' : '' }}>متزوج\ة</option>
                            <option value="single" {{ isset($patient) && $patient->relation == 'single' ? 'selected' : '' }}>عازب\ة</option>
                            <option value="divorced" {{ isset($patient) && $patient->relation == 'divorced' ? 'selected' : '' }}>مطلق\ة</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="children">عدد الأطفال</label>
                        <input type="number" id="children" name="children" value="{{ isset($patient) ? $patient->children : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="smooking">مدخن</label>
                        <input type="checkbox" id="smooking" name="smooking" value="1" {{ isset($patient) && $patient->smooking ? 'checked' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="oldSurgery">عمليات سابقة</label>
                        <input type="text" id="oldSurgery" name="oldSurgery" value="{{ isset($patient) ? $patient->oldSurgery : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="alirgy">حساسية</label>
                        <input type="text" id="alirgy" name="alirgy" value="{{ isset($patient) ? $patient->alirgy : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="disease">مرض مزمن</label>
                        <input type="text" id="disease" name="disease" value="{{ isset($patient) ? $patient->disease : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="dite">حمية غذائية</label>
                        <input type="text" id="dite" name="dite" value="{{ isset($patient) ? $patient->dite : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="permenantCure">العلاج المتبع</label>
                        <input type="text" id="permenantCure" name="permenantCure" value="{{ isset($patient) ? $patient->permenantCure : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="cosmetic">عمليات تجميل سابقة</label>
                        <input type="text" id="cosmetic" name="cosmetic" value="{{ isset($patient) ? $patient->cosmetic : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="currentDisease">الشكوى حالي</label>
                        <input type="text" id="currentDisease" name="currentDisease" value="{{ isset($patient) ? $patient->currentDisease : '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">تحميل صورة شخصية</label>
                    <input type="file" id="image" name="profile-image" class="form-control" accept="image/*">
                </div>
                <div class="sep">
                    <hr class="separator">
                </div>
                <br>

                <button type="button" id="addRowBtn" class="add-btn"><span>أضف تفاصيلاّ</span></button>

                <table id="dynamicTable"> 
                    <thead>

                    </thead>
                    <tbody>
                        <!-- Rows will be dynamically added here -->
                    </tbody>
                </table>
                <br>
                <button type="submit" class="cta"><span>{{ isset($patient) ? 'عدّل' : 'أنشئ' }}</span>

                    <svg width="15px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
                <br>
            </form>
        </div>
        <div class="boton">
            <a href="{{ route('patient.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
    </div>


    <script>
        document.getElementById('addRowBtn').addEventListener('click', function() {
            // Get the table body element  
            var tableBody = document.getElementById('dynamicTable').getElementsByTagName('tbody')[0];

            // Create new row and cells  
            var newRow = document.createElement('tr');
            var fieldNameCell = document.createElement('td');
            var fieldValueCell = document.createElement('td');
            var actionCell = document.createElement('td');
            fieldNameCell.className = 'inp';
            fieldValueCell.className = 'inp1';

            // Create input fields for field name and value  
            var fieldNameInput = document.createElement('input');
            fieldNameInput.setAttribute('type', 'text');
            fieldNameInput.setAttribute('name', 'dynamicFieldName[]');
            fieldNameInput.setAttribute('placeholder', 'عنوان الحقل'); // Add placeholder text 

            var fieldValueInput = document.createElement('input');
            fieldValueInput.setAttribute('type', 'text');
            fieldValueInput.setAttribute('name', 'dynamicFieldValue[]');
            fieldValueInput.setAttribute('placeholder', 'محتوى الحقل'); // Add placeholder text 
            // Append input fields to their respective cells  
            fieldNameCell.appendChild(fieldNameInput);
            fieldValueCell.appendChild(fieldValueInput);

            // Create delete button  
            var deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'Delete';
            deleteBtn.className = 'action-btn'; // Set class for the button  
            deleteBtn.addEventListener('click', function() {
                // Remove the row when the delete button is clicked  
                newRow.remove();
            });

            // Append the delete button to the action cell  
            actionCell.appendChild(deleteBtn);
            actionCell.className = 'action-td'; // Set class for the td  

            // Append cells to the new row  
            newRow.appendChild(fieldNameCell);
            newRow.appendChild(fieldValueCell);
            newRow.appendChild(actionCell);

            // Append the new row to the table body  
            tableBody.appendChild(newRow);
        });
    </script>
</body>

</html>