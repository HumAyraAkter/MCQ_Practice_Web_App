<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ExamAttempt;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'student')->count();
        $premiumUsers = User::where('account_type', 'premium')->count();
        $freeUsers = $totalUsers - $premiumUsers;
        $totalExamAttempts = ExamAttempt::count();
        $totalRevenue = Payment::where('status', 'success')->sum('amount');

        return view('admin.dashboard', compact(
            'totalUsers', 'premiumUsers', 'freeUsers', 'totalExamAttempts', 'totalRevenue'
        ));
    }
}