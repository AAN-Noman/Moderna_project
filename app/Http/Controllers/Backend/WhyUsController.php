<?php

namespace App\Http\Controllers\Backend;

use App\Models\WhyUs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhyUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = WhyUs::all();
        $DataTranshed = WhyUs::onlyTrashed()->get();
        return view('backend.services.whyUs.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.whyUs.create');
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
        $uploads_photo = $photo->move(public_path("/storage/whyus/"),$photo_name);
        if($uploads_photo){
            $insert = New WhyUs();
            $insert->title = $request->title;
            $insert->description = $request->description;
            $insert->link = $request->link;
            $insert->icon = $request->icon;
            $insert->photo = $photo_name;
            $insert->save();
            return redirect(route('backend.whyUs.index'))->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WhyUs  $whyUs
     * @return \Illuminate\Http\Response
     */
    public function show(WhyUs $whyUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WhyUs  $whyUs
     * @return \Illuminate\Http\Response
     */
    public function edit(WhyUs $whyUs)
    {
        return view('backend.services.whyUs.edit', compact('whyUs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WhyUs  $whyUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WhyUs $whyUs)
    {
        $this->validate($request,[
            'title' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif|required|max:1024',
        ]);
        $photo = $request->file('photo');

        if(!empty($photo)){
            $photo_name = Str::slug($request->title)."_".time(). ".".$photo->getClientOriginalExtension();
            $photo->move(public_path("/storage/whyus/"),$photo_name);
            $paths = public_path('storage/whyus/'.$whyUs->photo);
            if(file_exists($paths)){
                unlink($paths);
            }
    }else{
            $photo_name = $whyUs->photo;
        }
        $whyUs->title = $request->title;
        $whyUs->description = $request->description;
        $whyUs->icon = $request->icon;
        $whyUs->link = $request->link;
        $whyUs->photo = $photo_name;
        $whyUs->save();
        return back()->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WhyUs  $whyUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(WhyUs $whyUs)
    {
        $whyUs->delete();
        $whyUs->status = 2;
        $whyUs->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WhyUs  $whyUs
     * @return \Illuminate\Http\Response
     */
    public function status(WhyUs $whyUs)
    {
        if($whyUs->status == 1){
            $whyUs->status = 2;
            $whyUs->save();
        }else{
           $whyUs->status = 1;
           $whyUs->save();
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
        $data = WhyUs::onlyTrashed()->where('id', $id)->first();
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
        $data = WhyUs::withTrashed()->find($id);
        $path = public_path('storage/whyus/'.$data->photo);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
