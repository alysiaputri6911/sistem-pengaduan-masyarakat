<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('complaint_code', 'like', "%{$request->search}%")
                    ->orWhere('complainant_name', 'like', "%{$request->search}%");

            });
        }

        $complaints = $query
            ->latest()
            ->paginate(10);

        return view(
            'admin.complaints.index',
            compact('complaints')
        );
    }

    public function show(Complaint $complaint)
{
    if(auth()->user()->role=='admin'){

    if($complaint->status=='pending'){

        $complaint->update([

            'status'=>'open'

        ]);

    }

    return view(
        'admin.complaints.show',
        compact('complaint')
    );

}
    $complaint->load('responses');

    return view(

        'complaints.show',

        compact('complaint')

    );
}

    public function edit(Complaint $complaint)
    {
        return view(
            'admin.complaints.show',
            compact('complaint')
        );
    }

    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([

            'status' => 'required',

            'priority' => 'required'

        ]);

        $complaint->update([

            'status' => $request->status,

            'priority' => $request->priority

        ]);

        return redirect()
            ->route('admin.complaints.index')
            ->with(
                'success',
                'Status pengaduan berhasil diperbarui.'
            );
    }
}