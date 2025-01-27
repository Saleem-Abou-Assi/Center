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

            <div class="">
                
                <div class="">
                    <div class="">
                    
                        <a href="{{ route('admin.users.create') }}" 
                           class="add-btn">
                            Create User
                        </a>
                    </div>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
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
                                                style="margin:0"
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
        <div class="boto">
    <a href="{{ url()->previous() }}" class="custom-btn btn-2"><span class="fa fa-arrow-left" style="font-size:25px"></span></a>
    </div>
    </div>
    
    </body>