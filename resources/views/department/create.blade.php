<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Department Management</title>
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
        <h1>{{ isset($department) ? 'Edit department' : 'Add department' }}</h1>

        <form action="{{ isset($department) ? route('department.update', $department->id) : route('department.store') }}" method="POST">
            @csrf
            @if (isset($department))
                @method('PUT')
            @endif
        
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required value="{{ isset($department) ? $department->name : '' }}">
            </div>
        
        
            <button type="submit">{{ isset($department) ? 'Update' : 'Create' }}</button>
        </form>

        <a href="{{ route('department.index') }}">Back to departments</a>
    </div>
</body>
</html>