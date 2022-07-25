<?php

namespace App\Http\Controllers\Backend;

use App\Models\Batman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if($search != ""){
            $datas = Batman::where('title', "LIKE", "%".$search."%")->orwhere('description', "LIKE", "%".$search."%")->get();
        }else{
            $datas = Batman::all();
        }
        $DataTranshed = Batman::onlyTrashed()->get();
        return view('backend.services.service_details.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.service_details.create');
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
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:1024',
        ]);
        $photo = $request->file('photo');
        $photo_name = Str::slug($request->title)."_".time().".".$photo->getClientOriginalExtension();
        $uploads_photo = $photo->move(public_path("/storage/service_details/"),$photo_name);
        if($uploads_photo){
            $insert = New Batman();
            $insert->title = $request->title;
            $insert->description = $request->description;
            $insert->link = $request->link;
            $insert->photo = $photo_name;
            $insert->save();
            return redirect(route('backend.batman.index'))->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batman  $batman
     * @return \Illuminate\Http\Response
     */
    public function show(Batman $batman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batman  $batman
     * @return \Illuminate\Http\Response
     */
    public function edit(Batman $batman)
    {
        return view('backend.services.service_details.edit', compact('batman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batman  $batman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batman $batman)
    {
        $this->validate($request,[
            'title' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif|required|max:1024',
        ]);
        $photo = $request->file('photo');

        if(!empty($photo)){
                $photo_name = Str::slug($request->title)."_".time(). ".".$photo->getClientOriginalExtension();
                $uploads_photo = $photo->move(public_path("/storage/service_details/"),$photo_name);
                $path = public_path('storage/banner/'.$batman->photo);
                if(file_exists($path)){
                    unlink($path);
                }
        }else{
            $photo_name = $batman->photo;
        }
        $batman->title = $request->title;
        $batman->description = $request->description;
        $batman->link = $request->link;
        $batman->photo = $photo_name;
        $batman->save();
        return back()->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batman  $batman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batman $batman)
    {
        $batman->delete();
        $batman->status = 2;
        $batman->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batman  $batman
     * @return \Illuminate\Http\Response
     */
    public function status(Batman $batman)
    {
        if($batman->status == 1){
            $batman->status = 2;
            $batman->save();
        }else{
           $batman->status = 1;
           $batman->save();
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
        $data = Batman::onlyTrashed()->where('id', $id)->first();
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
        $data = Batman::withTrashed()->find($id);
        $path = public_path('storage/service_details/'.$data->photo);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
