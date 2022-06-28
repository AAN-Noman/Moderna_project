<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Pricing::onlyTrashed()->get();
        $datas = Pricing::all();
        return view('backend.services.pricing.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.pricing.create');
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
        ]);
        $insert = new Pricing();
        $insert->title = $request->title;
        $insert->price = $request->price;
        $insert->title2 = $request->title2;
        $insert->line = $request->line;
        $insert->line2 = $request->line2;
        $insert->line3 = $request->line3;
        $insert->line4 = $request->line4;
        $insert->line5 = $request->line5;
        $insert->link = $request->link;
        $insert->save();
        return redirect(route('backend.price.index'))->with("success", "Data Insert Successfull!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function show(Pricing $pricing)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function edit(Pricing $pricing)
    {
        return view('backend.services.pricing.edit', compact('pricing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pricing $pricing)
    {
        $this->validate($request,[
            'title' => "required",
        ]);
        $pricing->title = $request->title;
        $pricing->price = $request->price;
        $pricing->title2 = $request->title2;
        $pricing->line = $request->line;
        $pricing->line2 = $request->line2;
        $pricing->line3 = $request->line3;
        $pricing->line4 = $request->line4;
        $pricing->line5 = $request->line5;
        $pricing->link = $request->link;
        $pricing->save();
        return back()->with('success', 'Data successfully Updated!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pricing $pricing)
    {
        $pricing->delete();
        $pricing->status = 2;
        $pricing->save();
        return back()->with('success', "Data successfully deleted!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pricing  $pricing
     * @return \Illuminate\Http\Response
     */
    public function status(Pricing $pricing)
    {
        if($pricing->status == 1){
            $pricing->status = 2;
            $pricing->save();
        }else{
           $pricing->status = 1;
           $pricing->save();
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
        $data = Pricing::onlyTrashed()->where('id', $id)->first();
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
        $data = Pricing::withTrashed()->find($id);
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
