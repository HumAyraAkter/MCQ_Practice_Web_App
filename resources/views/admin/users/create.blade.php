@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white mb-6 tracking-wide">
        Add New User
    </h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl max-w-xl space-y-5">
        @csrf

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-300">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3" required>
            @error('name') <p class="text-rose-400 text-xs mt-2">⚠️ {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-300">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3" required>
            @error('email') <p class="text-rose-400 text-xs mt-2">⚠️ {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-300">Password</label>
            <input type="password" name="password" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3" required>
            @error('password') <p class="text-rose-400 text-xs mt-2">⚠️ {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-300">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-300">Role</label>
            <select name="role" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3" required>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <p class="text-rose-400 text-xs mt-2">⚠️ {{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-white/[0.05]">
            <button type="submit" class="py-3 px-6 rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] font-serif">
                Create User
            </button>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-400 hover:text-rose-400">Cancel</a>
        </div>
    </form>
@endsection