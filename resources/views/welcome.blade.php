<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="css/welcome.css">
        <link rel="preload" as="image" href="images/Back.png">
        </head>
       
       
        @include('layouts.navigation')
        <body>
        <section class="heading">
            <h1>Landing Page</h1>

        </section>
        <div class="card-holder">
       <div class="card-container">
        <div class="card">
            <div class="icon">
                <img src="images/pat.jpeg" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>Patiants Page</h2>
                <p>here you find you patiants details</p>
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
                <h2>Doctors Page</h2>
                <p>here yo can fund the doctors details</p>
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
                <h2>Booking Page</h2>
                <p>here you can find the Booking section</p>
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
                <h2>Department Page</h2>
                <p>here you can dind the department details</p>
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
    </body>
</html>
