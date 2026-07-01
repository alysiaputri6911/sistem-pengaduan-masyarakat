<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {

            $total = Complaint::count();
            $open = Complaint::where('status', 'open')->count();
            $review = Complaint::where('status', 'in_review')->count();
            $progress = Complaint::where('status', 'in_progress')->count();
            $resolved = Complaint::where('status', 'resolved')->count();
            $closed = Complaint::where('status', 'closed')->count();

            $latest = Complaint::latest()->take(5)->get();

            $chartData = [$open, $review, $progress, $resolved, $closed];

            return view('admin.dashboard', compact(
                'total',
                'open',
                'review',
                'progress',
                'resolved',
                'closed',
                'latest',
                'chartData'
            ));
        }

        $total = Complaint::where('user_id', auth()->id())->count();

        $open = Complaint::where('user_id', auth()->id())
            ->where('status', 'open')->count();

        $progress = Complaint::where('user_id', auth()->id())
            ->where('status', 'in_progress')->count();

        $resolved = Complaint::where('user_id', auth()->id())
            ->where('status', 'resolved')->count();

        return view('citizen.dashboard', compact(
            'total',
            'open',
            'progress',
            'resolved'
        ));
    }
}