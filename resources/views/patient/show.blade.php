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
            <li>Name: {{ $patient->name }}</li>
            <li>Phone: {{ $patient->phone }}</li>
            <li>Address: {{ $patient->address }}</li>
            <li>Gender: {{ $patient->Gender }}</li>
            <li>Age: {{ $patient->age }}</li>
            <li>Relation: {{ $patient->relation }}</li>
            <li>Children: {{ $patient->childerCount }}</li>
            <li>Smooking: {{ $patient->smooking }}</li>
            <li>Old Surgery: {{ $patient->oldSurgery }}</li>
            <li>Algiry: {{ $patient->alirgy }}</li>
            <li>Disease: {{ $patient->disease }}</li>
            <li>Dite: {{ $patient->dite }}</li>
            <li>Permenant Cures: {{ $patient->permenantCure }}</li>
            <li>Cosmetic: {{ $patient->Cosmetic }}</li>
            <li>Current Disease: {{ $patient->CurrentDisease }}</li>
        </ul>
        <table>
            <tr>
                <th>Field Name</th>
                <th>Field Value</th>
            </tr>
            @foreach ($patient->Field as $field)
            <tr>
                <td>{{ $field->name }}</td>
                <td>{{ $field->value }}</td>
            </tr>
            @endforeach
        </table>

        <table>
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
            @for ($i = 0; $i < count($patient->Dept); $i++)
            
            <tr>
                <td>{{$patient->Dept[$i]->title  }}</td>
                <td>{{$patient->Dept[$i]->pivot->illness }}</td> 
                <td>{{$patient->Dept[$i]->pivot->description }}</td>
                <td>{{$patient->Dept[$i]->pivot->cure }}</td>
                <td>{{$patient->Dept[$i]->pivot->doctor_name }}</td>
                <td>{{$apds[$i]->full_cost}}</td>    
                <td><a href="{{ route('accounter.index', $apds[$i]->id) }}">Show</a>   </td>
                                     

            </tr>
            @endfor
    

          
            <tr>

            </tr>


        </table>

        <a href="{{ route('patient.index') }}">Back to Patients</a>    </div>
</body>
</html>