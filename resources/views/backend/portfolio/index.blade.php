@extends('layouts.backendapp')
@section('title', 'Portfolio | ')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 class="font-weight-bold">Add</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="{{ route('backend.portfolios.store')}}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal form-label-left">
                            @csrf

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Title:</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="title"
                                        name="title">
                                </div>
                                @error('title')
                                        <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Filter:</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" placeholder="web app"
                                        name="filter">
                                </div>
                                @error('filter')
                                        <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Image:<span
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

            {{-- copy for filter ,, in class  --}}
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                  <h3 class="font-weight-bold">Fitler</h3>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">app</li>
                  <li class="list-group-item">web</li>
                  <li class="list-group-item">card</li>
                </ul>
            </div>
            {{-- End --}}

            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 class="font-weight-bold">All</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class='colume-title'>Id</th>
                                    <th class='colume-title'>Image</th>
                                    <th class='colume-title'>Title</th>
                                    <th class='colume-title'>Filter</th>
                                    <th class='colume-title'>Status</th>
                                    <th class='colume-title'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr class="even pointer">
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            <img width="100" src="{{ asset('/storage/portfolio/' . $data->image) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->filter }}</td>
                                        <td><p class="text-{{ $data->status == 1 ? 'primary' : 'warning' }}">{{ $data->status == 1 ? 'Active' : 'Deactive' }}</p></td>
                                        <td class="last">
                                            <a href="{{ route('backend.portfolios.edit', $data->id) }}"
                                                class="btn btn-primary btn-sm">View/Edit</a>
                                            <a href="{{ route('backend.portfolios.status', $data->id) }}"
                                                class="btn btn-{{ $data->status == 1 ? 'warning' : 'success' }} btn-sm">
                                                {{ $data->status == 1 ? 'Deactive' : 'Active' }}
                                            </a>
                                            <form class='d-inline'
                                                action="{{ route('backend.portfolios.destroy', $data->id) }}" method='POST'>
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
                        <h2 class="font-weight-bold">Restore</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class='colume-title'>Id</th>
                                    <th class='colume-title'>Image</th>
                                    <th class='colume-title'>Title</th>
                                    <th class='colume-title'>Filter</th>
                                    <th class='colume-title'>Status</th>
                                    <th class='colume-title'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($DataTranshed as $data)
                                    <tr class="even pointer">
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            <img width="100" src="{{ asset('/storage/portfolio/' . $data->image) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->filter }}</td>
                                        <td>{{ $data->status == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td class="last">
                                            <a href="{{ route('backend.portfolios.restore', $data->id) }}"
                                                class="btn btn-primary btn-sm">Restore</a>

                                            <button id="delete" value="{{ route('backend.portfolios.hardDelete', $data->id) }}" class="btn btn-danger btn-sm">Hard Delete</button>
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
