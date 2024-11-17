<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset(path: 'css/showPatiant.css') }}">
    <title>Patient Management</title>
    @include('layouts.navigation')
   
    
</head>
<body>
    <div class="container">
        <h1>Patient Details</h1>
        <div class="lists-container">
            <ul class="ul">
                <li data-label="Name"><span>{{ $patient->name }}</span></li>
                <li data-label="Phone"><span>{{ $patient->phone }}</span></li>
                <li data-label="Address"><span>{{ $patient->address }}</span></li>
                <li data-label="Gender"><span>{{ $patient->Gender }}</span></li>
                <li data-label="Age"><span>{{ $patient->age }}</span></li>
                <li data-label="Relation"><span>{{ $patient->relation }}</span></li>
                <li data-label="Children"><span>{{ $patient->childerCount }}</span></li>
            </ul>
            <ul class="ul">
                <li data-label="Smooking"><span>{{ $patient->smooking }}</span></li>
                <li data-label="Old Surgery"><span>{{ $patient->oldSurgery }}</span></li>
                <li data-label="Alirgy"><span>{{ $patient->alirgy }}</span></li>
                <li data-label="Disease"><span>{{ $patient->disease }}</span></li>
                <li data-label="Dite"><span>{{ $patient->dite }}</span></li>
                <li data-label="Permenant Cures"><span>{{ $patient->permenantCure }}</span></li>
                <li data-label="Cosmetic"><span>{{ $patient->Cosmetic }}</span></li>
                <li data-label="Current Disease"><span>{{ $patient->CurrentDisease }}</span></li>
            </ul>
        </div>
        <div class="table-container1">
            <h3>additional Details</h3>
        <table>
            <tr>
                <th>Field Name</th>
                <th>Field Value</th>
            </tr>
            @if ($patient->Field)
            @foreach ($patient->Field as $field)
            <tr>
                <td>{{ $field->name }}</td>
                <td>{{ $field->value }}</td>
            </tr>
            @endforeach
            @endif
            
        </table>
        </div>
        <div class="container2">
        <table class="table-container">
            <thead>
            <tr>
                <th>Department</th>
                <th>Illness</th>
                <th>Description </th>
                <th>Cure</th>
                <th>Doctor Name</th>
                <th>Total Cost</th>
                <th>Status</th> 
                <th>Bill Details</th>
            </tr>
            </thead>
            @for ($i = 0; $i < count($patient->Dept); $i++)
            
            <tr>
                <td>{{$patient->Dept[$i]->title  }}</td>
                <td>{{$patient->Dept[$i]->pivot->illness }}</td> 
                <td>{{$patient->Dept[$i]->pivot->description }}</td>
                <td>{{$patient->Dept[$i]->pivot->cure }}</td>
                <td>{{$patient->Dept[$i]->pivot->doctor_name }}</td>
                <td>{{$apds[$i]->full_cost}}</td>    
                <td><a href="{{ route('accounter.index', $apds[$i]->id) }}" class="action-btn">Show</a>   </td>
                                     

            </tr>
            @endfor
    

          
            <tr>

            </tr>


        </table>
        <br>
        <br>
        <div class="boton">
        <a href="{{ route('patient.index') }}" class="custom-btn btn-2">Go Back</a>
        </div>
        </div>
        </div>
        
</body>
</html>