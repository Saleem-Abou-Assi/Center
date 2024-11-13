<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Doctor Management</title>
    <style>
        /* Add your CSS styling here */
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Doctors</h1>

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
                <!-- Add your patient data rows here -->
                @foreach ($doctors as $doctor)
                @php
                   
                @endphp
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
                                <form action="{{ route('doctor.destroy', $doctor->id) }}" method="POST">
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

        <a href="{{ route('doctor.create') }}">Add doctor</a>
    </div>
</body>
</html>