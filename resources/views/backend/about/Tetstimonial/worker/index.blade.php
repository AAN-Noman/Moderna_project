@extends('layouts.backendapp')
@section('title', 'Tetstimonial | ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="{{ route('backend.worker.store')}}" method="POST"
                            class="form-horizontal form-label-left">
                            @csrf
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Name:</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="Name"
                                        name="name">
                                </div>
                                @error('name')
                                        <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Proportion:</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="proportion"
                                        name="proportion">
                                </div>
                                @error('proportion')
                                        <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Description:<span
                                        class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <textarea class="form-control" rows="3" placeholder="Description" name="description"></textarea>
                                </div>
                                @error('description')
                                        <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Worker Image:<span
                                        class="required"></span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type='file' class="form-control" name="image">
                                </div>
                                @error('image')
                                        <p class='text-danger'>{{ $message }}</p>
                                @enderror
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

            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class='colume-title'>Id</th>
                                    <th class='colume-title'>Image</th>
                                    <th class='colume-title'>Name</th>
                                    <th class='colume-title'>Proportion</th>
                                    <th class='colume-title'>Description</th>
                                    <th class='colume-title'>Status</th>
                                    <th class='colume-title'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr class="even pointer">
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            <img width="100" src="{{ asset('/storage/worker/' . $data->image) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->proportion }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>{{ $data->status == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td class="last">
                                            <a href="{{ route('backend.worker.status', $data->id) }}"
                                                class="btn btn-{{ $data->status == 1 ? 'warning' : 'success' }} btn-sm">
                                                {{ $data->status == 1 ? 'Deactive' : 'Active' }}
                                            </a>
                                            <form class='d-inline'
                                                action="{{ route('backend.worker.destroy', $data->id) }}" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Restore</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class='colume-title'>Id</th>
                                    <th class='colume-title'>Image</th>
                                    <th class='colume-title'>Name</th>
                                    <th class='colume-title'>Proportion</th>
                                    <th class='colume-title'>Description</th>
                                    <th class='colume-title'>Status</th>
                                    <th class='colume-title'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($DataTranshed as $data)
                                    <tr class="even pointer">
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            <img width="100" src="{{ asset('/storage/worker/' . $data->image) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->proportion }}</td>
                                        <td>{{ $data->description }}</td>
                                        <td>{{ $data->status == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td class="last">
                                            <a href="{{ route('backend.worker.restore', $data->id) }}"
                                                class="btn btn-primary btn-sm">Restore</a>

                                            <button id="delete" value="{{ route('backend.worker.hardDelete', $data->id) }}" class="btn btn-danger btn-sm">Hard Delete</button>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;"
                    data-delay="10000">
                    <div class="toast" style="position: absolute; top: 0; right: 0;">
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
                </div>
            @endif
        </div>
    </div>


@endsection

@section('backend_css')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.css'></script>
@endsection

@section('backend_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.all.min.js"></script>

    <script>
        $('.toast').toast('show');

        // alart
        let url = $('#delete').val(); //JavaScript
        $('#delete').on('click', function() { //JQuary
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; //return
                }
            })
        })
    </script>
@endsection
