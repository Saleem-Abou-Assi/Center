<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="css/welcome.css">
        
       
       
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
