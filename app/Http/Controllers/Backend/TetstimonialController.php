<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tetstimonial;
use Illuminate\Http\Request;

class TetstimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Tetstimonial::onlyTrashed()->get();
        $datas = Tetstimonial::all();
        return view('backend.about.Tetstimonial.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.Tetstimonial.index');
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
            'title' => 'required'
        ]);
        $insert = New Tetstimonial();
        $insert->title = $request->title;
        $insert->description = $request->description;
        $insert->save();
        return back()->with('success', 'data successfully uploads!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tetstimonial  $tetstimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tetstimonial $tetstimonial)
    {
        $tetstimonial->delete();
        $tetstimonial->status = 2;
        $tetstimonial->save();
        return back()->with('success', "Data successfully deleted!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tetstimonial  $tetstimonial
     * @return \Illuminate\Http\Response
     */
    public function status(Tetstimonial $tetstimonial)
    {
        if($tetstimonial->status == 1){
            $tetstimonial->status = 2;
            $tetstimonial->save();
        }else{
           $tetstimonial->status = 1;
           $tetstimonial->save();
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
        $data = Tetstimonial::onlyTrashed()->where('id', $id)->first();
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
        $data = Tetstimonial::withTrashed()->find($id);
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
