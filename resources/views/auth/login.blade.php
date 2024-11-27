<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
</head>
<body>
    
<br>
<div class="C-container">
    <!-- Session Status -->
    <h1>Login</h1>
    

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" :value="__('Email')" style="font-weight:bold;">Email</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="example@gmail.com"/>
           
        </div>
        <br>
      
        <!-- Password -->
        <div class="mt-4">
            <label for="password" :value="__('Password')" style="font-weight:bold;">Password</label>

            <input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"  placeholder="..."/>

         
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="but">
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline" href="{{ route('password.request') }}" >
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            
            <button class="add-btn1">
                {{ __('Log in') }}
            </button>
            </div>
        </div>
    </form>

</div>
</body>