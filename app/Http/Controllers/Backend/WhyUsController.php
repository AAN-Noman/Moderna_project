<?php

namespace App\Http\Controllers\Backend;

use App\Models\Whyus;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhyusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Whyus::all();
        return view('backend.services.whyus.index', compact('datas'));
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
            $insert = new Whyus();
            $insert->title = $request->title;
            $insert->description = $request->description;
            $insert->icon = $request->icon;
            $insert->title2 = $request->title2;
            $insert->description2 = $request->description2;
            $insert->icon2 = $request->icon2;
            $insert->link = $request->link;
            $insert->photo = $photo_name;
            $insert->save();
            return redirect(route('backend.whyus.index'))->with("success", "Data Insert Successfull!");
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Whyus  $whyus
     * @return \Illuminate\Http\Response
     */
    public function edit(Whyus $whyus)
    {
        $datas = Whyus::all();
        return view('backend.services.whyus.edit', compact('whyus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Whyus  $whyus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Whyus $whyus)
    {
        $this->validate($request,[
            'title' => "required",
            "photo" => "required|mimes:png,jpg,gif,jpeg,webp|max:1024"
        ]);

        $photo = $request->file('photo');
        if(!empty($photo)){
            $photo_name = Str::slug($request->title)."_".time(). ".".$photo->getClientOriginalExtension();
            $photo->move(public_path("/storage/whyus/"),$photo_name);
            $path = public_path('storage/whyus/'.$whyus->photo);
            if(file_exists($path)){
                unlink($path);
            }else{
                $photo_name = $whyus->photo;
            }

            $whyus->title = $request->title;
            $whyus->description = $request->description;
            $whyus->icon = $request->icon;
            $whyus->title2 = $request->title2;
            $whyus->description2 = $request->description2;
            $whyus->icon2 = $request->icon2;
            $whyus->link = $request->link;
            $whyus->photo = $photo_name;
            $whyus->save();
            return back()->with('success', 'Data successfully Updated!!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Whyus  $whyus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Whyus $whyus)
    {
        $whyus->delete();
        $whyus->save();
        return back()->with('success', "Data successfully deleted!");
    }
}
