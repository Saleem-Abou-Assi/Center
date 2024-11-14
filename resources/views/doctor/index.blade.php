<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Doctor Management</title>
    @include('layouts.navigation')
</head>
<body>
    <div class="container">
        <h1>Doctors</h1>

        <div class="table-container">  
    <table>  
        <thead>  
            <tr>  
                <th>ID</th>  
                <th>Name</th>  
                <th>Phone</th>  
                <th>Address</th>  
                <th>Specialization</th>  
                <th>Created At</th>  
                <th>Updated At</th>  
                <th>Actions</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach ($doctors as $doctor)  
                <tr>  
                    <td>{{ $doctor->id }}</td>  
                    <td>{{ $doctor->name }}</td>  
                    <td>{{ $doctor->phone }}</td>  
                    <td>{{ $doctor->address }}</td>  
                    <td>{{ $doctor->specialization }}</td>  
                    <td>{{ $doctor->created_at }}</td>  
                    <td>{{ $doctor->updated_at }}</td>  
                    <td>  
                        <a href="{{ route('doctor.edit', $doctor->id) }}">Edit</a>  
                        <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" style="display:inline;">  
                            @csrf  
                            @method('DELETE')  
                            <button type="submit">Delete</button>  
                        </form>  
                        <a href="{{ route('doctor.show', $doctor->id) }}">Show</a>  
                    </td>  
                </tr>  
            @endforeach  
        </tbody>  
    </table>  
</div>

        <a href="{{ route('doctor.create') }}">Add doctor</a>
    </div>
</body>
</html>