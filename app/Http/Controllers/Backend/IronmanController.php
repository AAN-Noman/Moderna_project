<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ironman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IronmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Ironman::onlyTrashed()->get();
        $datas = Ironman::all();
        return view('backend.services.whyus.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.whyus.create');
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
            "photo" => "required|mimes:png,jpg,gif,jpeg,webp|max:1024"
        ]);

        $photo = $request->file('photo');

        $photo_name = Str::slug($request->title)."_".time(). ".".$photo->getClientOriginalExtension();
        $uploads_photo = $photo->move(public_path("/storage/whyus/"),$photo_name);

        if($uploads_photo){
            $insert = new Ironman();
            $insert->title = $request->title;
            $insert->description = $request->description;
            $insert->icon = $request->icon;
            $insert->title2 = $request->title2;
            $insert->description2 = $request->description2;
            $insert->icon2 = $request->icon2;
            $insert->link = $request->link;
            $insert->photo = $photo_name;
            $insert->save();
            return redirect(route('backend.ironman.index'))->with("success", "Data Insert Successfull!");
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ironman  $ironman
     * @return \Illuminate\Http\Response
     */
    public function show(Ironman $ironman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ironman  $ironman
     * @return \Illuminate\Http\Response
     */
    public function edit(Ironman $ironman)
    {
        return view('backend.services.whyus.edit', compact('ironman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ironman  $ironman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ironman $ironman)
    {
        $this->validate($request,[
            'title' => "required",
            "photo" => "required|mimes:png,jpg,gif,jpeg,webp|max:1024"
        ]);

        $photo = $request->file('photo');
        if(!empty($photo)){
            $photo_name = Str::slug($request->title)."_".time(). ".".$photo->getClientOriginalExtension();
            $photo->move(public_path("/storage/whyus/"),$photo_name);
            $path = public_path('storage/whyus/'.$ironman->photo);
            if(file_exists($path)){
                unlink($path);
            }else{
                $photo_name = $ironman->photo;
            }

            $ironman->title = $request->title;
            $ironman->description = $request->description;
            $ironman->icon = $request->icon;
            $ironman->title2 = $request->title2;
            $ironman->description2 = $request->description2;
            $ironman->icon2 = $request->icon2;
            $ironman->link = $request->link;
            $ironman->photo = $photo_name;
            $ironman->save();
            return back()->with('success', 'Data successfully Updated!!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ironman  $ironman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ironman $ironman)
    {
        $ironman->delete();
        $ironman->status = 2;
        $ironman->save();
        return back()->with('success', "Data successfully deleted!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ironman  $ironman
     * @return \Illuminate\Http\Response
     */
    public function status(Ironman $ironman)
    {
        if($ironman->status == 1){
            $ironman->status = 2;
            $ironman->save();
        }else{
           $ironman->status = 1;
           $ironman->save();
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
        $data = Ironman::onlyTrashed()->where('id', $id)->first();
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
        $data = Ironman::withTrashed()->find($id);
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
