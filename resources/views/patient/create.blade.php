<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Patient Management</title>
    <style>
        /* Add your CSS styling here */
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        form {
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ isset($patient) ? 'Edit Patient' : 'Add Patient' }}</h1>

        <form action="{{ isset($patient) ? route('patient.update', $patient->id) : route('patient.store') }}" method="POST">
            @csrf
            @if (isset($patient))
                @method('PUT')
            @endif
        
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required value="{{ isset($patient) ? $patient->name : '' }}">
            </div>
        
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required value="{{ isset($patient) ? $patient->phone : '' }}">
            </div>
        
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required value="{{ isset($patient) ? $patient->address : '' }}">
            </div>
        
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" required name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ isset($patient) && $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ isset($patient) && $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
        
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" required id="age" name="age" value="{{ isset($patient) ? $patient->age : '' }}">
            </div>
        
            <div class="form-group">
                <label for="job">Job</label>
                <input type="text" id="job" name="job" required value="{{ isset($patient) ? $patient->job : '' }}">
                <div class="form-group">
                    <label for="relation">Relation</label>
                    <select id="relation" required name="relation">
                        <option value="">Select Gender</option>
                        <option value="married" {{ isset($patient) && $patient->relation == 'married' ? 'selected' : '' }}>متزوج\ة</option>
                        <option value="single" {{ isset($patient) && $patient->relation == 'single' ? 'selected' : '' }}>عازب\ة</option>
                        <option value="divorced" {{ isset($patient) && $patient->relation == 'divorced' ? 'selected' : '' }}>مطلق\ة</option>
                        
                    </select>
                </div> <div class="form-group">
                <label for="children">Childred</label>
                <input type="number" id="children" name="children"  value="{{ isset($patient) ? $patient->children : '' }}">
            </div> <div class="form-group">
                <label for="smooking">Smooking</label>
                <input type="checkbox" id="smooking" name="smooking"  value="{{ isset($patient) ? $patient->smooking : '' }}">
            </div> <div class="form-group">
                <label for="oldSurgery">Old Surgey</label>
                <input type="text" id="oldSergury" name="oldSergury"  value="{{ isset($patient) ? $patient->oldSergury : '' }}">
            </div> <div class="form-group">
                <label for="alirgy">alirgy</label>
                <input type="text" id="alirgy" name="alirgy"  value="{{ isset($patient) ? $patient->alirgy : '' }}">
            </div> <div class="form-group">
                <label for="disease">Disease</label>
                <input type="text" id="disease" name="disease"  value="{{ isset($patient) ? $patient->disease : '' }}">
            </div> <div class="form-group">
                <label for="dite">Dite</label>
                <input type="text" id="dite" name="dite"  value="{{ isset($patient) ? $patient->dite : '' }}">
            </div> <div class="form-group">
                <label for="permenantCure">Permenant Cure</label>
                <input type="text" id="permenantCure" name="permenantCure"  value="{{ isset($patient) ? $patient->permenantCure : '' }}">
            </div> <div class="form-group">
                <label for="cosmetic">Cosmetic</label>
                <input type="text" id="cosmetic" name="cosmetic"  value="{{ isset($patient) ? $patient->cosmetic : '' }}">
            </div> <div class="form-group">
                <label for="currentDisease">Current Disease</label>
                <input type="text" id="currentDisease" name="currentDisease"  value="{{ isset($patient) ? $patient->currentDisease : '' }}">
            </div>

            <button type="button" id="addRowBtn">Add Row</button>

            <table id="dynamicTable">
                <thead>
                    <tr>
                        <th>Field Name</th>
                        <th>Field Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rows will be dynamically added here -->
                </tbody>
            </table>

            <button type="submit">{{ isset($patient) ? 'Update' : 'Create' }}</button>
        </form>

        <a href="{{ route('patient.index') }}">Back to Patients</a>
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
    
            // Create input fields for field name and value
            var fieldNameInput = document.createElement('input');
            fieldNameInput.setAttribute('type', 'text');
            fieldNameInput.setAttribute('name', 'dynamicFieldName[]');
    
            var fieldValueInput = document.createElement('input');
            fieldValueInput.setAttribute('type', 'text');
            fieldValueInput.setAttribute('name', 'dynamicFieldValue[]');
    
            // Create delete button
            var deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'Delete';
            deleteBtn.addEventListener('click', function() {
                // Remove the row when the delete button is clicked
                newRow.remove();
            });
    
            // Append cells and inputs to the row
            fieldNameCell.appendChild(fieldNameInput);
            fieldValueCell.appendChild(fieldValueInput);
            actionCell.appendChild(deleteBtn);
    
            newRow.appendChild(fieldNameCell);
            newRow.appendChild(fieldValueCell);
            newRow.appendChild(actionCell);
    
            // Append the new row to the table body
            tableBody.appendChild(newRow);
        });
    </script>
</body>
</html>