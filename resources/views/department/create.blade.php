<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>إدارة العيادات</title>
    @include('layouts.navigation')
</head>
<body>

    <div class="C-container">
        <h1>{{ isset($department) ? 'عدل عيادةّ' : 'أضف عيادةّ' }}</h1>

        <form action="{{ isset($department) ? route('department.update', $department->id) : route('department.store') }}" method="POST">
            @csrf
            @if (isset($department))
                @method('PUT')
            @endif
        
            <div class="form-group" >
                <label for="title">عنوان العيادة</label>
                <input type="text" id="title" name="title" required value="{{ isset($department) ? $department->name : '' }} " autofocus>
            </div>
        
        
            <button type="submit" class="save-btn">{{ isset($book) ? 'عدّل' : 'أنشئ' }}</span></button>
            </button>
  
        </form>
        <div class="boton">
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    </div>
    </div>
    <script>
        save_btn=document.querySelector(".save-btn");

save_btn.onclick= function(){
    this.innerHTML="<div class=loader></div>";
}
    </script>
</body>
</html>