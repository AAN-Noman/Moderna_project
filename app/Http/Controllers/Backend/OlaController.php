<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ola;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OlaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Ola::onlyTrashed()->get();
        $datas = Ola::all();
        return view('backend.about.Tetstimonial.worker.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.Tetstimonial.worker.index');
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
            'title' => 'required',
            'image' => 'required|mimes:png,jpg,gif,jpeg,webp|max:1024',
        ]);

        $photo = $request->file('image');
        $photo_name = Str::slug($request->title)."_".time().".".$photo->getClientOriginalExtension();
        $uploads_photo = $photo->move(public_path("/storage/worker/"),$photo_name);
        if($uploads_photo){
            $insert = New Ola();
            $insert->title = $request->title;
            $insert->proportion = $request->proportion;
            $insert->description = $request->description;
            $insert->image = $photo_name;
            $insert->save();
            return redirect(route('backend.ola.index'))->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ola  $ola
     * @return \Illuminate\Http\Response
     */
    public function show(Ola $ola)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ola  $ola
     * @return \Illuminate\Http\Response
     */
    public function edit(Ola $ola)
    {
        return view('backend.about.Tetstimonial.worker.edit', compact('ola'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ola  $ola
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ola $ola)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',

        ]);
        $photo = $request->file('image');

        if(!empty($photo)){
                $photo_name = Str::slug($request->title)."_".time(). ".".$photo->getClientOriginalExtension();
                $uploads_photo = $photo->move(public_path("/storage/worker/"),$photo_name);
                $path = public_path('storage/banner/'.$ola->image);
                if(file_exists($path)){
                    unlink($path);
                }
        }else{
            $photo_name = $ola->image;
        }
        $ola->title = $request->title;
        $ola->proportion = $request->proportion;
        $ola->description = $request->description;
        $ola->image = $photo_name;
        $ola->save();
        return back()->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ola  $ola
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ola $ola)
    {
        $ola->delete();
        $ola->status = 2;
        $ola->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ola  $ola
     * @return \Illuminate\Http\Response
     */
    public function status(Ola $ola)
    {
        if($ola->status == 1){
            $ola->status = 2;
            $ola->save();
        }else{
           $ola->status = 1;
           $ola->save();
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
        $data = Ola::onlyTrashed()->where('id', $id)->first();
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
        $data = Ola::withTrashed()->find($id);
        $path = public_path('storage/worker/'.$data->image);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
