<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Doctor Management</title>
    
    
</head>
<body>
    <div class="container">
        <h1>Doctor Details</h1>

        <ul>
            <li>Name: {{ $doctor->name }}</li>
            <li>Phone: {{ $doctor->phone }}</li>
            <li>Address: {{ $doctor->address }}</li>
            <li>specialization: {{ $doctor->specialization }}</li>
            <li>Department Name: {{$dept->title}}</li>
        </ul>

        {{-- <table>
            <tr>
                <th>Department__</th>
                <th>Illness__</th>
                <th>Description__</th>
                <th>Cure__</th>
                <th>Doctor Name__</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Bill Details</th>
            </tr>
            @for ($i = 0; $i < count($depts); $i++)
            
            <tr>
                <td>{{$depts[$i]->title  }}</td>
                <td>{{$depts[$i]->pivot->illness }}</td> 
                <td>{{$depts[$i]->pivot->description }}</td>
                <td>{{$depts[$i]->pivot->cure }}</td>
                <td>{{$depts[$i]->pivot->doctor_name }}</td>
                <td>{{$apds[$i]->full_cost}}</td>
                <td>{{$apds[$i]->status}}</td>
                <td><a href="{{ route('accounter.index', $apds[$i]->id) }}">Show</a>   </td>
                                     

            </tr>
            @endfor
    

          
            <tr>

            </tr>


        </table> --}}

        <a href="{{ route('doctor.index') }}">Back to Doctors</a>    </div>
</body>
</html>