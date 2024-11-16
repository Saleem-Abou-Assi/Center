<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/patiant.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @include('layouts.navigation')
    <title>Patient Management</title>
    
</head>
<body>
    <div class="page-title"> <h1>Patients</h1></div>
    <div class="container">
    <a href="{{ route('patient.create') }}" class="cta"><span>Add patient</span>
    <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg>
    </a>
    <br>
    <br>
        <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add your patient data rows here -->
                @foreach ($patients as $patient)
                @php
                   
                @endphp
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->address }}</td>
                        <td>{{ $patient->Gender }}</td>
                        <td>{{ $patient->age }}</td>
                        <td>{{ $patient->created_at }}</td>
                        <td>{{ $patient->updated_at }}</td>
                        <td class="action-td">
                            <a href="{{ route('patient.edit', $patient->id) }}" class="action-btn">Edit</a>
                        
                                <form action="{{ route('patient.destroy', $patient->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn">Delete</button>
                                </form>
                                <a href="{{ route('patient.show', $patient->id) }}" class="action-btn">Show</a>                        

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
       
    </div>
</body>
</html>