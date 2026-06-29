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

            'message'=>'required'

        ]);

        ComplaintResponse::create([

            'complaint_id'=>$complaint->id,

            'user_id'=>auth()->id(),

            'responder_name'=>auth()->user()->name,

            'responder_role'=>'Administrator',

            'message'=>$request->message,

            'is_final'=>$request->has('is_final')

        ]);

        return back()->with(

            'success',

            'Respon berhasil dikirim.'

        );

    }
}