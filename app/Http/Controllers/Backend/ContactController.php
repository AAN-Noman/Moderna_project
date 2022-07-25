<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request["search"] ?? "";
        if($search != ""){
            $datas = Contact::where('address', 'LIKE', '%'.$search.'%')->orwhere('email', 'LIKE', '%'.$search.'%')->orwhere('email2', 'LIKE', '%'.$search.'%')->orwhere('phone', 'LIKE', '%'.$search.'%')->orwhere('phone2', 'LIKE', '%'.$search.'%')->get();
        }else{
            $datas = Contact::all();
        }
        $DataTranshed = Contact::onlyTrashed()->get();
        return view('backend.contact.address.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.contact.address.index');
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
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $insert = New Contact();
        $insert->address = $request->address;
        $insert->email = $request->email;
        $insert->email2 = $request->email2;
        $insert->phone = $request->phone;
        $insert->phone2 = $request->phone2;
        $insert->save();
        return back()->with('success', 'data successfully uploads!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('backend.contact.address.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->validate($request,[
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->email2 = $request->email2;
        $contact->phone = $request->phone;
        $contact->phone2 = $request->phone2;
        $contact->save();
        return back()->with('success', 'data successfully uploads!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        $contact->status = 2;
        $contact->save();
        return back()->with('success', "Data successfully deleted!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function status(Contact $contact)
    {
        if($contact->status == 1){
            $contact->status = 2;
            $contact->save();
        }else{
           $contact->status = 1;
           $contact->save();
        }
        return back()->with('success', 'Status Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $data = Contact::onlyTrashed()->where('id', $id)->first();
        $data->status = 1;
        $data->save();
        $data->restore();
        return back()->with('success', 'Data successfully restored');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function hardDelete($id)
    {
        $data = Contact::withTrashed()->find($id);
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
