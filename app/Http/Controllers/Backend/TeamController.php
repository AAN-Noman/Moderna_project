<?php

namespace App\Http\Controllers\Backend;


use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Team::onlyTrashed()->get();
        $datas = Team::all();
        return view('backend.team.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.team.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $this->validate($request,[
            'name' => 'required',
            'photo' => 'required|mimes:png,jpg,gif,jpeg,webp|max:1024',
        ]);

        $photo = $request->file('photo');
        $photo_name = Str::slug($request->name)."_".time().".".$photo->getClientOriginalExtension();
        $uploads_photo = $photo->move(public_path("/storage/team/"),$photo_name);
        if($uploads_photo){
            $insert = New Team();
            $insert->name = $request->name;
            $insert->profession = $request->profession;
            $insert->description = $request->description;
            $insert->twitter = $request->twitter;
            $insert->facebook = $request->facebook;
            $insert->instagram = $request->instagram;
            $insert->linkedin = $request->linkedin;
            $insert->photo = $photo_name;
            $insert->save();
            return back()->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('backend.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $this->validate($request,[
            'name' => 'required',
            'photo' => 'image| mimes:jpeg,jpg,png | max:1000',

        ]);
        $photo = $request->file('photo');

        if(!empty($photo)){
                $photo_name = Str::slug($request->photo)."_".time(). ".".$photo->getClientOriginalExtension();
                $uploads_photo = $photo->move(public_path("/storage/team/"),$photo_name);
                $path = public_path('storage/team/'.$team->photo);
                if(file_exists($path)){
                    unlink($path);
                }
        }else{
            $photo_name = $team->photo;
        }
            $team->name = $request->name;
            $team->profession = $request->profession;
            $team->description = $request->description;
            $team->twitter = $request->twitter;
            $team->facebook = $request->facebook;
            $team->instagram = $request->instagram;
            $team->linkedin = $request->linkedin;
            $team->photo = $photo_name;
            $team->save();
            return back()->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        $team->status = 2;
        $team->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function status(Team $team)
    {
        if($team->status == 1){
            $team->status = 2;
            $team->save();
        }else{
           $team->status = 1;
           $team->save();
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
        $data = Team::onlyTrashed()->where('id', $id)->first();
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
        $data = Team::withTrashed()->find($id);
        $path = public_path('storage/team/'.$data->photo);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
