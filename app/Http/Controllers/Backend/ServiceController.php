<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DataTranshed = Service::onlyTrashed()->get();
        $datas = Service::all();
        return view('backend.services.service.index', compact('datas', 'DataTranshed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.services.service.create');
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
            'title' => 'required'
        ]);
        $insert = New Service();
        $insert->title = $request->title;
        $insert->description = $request->description;
        $insert->iconColor = $request->iconColor;
        $insert->icon = $request->icon;
        $insert->save();
        return redirect(route('backend.service.index'))->with('success', 'Data successfully Uploaded!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('backend.services.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $this->validate($request,[
            'title' => 'required'
        ]);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->iconColor = $request->iconColor;
        $service->icon = $request->icon;
        $service->save();
        return redirect(route('backend.service.index'))->with('success', 'Data successfully Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        $service->status = 2;
        $service->save();
        return back()->with('success', 'data successfully deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function status(Service $service)
    {
        if($service->status == 1){
            $service->status = 2;
            $service->save();
        }else{
           $service->status = 1;
           $service->save();
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
        $data = Service::onlyTrashed()->where('id', $id)->first();
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
        $data = Service::withTrashed()->find($id);
        $data -> forceDelete();
        return back()->with('success', 'Data full Delete');
    }
}
