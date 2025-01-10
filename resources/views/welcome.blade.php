<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="css/merged.css">
        <link rel="preload" as="image" href="images/Back.jpg">
        </head>
       
       
        @include('layouts.navigation')
        <body>
    
        <section class="heading">
            <h1>الصفحة الرئيسية</h1>

        </section>
        <div class="card-holder">
       <div class="card-container">
        <div class="card">
            <div class="icon">
                <img src="images/pat.jpeg" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>المرضى</h2>
                <p>ستجد هنا بيانات المرضى</p>
                <div class="boton">
                <a href="{{ route('patient.index') }}" class="cta"> <span>Go</span> 
                <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg> </a>
                </div>
            </div>
        </div>
       </div>
       <div class="card-container">
        <div class="card">
            <div class="icon">
                <img src="images/doc.jpeg" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>الأطباء</h2>
                <p>ستجد هنا بيانات الأطباء</p>
                <div class="boton">
                <a href="{{ route('doctor.index')}}" class="cta"> <span>Go</span> 
                <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg> </a>
                </div>
            </div>
        </div>
       </div>
       <div class="card-container">
        <div class="card">
            <div class="icon">
                <img src="images/bok.jpeg" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>الحجوزات</h2>
                <p>ستجد هنا بيانات الحجوزات</p>
                <div class="boton">
                <a href="{{ route('book.index')}}" class="cta"> <span>Go</span> 
                <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg> </a>
                </div>
            </div>
        </div>
       </div>
       <div class="card-container">
        <div class="card">
            <div class="icon">
                <img src="images/dep.jpeg" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>العيادات</h2>
                <p>ستجد هنا بيانات العيادات</p>
                <div class="boton">
                <a href="{{ route('department.index')}}" class="cta"> <span>Go</span> 
                <svg width="15px" height="10px" viewBox="0 0 13 10">    
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
     </svg> </a>
                </div>
            </div>
        </div>
       </div>
       </div>
       <br>
       <br>
       <button></button>
       {{-- @php
           dd(auth()->user()->hasRole('reciption'));
       @endphp --}}
    </body>
</html>
