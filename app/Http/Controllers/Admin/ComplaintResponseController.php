<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
use Illuminate\Http\Request;

class ComplaintResponseController extends Controller
{
    /**
     * Menampilkan daftar seluruh respon admin
     */
    public function index()
    {
        $responses = ComplaintResponse::with('complaint')
            ->latest()
            ->paginate(10);

        return view(
            'admin.responses.index',
            compact('responses')
        );
    }

    /**
     * Menyimpan respon admin
     */
    public function store(Request $request, Complaint $complaint)
    {
        $request->validate([
            'message' => 'required',
            'attachment' => 'nullable|image|max:2048',
            'status' => 'required',
            'priority' => 'required',
        ]);

        $photo = null;

        if ($request->hasFile('attachment')) {
            $photo = $request
                ->file('attachment')
                ->store('responses', 'public');
        }

        ComplaintResponse::create([
            'complaint_id' => $complaint->id,
            'responder_name' => auth()->user()->name,
            'responder_role' => 'Admin',
            'message' => $request->message,
            'attachment' => $photo,
            'is_final' => $request->has('is_final'),
        ]);

        $complaint->update([
            'status' => $request->status,
            'priority' => $request->priority,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Respon berhasil dikirim.');
    }
}