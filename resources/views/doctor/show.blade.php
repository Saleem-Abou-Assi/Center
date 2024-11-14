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
        <h1>Doctor Details</h1>

        <ul>
            <li>Name: {{ $doctor->name }}</li>
            <li>Phone: {{ $doctor->phone }}</li>
            <li>Address: {{ $doctor->address }}</li>
            <li>specialization: {{ $doctor->specialization }}</li>
            <li>Department Name: {{$doctor->Dept->title}}</li>
        </ul>

        <table>
            <tr>
                <th>Department__</th>
                <th>Patient Name</th>
                <th>Check In Type__</th>
                <th>Given Cure__</th>
                <th>Tools__</th>
                {{-- <th>Doctor Name__</th> --}}
                <th>Total Cost</th>
                {{-- <th>Status</th> --}}
                <th>Bill Details</th>
            </tr>
            @foreach ($doctor->APD as $apd)
    
           
            <tr>
                <td>{{$doctor->Dept->title  }}</td>
                <td>{{$apd->patient_name }}</td>
                <td>{{$apd->check_in_type }}</td> 
                <td>{{$apd->given_cure }}</td>
                <td>{{$apd->tools }}</td>
            
                <td>{{$apd->full_cost}}</td>
                <td><a href="{{ route('accounter.index', $apd->id) }}">Show</a>   </td>
                                     

            </tr>
            @endforeach 
    

          
            <tr>

            </tr>


        </table>

        <a href="{{ route('doctor.index') }}">Back to Doctors</a>    </div>
</body>
</html>