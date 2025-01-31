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
                            <option value="{{isset($patient) ? $patient->Gender : ""}}">{{isset($patient) ? $patient->Gender : "حدد الجنس"}}</option>
                            <option value="male" {{ isset($patient) && $patient->gender == 'male' ? 'selected' : '' }}>ذكر</option>
                            <option value="female" {{ isset($patient) && $patient->gender == 'female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="age" >المواليد</label>
                    <input type="date" required id="age" name="age" value="{{ isset($patient) ? $patient->age : '' }}">
                </div>

                <div class="form-group">
                    <label for="AGE">العمر</label>
                    <span id="AGE" ></span>
                </div>

                <div class="form-group">
                    <label for="job">الوظيفة</label>
                    <input type="text" id="job" name="job" required value="{{ isset($patient) ? $patient->job : '' }}">
                </div>
                <div class="form-group">
                    <div class="select-box">
                        <label for="relation">الحالة الاجتماعية</label>
                        <select id="relation" required name="relation">
                            <option value="{{isset($patient) ? $patient->relation : ""}}">اختر حالة</option>
                            <option value="متزوج\ة" {{ isset($patient) && $patient->relation == 'married' ? 'selected' : '' }}>متزوج\ة</option>
                            <option value="مخطوب\ة" {{ isset($patient) && $patient->relation == 'divorced' ? 'selected' : '' }}>مخطوب\ة</option>
                            <option value="عازب\ة" {{ isset($patient) && $patient->relation == 'single' ? 'selected' : '' }}>عازب\ة</option>
                            <option value="مطلق\ة" {{ isset($patient) && $patient->relation == 'divorced' ? 'selected' : '' }}>مطلق\ة</option>
                     
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
                    <div class="kok">
                        <div class="bok">
                            <label for="profile-image">تحميل صورة شخصية</label>
                            <input type="file" id="profile-image" name="profile-image" class="file-input" accept="image/*" onchange="updateFileName()">
                            <label for="profile-image" class="custom-file-upload">
                                <span class="fa fa-upload" style="font-size:24px"></span>
                            </label>
                            <button type="button" id="open-webcam" class="custom-file-upload">
                                <span class="fa fa-camera" style="font-size:24px"></span> فتح الكاميرا
                            </button>
                        </div>
                        <span id="file-name" class="file-name"></span>
                    </div>
                    <video id="video" width="320" height="240" style="display:none;"></video>
                    <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                    <button id="capture" style="display:none;">التقاط الصورة</button>
                    <img id="captured-image" src="" alt="Captured Image" style="display:none;"/>
                </div>
                <div class="sep">
                    <hr class="separator">
                </div>
                <br>

                <button type="button" id="addRowBtn" class="add-btn"><span>أضف تفاصيلاّ</span></button>

                <table id="dynamicTable"> 
                    <thead>
                        <tr>
                            <th>اسم الحقل</th>
                            <th>محتوى الحقل</th>
                            <th>إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($patient) && $patient->Field)
                            @foreach($patient->Field as $field)
                                <tr>
                                    <td>
                                        <input type="text" name="dynamicFieldName[]" value="{{ $field->name }}" placeholder="عنوان الحقل">
                                    </td>
                                    <td>
                                        <input type="text" name="dynamicFieldValue[]" value="{{ $field->value }}" placeholder="محتوى الحقل">
                                    </td>
                                    <td>
                                        <button type="button" class="delete-btn">حذف</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <br>
                <button type="submit" class="save-btn">أنشئ</button>
                <br>
            </form>
        </div>
        <div class="boton">
       
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    
        </div>
    </div>
    <script>
        save_btn=document.querySelector(".save-btn");

save_btn.onclick= function(){
    this.innerHTML="<div class=loader></div>";
  
}
    </script>
    <script>
    const openWebcamButton = document.getElementById('open-webcam');
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const capturedImage = document.getElementById('captured-image');

    openWebcamButton.addEventListener('click', async () => {
        // Request access to the webcam
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
        video.style.display = 'block'; // Show the video element
        video.play();

        // Show the capture button
        captureButton.style.display = 'block';
    });

    captureButton.addEventListener('click', () => {
        // Draw the video frame to the canvas
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Get the image data from the canvas
        const imageData = canvas.toDataURL('image/png');
        capturedImage.src = imageData; // Set the captured image source
        capturedImage.style.display = 'block'; // Show the captured image

        // Optionally, you can also set the captured image to the file input
        const fileName = 'captured-image.png';
        const blob = dataURLtoBlob(imageData);
        const file = new File([blob], fileName, { type: 'image/png' });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        document.getElementById('profile-image').files = dataTransfer.files;

        // Stop the video stream
        const stream = video.srcObject;
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
        video.style.display = 'none'; // Hide the video element
        captureButton.style.display = 'none'; // Hide the capture button
    });

    function dataURLtoBlob(dataURL) {
        const byteString = atob(dataURL.split(',')[1]);
        const mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
        const ab = new ArrayBuffer(byteString.length);
        const ia = new Uint8Array(ab);
        for (let i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: mimeString });
    }

    function updateFileName() {
        const fileInput = document.getElementById('profile-image');
        const fileNameDisplay = document.getElementById('file-name');
        fileNameDisplay.textContent = fileInput.files[0] ? fileInput.files[0].name : '';
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ageInput = document.getElementById("age");
        const ageDisplay = document.getElementById("AGE");

        ageInput.addEventListener("change", function() {
            const birthDate = new Date(ageInput.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            ageDisplay.textContent = age; // Display the calculated age
        });
    });
</script>
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
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            // Get the submit button
            const submitButton = this.querySelector('button[type="submit"]');

            // Add loading class to the button
            submitButton.classList.add('loading');
            submitButton.disabled = true; // Optionally disable the button to prevent multiple submissions

            // Optionally, you can show a loading message or spinner here
        });
    </script>
</body>

</html>