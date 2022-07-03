<?php

namespace App\Http\Controllers\Backend;

use App\Models\Worker;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Worker::onlyTrashed()->get();
        $datas = Worker::all();
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

        $photo = $request->file('photo');
        $photo_name = Str::slug($request->name)."_".time().".".$photo->getClientOriginalExtension();
        $uploads_photo = $photo->move(public_path("/storage/worker/"),$photo_name);
        if($uploads_photo){
            $insert = New Worker();
            $insert->name = $request->name;
            $insert->proportion = $request->proportion;
            $insert->description = $request->description;
            $insert->photo = $photo_name;
            $insert->save();
            return redirect(route('backend.worker.index'))->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('backend.about.Tetstimonial.worker.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',

        ]);
        $photo = $request->file('photo');

        if(!empty($photo)){
                $photo_name = Str::slug($request->name)."_".time(). ".".$photo->getClientOriginalExtension();
                $uploads_photo = $photo->move(public_path("/storage/worker/"),$photo_name);
                $path = public_path('storage/banner/'.$worker->photo);
                if(file_exists($path)){
                    unlink($path);
                }
        }else{
            $photo_name = $worker->photo;
        }
        $worker->name = $request->name;
        $worker->proportion = $request->proportion;
        $worker->description = $request->description;
        $worker->photo = $photo_name;
        $worker->save();
        return back()->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        $worker->status = 2;
        $worker->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function status(Worker $worker)
    {
        if($worker->status == 1){
            $worker->status = 2;
            $worker->save();
        }else{
           $worker->status = 1;
           $worker->save();
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
        $data = Worker::onlyTrashed()->where('id', $id)->first();
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
        $data = Worker::withTrashed()->find($id);
        $path = public_path('storage/worker/'.$data->photo);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
