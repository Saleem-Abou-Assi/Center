<head>
<link rel="stylesheet" href="{{ asset('css/merged.css') }}">
@include('layouts.navigation')
<title>لوحة التحكم</title>
</head>
<body>
    

    <div class="page-title"><h1>
        المستخدمين
    </h1></div>
<br>
    <div class="container">
        <div class="dash">
            @if(session('success'))
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-4">
                    
                        <a href="{{ route('admin.users.create') }}" 
                           class="add-btn">
                            Create User
                        </a>
                    </div>
                    <br>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @foreach($user->roles as $role)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="action-td">
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="action-btn" >Edit</a>
                                       @if (!$user->hasRole('admin'))
                                           <form action="{{ route('admin.users.destroy', $user) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn">Delete</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>