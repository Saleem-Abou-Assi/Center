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
        <h1>Patients</h1>

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
                        <td>
                            <a href="{{ route('patient.edit', $patient->id) }}">Edit</a>
                        
                                <form action="{{ route('patient.destroy', $patient->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                                <a href="{{ route('patient.show', $patient->id) }}">Show</a>                        

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('patient.create') }}">Add patient</a>
    </div>
</body>
</html>