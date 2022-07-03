@extends('layouts.backendapp')
@section('title', 'Tetstimonial Edit | ')

@section('content')
    <section>
        <div class="container">
            <div class='row'>
                <div class="col-md-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit <a href="{{ route('backend.work.index') }}" class="btn btn-primary btn-sm">Back</a></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <form action="{{ route('backend.work.update', $worker->id ) }}" method="POST" enctype="multipart/form-data"
                                class="form-horizontal form-label-left">
                                @csrf
                                @method("PUT")

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">Worker Name:</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="name"
                                            name="name" value="{{$worker->name}}">
                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <label class="control-label col-md-3 col-sm-3 ">:Proportion</label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type="text" class="form-control" placeholder="proportion"
                                            name="proportion" value="{{$worker->proportion}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Description:<span
                                            class="required"></span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <textarea class="form-control" rows="3" placeholder="Description" name="description">{{$worker->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 ">Image:<span
                                            class="required"></span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 ">
                                        <input type='file' class="form-control" name="image">
                                        <img width="100" class='mt-3' src="{{ asset('storage/worker/' . $worker->image) }}" alt="">
                                    </div>
                                </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-sm-9  offset-md-3">
                                            <button type="submit" class="btn btn-success">Updated</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="toast show" style="position: absolute; top: 0; right: 0;" data-delay="10000">
            <div class="toast-header">
                <strong class="mr-auto">{{ config('app.name') }}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @endif

@endsection


@section('backend_js')
    $('.toast').toast('show');
@endsection
