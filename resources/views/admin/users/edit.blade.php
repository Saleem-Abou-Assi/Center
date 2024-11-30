
 <head>
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="{{ asset('css/merged.css') }}">
@include('layouts.navigation')
 </head>
      
    
            <div class="C-container">
   
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" >Name</label>
                            <input type="text" name="name" id="name" 
                                   
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <div>
                            <label for="email" >Email</label>
                            <input type="email" name="email" id="email" 
                                 
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <div class="roles">

                            <h2 >Roles</h2>
                            <div class="perm">
                                @foreach($roles as $role)
                                    <div class="ro">
                                    <label for="role_{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                        <label class="switch">
                                        <input type="checkbox" name="roles[]" 
                                               id="role_{{ $role->id }}"
                                               value="{{ $role->id }}" 
                                               @if(in_array($role->id, old('roles', []))) checked @endif><span class="slider"></span>
                                               </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('roles')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <div class="bot">
                            <button type="submit" 
                                    class="cta"><span>
                                عدّل</span>  
                            </button>

                            <a href="{{ route('admin.users.index') }}" 
                               class="add-btn2">
                                Cancel
                            </a>
                            </div>
                    </form>
                    </div>
            
        
    
