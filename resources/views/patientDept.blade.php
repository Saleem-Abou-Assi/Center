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

        <form action="{{ route('patientDept.store') }}" method="POST">
            @csrf
          
        
            <div class="form-group">
                <label for="department">Department Title</label>
                <select id="department" required name="department" >
                    <option value="">Select Department</option>
                    @foreach ($depts as $dept)
                    <option value="{{$dept->id}}">{{$dept->title}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="patient">Patient Name</label>
                <select id="patient" required name="patient" >
                    <option value="">Select patient</option>
                    @foreach ($patients as $patient)
                    <option value="{{$patient->id}}">{{$patient->name}}</option>

                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label for="doctor">Doctor Name</label>
                <select id="doctor" required name="doctor" >
                    <option value="">Select doctor</option>
                    @foreach ($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>

                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label for="illness">Illness</label>
                <input type="text" required id="illness" name="illness" >
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" required id="description" name="description" >
            </div>

            <div class="form-group">
                <label for="cure">Cure</label>
                <input type="text" required id="cure" name="cure" >
            </div>
            
            {{-- patient account details --}}
            <div class="form-group">
                <label for="check_in_type">Check In Type</label>
                <select type="text" required id="check_in_type" name="check_in_type" >
                    <option value="">Select Type</option>
                    <option value="eye">Eye</option>
                    <option value="body">Body</option>
                    <option value="bones">Bones</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="given_cure">Given Cure</label>
                <input type="text" required id="given_cure" name="given_cure" >
            </div>
            <div class="form-group">
                <label for="tools">Tools</label>
                <input type="text" required id="tools" name="tools" >
            </div>
            <div class="form-group">
                <label for="full_cost">Total Cost</label>
                <input type="text" required id="full_cost" name="full_cost" >
            </div>
           

            <button type="submit">{{ 'Input' }}</button>
        </form>
        
         
    </div>
</body>
</html>