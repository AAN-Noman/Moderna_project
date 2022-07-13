<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Message::all();
        return view('backend.Contact.Message.message', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
        ]);
        $insert = New Message();
        $insert->name = $request->name;
        $insert->email = $request->email;
        $insert->subject = $request->subject;
        $insert->message = $request->message;
        $insert->save();
        return redirect(route('backend.message.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function hardDelete($id)
    {
        $data = Message::withTrashed()->find($id);
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
