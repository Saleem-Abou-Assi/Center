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
        
            <button type="submit">{{ isset($patient) ? 'Update' : 'Create' }}</button>
        </form>

        <a href="{{ route('patient.index') }}">Back to Patients</a>
    </div>
</body>
</html>