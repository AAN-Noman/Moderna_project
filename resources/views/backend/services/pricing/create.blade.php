@extends('layouts.backendapp')
@section('title', 'Pricing Add | ')
@section('content')

    <section>
        <div class="container">
            <div class='row'>
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add Pricing <a href="{{ route('backend.antman.index') }}" class="btn btn-primary btn-sm">All
                                    Pricing</a></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form action="{{ route('backend.antman.store') }}" method="POST"
                                enctype="multipart/form-data" class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Title:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Title" name="title">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Price:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control numeric" placeholder="Price" name="price">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Title2:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Title2" name="title2">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Line:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Line" name="line">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Line2:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Line2" name="line2">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Line3:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Line3" name="line3">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Line4:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Line4" name="line4">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Line5:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Line5" name="line5">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Link:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="Link" name="link">
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
            </div>
    </section>


@endsection
