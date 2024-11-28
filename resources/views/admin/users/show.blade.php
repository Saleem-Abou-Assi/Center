<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            User Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">User Information</h3>
                        <div class="mt-4">
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Roles:</strong> 
                                {{ $user->roles->pluck('name')->implode(', ') }}
                            </p>
                            <p><strong>Created:</strong> {{ $user->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('admin.users.edit', $user) }}" 
                           class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            Edit User
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600"
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                Delete User
                            </button>
                        </form>
                        <a href="{{ route('admin.users.index') }}" 
                           class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>