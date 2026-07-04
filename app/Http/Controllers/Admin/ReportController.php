<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class ReportController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->get();

        return view(
            'admin.reports.index',
            compact('complaints')
        );
    }
}