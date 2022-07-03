<?php

namespace App\Http\Controllers\Backend;

use App\Models\Work;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Work::onlyTrashed()->get();
        $datas = Work::all();
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
            'name' => "required",
            "image" => 'required|mimes:jpeg,jpg,png,bmp,gif,svg|min:1024',
        ]);

        $photo = $request->file('image');
        $photo_name = Str::slug($request->name)."_".time().".".$photo->getClientOriginalExtension();
        $uploads_photo = $photo->move(public_path("/storage/worker/"),$photo_name);
        if($uploads_photo){
            $insert = New Work();
            $insert->name = $request->name;
            $insert->proportion = $request->proportion;
            $insert->description = $request->description;
            $insert->photo = $photo_name;
            $insert->save();
            return redirect(route('backend.work.index'))->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        return view('backend.about.Tetstimonial.worker.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',

        ]);
        $photo = $request->file('image');

        if(!empty($photo)){
                $photo_name = Str::slug($request->name)."_".time(). ".".$photo->getClientOriginalExtension();
                $uploads_photo = $photo->move(public_path("/storage/worker/"),$photo_name);
                $path = public_path('storage/banner/'.$work->photo);
                if(file_exists($path)){
                    unlink($path);
                }
        }else{
            $photo_name = $work->photo;
        }
        $work->name = $request->name;
        $work->proportion = $request->proportion;
        $work->description = $request->description;
        $work->photo = $photo_name;
        $work->save();
        return back()->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->delete();
        $work->status = 2;
        $work->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function status(Work $work)
    {
        if($work->status == 1){
            $work->status = 2;
            $work->save();
        }else{
           $work->status = 1;
           $work->save();
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
        $data = Work::onlyTrashed()->where('id', $id)->first();
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
        $data = Work::withTrashed()->find($id);
        $path = public_path('storage/worker/'.$data->photo);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }

}
