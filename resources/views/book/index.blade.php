<!DOCTYPE html>
<html>
<head>
@include('layouts.navigation')
<link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
    <title>Book Management</title>
    
</head>
<body>
    <div class="page-title"><h1>Booking</h1></div>
    <div class="all">
    <div class="container">
    <a href="{{ route('book.create') }}" class="cta"><span>Add book</span>
    <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg>
    </a>
    <br>
    <br>
      

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
                    <!-- <th>Updated At</th> -->
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
                  
                        <td>{{ $book->doctor_id }}</td>
                        <td>{{ $book->bookDate }}</td>
                        <td>{{ $book->created_at }}</td>
                        <td>{{ $book->updated_at }}</td>
                        <td class="action-td">
                            <a href="{{ route('book.edit', $book->id) }}" class="action-btn">Edit</a>
                        
                                <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn">Delete</button>
                                </form>                   

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        
    </div>
    </div>
</body>
</html>