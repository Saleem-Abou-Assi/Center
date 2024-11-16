<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <title>Patient Management</title>
    @include('layouts.navigation')
</head>
<body>
    <div class="C-container">
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
                <div  class="select-box">
                <label for="gender">Gender</label>
                <select id="gender" required name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ isset($patient) && $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ isset($patient) && $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                </div>
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