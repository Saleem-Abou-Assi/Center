<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
@include('layouts.navigation')
</head>
    <div class="C-container">
        
           

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" autofocus>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <br>
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div class="roles">
                            <h2>Roles</h2>
                                <div class="perm">
                                @foreach($roles as $role)
                                    <div class="ro">
                                    <label for="role_{{ $role->id }}" 
                                               class="ml-2 text-sm text-gray-700">
                                            {{ $role->name }}
                                        </label>
                                        <label class="switch">
                                        <input type="checkbox" name="roles[]" 
                                               id="role_{{ $role->id }}"
                                               value="{{ $role->id }}" 
                                               @checked(old('roles', []))>
                                               <span class="slider"></span>
                                         </label>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            @error('roles')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        
                            <br>
                            
                        
                            <button type="submit" 
                                    class="px-4 py-2 text-black bg-blue-500 rounded hover:bg-blue-600">
                                Create User
                            </button>
                            <a href="{{ route('admin.users.index') }}" 
                               class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                                Cancel
                            </a>
                        
                    </form>
                
            </div>
        </div>
    </div>
