<!DOCTYPE html>
<html>
<head>
    
    <title>Doctor Management</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    @include('layouts.navigation')
</head>
<body>
    <div class="C-container">
        <h1>{{ isset($doctor) ? 'Edit Doctor' : 'Add Doctor' }}</h1>

        <form action="{{ isset($doctor) ? route('doctor.update', $doctor->id) : route('doctor.store') }}" method="POST">
            @csrf
            @if (isset($doctor))
                @method('PUT')
            @endif
        
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required value="{{ isset($doctor) ? $doctor->name : '' }}">
            </div>
        
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required value="{{ isset($doctor) ? $doctor->phone : '' }}">
            </div>
        
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required value="{{ isset($doctor) ? $doctor->address : '' }}">
            </div>
        
        
            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" required id="specialization" name="specialization" value="{{ isset($doctor) ? $doctor->specialization : '' }}">
            </div>

            <div class="form-group">
                <label for="department">Department Title</label>
                <select id="department" required name="department" >
                    <option value="">Select Department</option>
                    @foreach ($depts as $dept)
                    <option value="{{$dept->id}}">{{$dept->title}}</option>

                    @endforeach
                </select>
            </div>

            <button type="submit">{{ isset($doctor) ? 'Update' : 'Create' }}</button>
        </form>

        <a href="{{ route('doctor.index') }}">Back to Patients</a>
    </div>
</body>
</html>