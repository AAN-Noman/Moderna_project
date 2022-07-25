<?php

namespace App\Http\Controllers\Backend;

use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            $datas = Portfolio::where('title', 'LIKE', '%'.$search.'%')->get();
        }else{
            $datas = Portfolio::all();
        }
            $DataTranshed = Portfolio::onlyTrashed()->get();
            return view('backend.portfolio.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.portfolio.index');
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
        $uploads_photo = $photo->move(public_path("/storage/portfolio/"),$photo_name);
        if($uploads_photo){
            $insert = New Portfolio();
            $insert->title = $request->title;
            $insert->filter = $request->filter;
            $insert->image = $photo_name;
            $insert->save();
            return redirect(route('backend.portfolios.index'))->with('success', 'Data successfully Uploaded!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        return view('backend.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',

        ]);
        $photo = $request->file('image');

        if(!empty($photo)){
                $photo_name = Str::slug($request->title)."_".time(). ".".$photo->getClientOriginalExtension();
                $uploads_photo = $photo->move(public_path("/storage/portfolio/"),$photo_name);
                $path = public_path('storage/portfolio/'.$portfolio->image);
                if(file_exists($path)){
                    unlink($path);
                }
        }else{
            $photo_name = $portfolio->image;
        }
        $portfolio->title = $request->title;
        $portfolio->filter = $request->filter;
        $portfolio->image = $photo_name;
        $portfolio->save();
        return back()->with('success', 'Data successfully updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        $portfolio->status = 2;
        $portfolio->save();
        return back()->with('success', 'Data successfully deleted!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function status(Portfolio $portfolio)
    {
        if($portfolio->status == 1){
            $portfolio->status = 2;
            $portfolio->save();
        }else{
           $portfolio->status = 1;
           $portfolio->save();
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
        $data = Portfolio::onlyTrashed()->where('id', $id)->first();
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
        $data = Portfolio::withTrashed()->find($id);
        $path = public_path('storage/portfolio/'.$data->image);
        if(file_exists($path)){
            unlink($path);
        }
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
