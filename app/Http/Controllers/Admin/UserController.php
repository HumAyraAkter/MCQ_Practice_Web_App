<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,student',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User সফলভাবে তৈরি হয়েছে।');
    }

    public function destroy(User $user)
    {
        // Admin নিজেকে নিজে ডিলিট করতে না পারে
        if ($user->id === auth()->id()) {
            return back()->with('error', 'আপনি নিজের একাউন্ট ডিলিট করতে পারবেন না।');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User ডিলিট করা হয়েছে।');
    }
}