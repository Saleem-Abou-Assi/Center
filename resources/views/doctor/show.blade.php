<!DOCTYPE html>
<html>
<head>
@include('layouts.navigation')
<link rel="stylesheet" href="{{ asset(path: 'css/doctor.css') }}">
    <title>Doctor Management</title>
    
    
</head>
<body>
<div class="show-head">
<div class="page-title1"><h1>Doctor Details</h1></div>
<div class="ul">
<ul>
    <li data-label="Name:">{{ $doctor->name }}</li>
    <li data-label="Phone:">{{ $doctor->phone }}</li>
    <li data-label="Address:">{{ $doctor->address }}</li>
    <li data-label="Specialization:">{{ $doctor->specialization }}</li>
    <li data-label="Department:">{{$doctor->Dept->title}}</li>
</ul>
</div>
</div>
    <div class="container">
       
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th>Department  </th>
                <th>Patient Name</th>
                <th>Check In Type</th>
                <th>Given Cure</th>
                <th>Tools</th>
                {{-- <th>Doctor Name__</th> --}}
                <th>Total Cost</th>
                {{-- <th>Status</th> --}}
                <th>Bill Details</th>
            </tr>
            @foreach ($doctor->APD as $apd)
            </thead>
           <tbody>
            <tr>
                <td>{{$doctor->Dept->title  }}</td>
                <td>{{$apd->patient_name }}</td>
                <td>{{$apd->check_in_type }}</td> 
                <td>{{$apd->given_cure }}</td>
                <td>{{$apd->tools }}</td>
            
                <td>{{$apd->full_cost}}</td>
                <td><a href="{{ route('accounter.index', $apd->id) }}" class="action-btn">Show</a>   </td>
                                     

            </tr>
            @endforeach 
    

          
            <tr>

            </tr>

            </tbody>
        </table>
        </div>
        <div class="boton">
        <a href="{{ route('doctor.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
    </div>
</body>
</html>