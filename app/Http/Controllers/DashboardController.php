<?php

namespace App\Http\Controllers;

use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role=='admin'){

            $total=Complaint::count();

            $open=Complaint::where('status','open')->count();

            $progress=Complaint::where('status','progress')->count();

            $resolved=Complaint::where('status','resolved')->count();

            return view('admin.dashboard',compact(
                'total',
                'open',
                'progress',
                'resolved'
            ));

        }

        $total=Complaint::where('user_id',auth()->id())->count();

        $open=Complaint::where('user_id',auth()->id())
            ->where('status','open')->count();

        $progress=Complaint::where('user_id',auth()->id())
            ->where('status','progress')->count();

        $resolved=Complaint::where('user_id',auth()->id())
            ->where('status','resolved')->count();

        return view('citizen.dashboard',compact(
            'total',
            'open',
            'progress',
            'resolved'
        ));
    }
}