<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar pengaduan milik user yang login.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {

            $complaints = Complaint::latest()->get();
        } else {

            $complaints = Complaint::where(
                'user_id',
                auth()->id()
            )->latest()->get();
        }

        return view(
            'complaints.index',
            compact('complaints')
        );
    }
    /**
     * Menampilkan form tambah pengaduan.
     */
    public function create()
    {
        return view('complaints.create');
    }


    /**
     * Menyimpan pengaduan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'location' => 'required',
            'attachment' => 'nullable|image|max:2048',
        ]);

        $attachment = null;

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')
                ->store('complaints', 'public');
        }

        // Membuat kode pengaduan otomatis
        $lastComplaint = Complaint::latest('id')->first();

        if ($lastComplaint) {

            $lastNumber = (int) substr($lastComplaint->complaint_code, 4);

            $newNumber = $lastNumber + 1;
        } else {

            $newNumber = 1;
        }

        $complaintCode = 'CMP-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
        Complaint::create([
            'user_id' => auth()->id(),
            'complaint_code' => $complaintCode,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'location' => $request->location,

            'attachment' => $attachment,

            // Ambil data dari user yang login
            'complainant_name' => auth()->user()->name,
            'phone' => auth()->user()->phone,
            'email' => auth()->user()->email,

            'priority' => 'medium',
            'status' => 'pending',
        ]);

        return redirect()
            ->route('complaints.index')
            ->with('success', 'Pengaduan berhasil dikirim.');
    }

    /**
     * Menampilkan detail pengaduan.
     */
    public function show(string $id)
    {

        if (auth()->user()->role == 'admin') {

            $complaint = Complaint::findOrFail($id);

            if ($complaint->status == 'open') {

                $complaint->status = 'in_review';

                $complaint->save();
            }

            return view(
                'admin.complaints.show',
                compact('complaint')
            );
        }

        $complaint = Complaint::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        return view(
            'complaints.show',
            compact('complaint')
        );
    }

    public function response(Request $request, $id)
    {
        $request->validate([

            'message' => 'required',

            'attachment' => 'nullable|image|max:2048',

        ]);

        $complaint = Complaint::findOrFail($id);

        $attachment = null;

        if ($request->hasFile('attachment')) {

            $attachment = $request
                ->file('attachment')
                ->store('responses', 'public');
        }

        ComplaintResponse::create([

            'complaint_id' => $complaint->id,

            'responder_name' => auth()->user()->name,

            'responder_role' => auth()->user()->role,

            'message' => $request->message,

            'attachment' => $attachment,

            'is_final' => $request->has('is_final'),

        ]);

        if ($request->has('is_final')) {

            $complaint->status = 'resolved';
        } else {

            $complaint->status = 'in_progress';
        }

        $complaint->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'Respon berhasil dikirim.'
            );
    }
    /**
     * Menampilkan form edit pengaduan.
     */
    public function edit(string $id)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Memperbarui pengaduan.
     */
    public function update(Request $request, string $id)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($complaint->status !== 'open') {
            return redirect()->back()
                ->with('error', 'Pengaduan yang sudah diproses tidak dapat diubah.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'location' => 'required',
            'attachment' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('attachment')) {

            if (
                $complaint->attachment &&
                \Storage::disk('public')->exists($complaint->attachment)
            ) {

                \Storage::disk('public')->delete($complaint->attachment);
            }

            $complaint->attachment = $request->file('attachment')
                ->store('complaints', 'public');
        }

        $complaint->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'location' => $request->location,
            'attachment' => $complaint->attachment,
        ]);

        return redirect()
            ->route('complaints.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Menghapus pengaduan.
     */
    public function destroy(string $id)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($complaint->status !== 'open') {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Pengaduan yang sedang diproses tidak dapat dihapus.'
                );
        }

        $complaint->delete();

        return redirect()
            ->route('complaints.index')
            ->with(
                'success',
                'Pengaduan berhasil dihapus.'
            );
    }
}
