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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 8px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h1>Patient Details</h1>

        <ul>
            <li>Name: {{ $department->title }}</li>
            
        </ul>

        <a href="{{ route('department.index') }}">Back to Departments</a>    </div>
</body>
</html>