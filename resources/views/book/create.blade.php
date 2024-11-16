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
        <h1>{{ isset($book) ? 'Edit book' : 'Add book' }}</h1>

        <form action="{{ isset($book) ? route('book.update', $book->id) : route('book.store') }}" method="POST">
            @csrf
            @if (isset($book))
                @method('PUT')
            @endif
        
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" id="patient_name" name="patient_name" required value="{{ isset($book) ? $book->patient_name : '' }}">
            </div>
        
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required value="{{ isset($book) ? $book->phone : '' }}">
            </div>
        
            
            <div class="form-group">
                <label for="dept_id">Department Title</label>
                <select id="dept_id" required name="dept_id">
                    <option value="">Select Department</option>
                    @foreach ($depts as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->title }}</option>
                    @endforeach
                </select>
            </div>
            

            <div class="form-group">
                <label for="doctor_id">Doctor Name</label>
                <select id="doctor_id" required name="doctor_id" >
                    <option value="">Select doctor</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>

                    @endforeach
                </select>
            </div>
        
           
            <div> <label for="bookDate">Date & Time</label>
            <input type="datetime-local" required id="bookDate" name="bookDate" value="{{ isset($book) ? $book->bookDate : '' }}">
         </div>
        
            <button type="submit">{{ isset($book) ? 'Update' : 'Create' }}</button>
        </form>

        <a href="{{ route('book.index') }}">Back to books</a>
    </div>
</body>
</html>