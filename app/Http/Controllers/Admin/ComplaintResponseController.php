<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
use Illuminate\Http\Request;

class ComplaintResponseController extends Controller
{
    public function store(Request $request, Complaint $complaint)
    {
        $request->validate([
            'message' => 'required',
            'attachment' => 'nullable|image|max:2048',
            'status' => 'required',
            'priority' => 'required'
        ]);

        $photo = null;

        if ($request->hasFile('attachment')) {

            $photo = $request->file('attachment')
                ->store('responses', 'public');
        }

        ComplaintResponse::create([

            'complaint_id' => $complaint->id,

            'responder_name' => auth()->user()->name,

            'responder_role' => 'Admin',

            'message' => $request->message,

            'attachment' => $photo,

            'is_final' => $request->has('is_final')

        ]);

        $complaint->update([

            'status' => $request->status,

            'priority' => $request->priority

        ]);

        return back()->with(
            'success',
            'Respon berhasil dikirim.'
        );
    }
}