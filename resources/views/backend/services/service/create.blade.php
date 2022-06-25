@extends('layouts.backendapp')
@section('title', 'create services|')
@section('content')

    <section>
        <div class="container">
            <div class='row'>
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add Banner <a href="{{ route('backend.service.index') }}" class="btn btn-primary btn-sm">All
                                    Banner</a></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form action="{{ route('backend.service.store') }}" method="POST"
                                enctype="multipart/form-data" class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Title:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Title" name="title">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Description:<span
                                            class="required"></span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea class="form-control" rows="3" placeholder="Description" name="description"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Icon Color:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Icon Color"
                                            name="iconColor">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Icon:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Icon" name="icon">
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9  offset-md-3">
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><h3>Icon Color Copy</h3></li>
                          <li class="list-group-item">pink</li>
                          <li class="list-group-item">cyan</li>
                          <li class="list-group-item">green</li>
                          <li class="list-group-item">blue</li>
                        </ul>
                    </div>
                    <div class="card" style="width: 18rem;">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><h3>All Icon Copy</h3></li>
                          <li class="list-group-item">bxl-dribbble</li>
                          <li class="list-group-item">bx-file</li>
                          <li class="list-group-item">bx-tachometer</li>
                          <li class="list-group-item">bx-world</li>
                        </ul>
                    </div>
            </div>
    </section>


@endsection
