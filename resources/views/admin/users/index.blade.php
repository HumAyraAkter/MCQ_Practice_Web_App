@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
        <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
            Users Management
        </h1>
        <a href="{{ route('admin.users.create') }}" class="py-2.5 px-5 rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] font-serif">
            + Add User
        </a>
    </div>

    <div class="bg-[#121214] border border-white/[0.05] rounded-2xl overflow-hidden shadow-2xl">
        <table class="w-full text-left">
            <thead class="bg-white/[0.02]">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Name</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Email</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Role</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t border-white/[0.03]">
                        <td class="px-6 py-4 text-gray-200">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold px-2 py-0.5 rounded-md border {{ $user->role === 'admin' ? 'text-amber-400 bg-amber-400/10 border-amber-400/20' : 'text-gray-400 bg-white/5 border-white/10' }}">
                                {{ strtoupper($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('আপনি কি নিশ্চিত?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:text-rose-300 text-sm font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endsection