@extends('layouts.backendapp')
@section('title', 'Why Us Index | ')
@section('content')

    <section>
        <div class="container">
            <div class='row'>
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>All Data <a href="{{ route('backend.ironman.create') }}" class='btn btn-primary btn-sm'>Add</a></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class='colume-title'>Id</th>
                                        <th class='colume-title'>Image</th>
                                        <th class='colume-title'>Title</th>
                                        <th class='colume-title'>Description</th>
                                        <th class='colume-title'>Icon</th>
                                        <th class='colume-title'>Title2</th>
                                        <th class='colume-title'>Description2</th>
                                        <th class='colume-title'>Icon2</th>
                                        <th class='colume-title'>Link</th>
                                        <th class='colume-title'>Status</th>
                                        <th class='colume-title'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datas as $data)
                                        <tr class="even pointer">
                                            <td>{{ $data->id }}</td>
                                            <td>
                                                <img width="100" src="{{ asset('storage/whyus/' . $data->photo) }}"
                                                    alt="">
                                            </td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ Str::limit($data->description, 25, '...') }}</td>
                                            <td>{{ $data->icon }}</td>
                                            <td>{{ $data->title2 }}</td>
                                            <td>{{ Str::limit($data->description2, 25, '...') }}</td>
                                            <td>{{ $data->icon2 }}</td>
                                            <td>{{ $data->link }}</td>
                                            <td><p class="text-{{ $data->status == 1 ? 'primary' : 'warning' }}">{{ $data->status == 1 ? 'Active' : 'Deactive' }}</p></td>
                                            <td class="last inline">
                                                <a href="{{ route('backend.ironman.status', $data->id) }}"
                                                    class="btn btn-{{ $data->status == 1 ? 'warning' : 'success' }} btn-sm">
                                                    {{ $data->status == 1 ? 'Deactive' : 'Active' }}
                                                </a>
                                                <a href="{{ route('backend.ironman.edit', $data->id) }}"
                                                    class="btn btn-primary btn-sm">View/Edit</a>
                                                <form class='d-inline'
                                                    action="{{ route('backend.ironman.destroy', $data->id) }}"
                                                    method='POST'>
                                                    @csrf
                                                    @method("DELETE")
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
                                        <th class='colume-title'>Title</th>
                                        <th class='colume-title'>Description</th>
                                        <th class='colume-title'>Icon</th>
                                        <th class='colume-title'>Title2</th>
                                        <th class='colume-title'>Description2</th>
                                        <th class='colume-title'>Icon2</th>
                                        <th class='colume-title'>Link</th>
                                        <th class='colume-title'>Status</th>
                                        <th class='colume-title'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($DataTranshed as $data)
                                        <tr class="even pointer">
                                            <td>{{ $data->id }}</td>
                                            <td>
                                                <img width="100" src="{{ asset('storage/whyus/' . $data->photo) }}"
                                                    alt="">
                                            </td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ Str::limit($data->description, 25, '...') }}</td>
                                            <td>{{ $data->icon }}</td>
                                            <td>{{ $data->title2 }}</td>
                                            <td>{{ Str::limit($data->description2, 25, '...') }}</td>
                                            <td>{{ $data->icon2 }}</td>
                                            <td>{{ $data->link }}</td>
                                            <td><p class="text-{{ $data->status == 1 ? 'primary' : 'warning' }}">{{ $data->status == 1 ? 'Active' : 'Deactive' }}</p></td>
                                            <td class="last inline-block">
                                                <a href="{{ route('backend.ironman.restore', $data->id) }}"
                                                    class="btn btn-primary btn-sm">Restore</a>

                                                <button id="delete" value="{{ route('backend.ironman.hardDelete', $data->id) }}" class="btn btn-danger btn-sm">Hard Delete</button>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </section>
    @if (session('success'))
        <div class="toast" style="position: absolute; top: 0; right: 0;" data-delay="10000">
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

@section('backend_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.css">
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
