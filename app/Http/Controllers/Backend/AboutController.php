<?php

namespace App\Http\Controllers\Backend;

use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
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
            $datas = About::where('title', 'LIKE', "%".$search."%")->get();
        }else{
            $datas = About::all();
        }
        $DataTranshed = About::onlyTrashed()->get();
        return view('backend.about.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.create');
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
        $photo_name = "About".".".$photo->getClientOriginalExtension();
        $uploads_photo = $photo->move(public_path("/storage/about/"),$photo_name);

        if($uploads_photo){
            $insert = New About();
            $insert->title = $request->title;
            $insert->description = $request->description;
            $insert->line = $request->line;
            $insert->line2 = $request->line2;
            $insert->line3 = $request->line3;
            $insert->description2 = $request->description2;
            $insert->photo = $photo_name;
            $insert->fact = $request->fact;
            $insert->fact2 = $request->fact2;
            $insert->fact3 = $request->fact3;
            $insert->fact4 = $request->fact4;
            $insert->save();
            return redirect(route('backend.about.index'))->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('backend.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $this->validate($request,[
            'title' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif|required|max:1024',
        ]);
        $photo = $request->file('photo');

        if(!empty($photo)){
                $photo_name = 'about'. ".".$photo->getClientOriginalExtension();
                $uploads_photo = $photo->move(public_path("/storage/about/"),$photo_name);
                $path = public_path('storage/banner/'.$about->photo);
                if(file_exists($path)){
                    unlink($path);
                }
        }else{
            $photo_name = $about->photo;
        }
        $about->title = $request->title;
        $about->description = $request->description;
        $about->line = $request->line;
        $about->line2 = $request->line2;
        $about->line3 = $request->line3;
        $about->description2 = $request->description2;
        $about->photo = $photo_name;
        $about->fact = $request->fact;
        $about->fact2 = $request->fact2;
        $about->fact3 = $request->fact3;
        $about->fact4 = $request->fact4;
        $about->save();
        return redirect(route('backend.about.index'))->with('success', 'Data successfully Uploaded!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $about->delete();
        $about->status = 2;
        $about->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function status(About $about)
    {
        if($about->status == 1){
            $about->status = 2;
            $about->save();
        }else{
           $about->status = 1;
           $about->save();
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
        $data = About::onlyTrashed()->where('id', $id)->first();
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
        $data = About::withTrashed()->find($id);
        $path = public_path('storage/about/'.$data->photo);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
