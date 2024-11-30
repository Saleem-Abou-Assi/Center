<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
    <title>Dashboard</title>
    @include('layouts.navigation')
</head>
<body>
<div class="all">
    <br>
    <br>
    <div class="C-container">
       
            <div class="con">
                <h2>إدارة المستخدمين</h2>
<!--add counter if you want -->
<h3>عدد المسجلين</h3>
                <div class="count">
                   
                    <p><strong>{{ $userCount }}</strong></p>
                </div>
                <br>
                <br>
                <div>
                    <a href="{{ route('admin.users.index') }}" 
                           class="add-btn">
                           Go
                        </a>
                </div>
            </div>
            <!-- <div class="con">
                <h2>إدارة المستخدمين</h2>

                <h3>عدد المسجلين</h3>
                <div class="count">
                   
                    <p><strong>{{ $userCount }}</strong></p>
                </div>
                <br>
                <br>
                <div>
                    <a href="{{ route('admin.users.index') }}" 
                           class="add-btn">
                           Go
                        </a>
                </div>
            </div> -->
        
    </div>
</div>
</body>