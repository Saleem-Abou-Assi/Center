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
                <img src="" alt="card image" />
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
                <img src="" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>Card Name</h2>
                <p>card discription</p>
                <button>Explore</button>
            </div>
        </div>
       </div>
       <div class="card-container">
        <div class="card">
            <div class="icon">
                <img src="" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>Card Name</h2>
                <p>card discription</p>
                <button>Explore</button>
            </div>
        </div>
       </div>
       <div class="card-container">
        <div class="card">
            <div class="icon">
                <img src="" alt="card image" />
            </div>
            <div class="card-dis">
                <h2>Card Name</h2>
                <p>card discription</p>
                <button>Explore</button>
            </div>
        </div>
       </div>
       </div>
    </body>
</html>
