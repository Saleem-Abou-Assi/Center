<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Book Management</title>
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
        <h1>Booking</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add your patient data rows here -->
                @foreach ($books as $book)

                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->patient_name }}</td>
                        <td>{{ $book->phone }}</td>
                        <td>{{ $dept }}</td>
                        <td>{{ $book->doctor_id }}</td>
                        <td>{{ $book->bookDate }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td>{{ $book->updated_at }}</td>
                        <td>
                            <a href="{{ route('book.edit', $book->id) }}">Edit</a>
                        
                                <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>                   

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('book.create') }}">Add book</a>
    </div>
</body>
</html>