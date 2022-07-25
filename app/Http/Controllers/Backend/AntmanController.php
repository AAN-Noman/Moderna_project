<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Antman;
use Illuminate\Http\Request;

class AntmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != "") {
            $datas = Antman::where('title', "LIKE", "%".$search."%")->orwhere('title2', "LIKE", "%".$search."%")->get();
        }else {
            $datas = Antman::all();
        }
        $DataTranshed = Antman::onlyTrashed()->get();
        return view('backend.services.pricing.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.pricing.create');
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
            'title' => "required",
        ]);
        $insert = new Antman();
        $insert->title = $request->title;
        $insert->price = $request->price;
        $insert->title2 = $request->title2;
        $insert->line = $request->line;
        $insert->line2 = $request->line2;
        $insert->line3 = $request->line3;
        $insert->line4 = $request->line4;
        $insert->line5 = $request->line5;
        $insert->link = $request->link;
        $insert->save();
        return redirect(route('backend.antman.index'))->with("success", "Data Insert Successfull!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Antman  $antman
     * @return \Illuminate\Http\Response
     */
    public function show(Antman $antman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Antman  $antman
     * @return \Illuminate\Http\Response
     */
    public function edit(Antman $antman)
    {
        return view('backend.services.pricing.edit', compact('antman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Antman  $antman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Antman $antman)
    {
        $this->validate($request,[
            'title' => "required",
        ]);
        $antman->title = $request->title;
        $antman->price = $request->price;
        $antman->title2 = $request->title2;
        $antman->line = $request->line;
        $antman->line2 = $request->line2;
        $antman->line3 = $request->line3;
        $antman->line4 = $request->line4;
        $antman->line5 = $request->line5;
        $antman->link = $request->link;
        $antman->save();
        return back()->with('success', 'Data successfully Updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Antman  $antman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antman $antman)
    {
        $antman->delete();
        $antman->status = 2;
        $antman->save();
        return back()->with('success', "Data successfully deleted!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Antman  $antman
     * @return \Illuminate\Http\Response
     */
    public function status(Antman $antman)
    {
        if($antman->status == 1){
            $antman->status = 2;
            $antman->save();
        }else{
           $antman->status = 1;
           $antman->save();
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
        $data = Antman::onlyTrashed()->where('id', $id)->first();
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
        $data = Antman::withTrashed()->find($id);
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
