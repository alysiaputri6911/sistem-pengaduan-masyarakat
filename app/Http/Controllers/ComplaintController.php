<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar pengaduan milik user yang login.
     */
    public function index()
{
    if(auth()->user()->role=='admin'){

        $complaints=Complaint::latest()->get();

    }else{

        $complaints=Complaint::where(
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
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'category'    => 'nullable|string|max:50',
            'location'    => 'nullable|string|max:200',
        ]);

        Complaint::create([
            'user_id'          => Auth::id(),

            'complaint_code'   => 'CMP-' . now()->format('YmdHis'),

            'title'            => $request->title,

            'description'      => $request->description,

            'category'         => $request->category,

            'location'         => $request->location,

            'complainant_name' => Auth::user()->name,

            'phone'            => Auth::user()->phone,

            'email'            => Auth::user()->email,

            'priority'         => 'medium',

            'status'           => 'open',
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
        $complaint = Complaint::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('complaints.show', compact('complaint'));
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
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Pengaduan yang sudah diproses tidak dapat diubah.'
                );
        }

        $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'category'    => 'nullable|string|max:50',
            'location'    => 'nullable|string|max:200',
        ]);

        $complaint->update([
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'location'    => $request->location,
        ]);

        return redirect()
            ->route('complaints.index')
            ->with(
                'success',
                'Pengaduan berhasil diperbarui.'
            );
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