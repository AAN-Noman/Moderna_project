@extends('layouts.backendapp')
@section('title', 'Service Details | ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Service Details <a href="{{ route('backend.batman.create') }}" class='btn btn-primary btn-sm'>Add</a> </h2>
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
                                    <th class='colume-title'>link</th>
                                    <th class='colume-title'>Status</th>
                                    <th class='colume-title'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr class="even pointer">
                                        <td>{{ $data->id }}</td>
                                        <td>
                                            <img width="100" src="{{ asset('/storage/service_details/' . $data->photo) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ Str::limit($data->description, 25, '...') }}</td>
                                        <td>{{ Str::limit($data->link, 25, '...') }}</td>
                                        <td>{{ $data->status == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td class="last">
                                            <a href="{{ route('backend.batman.status', $data->id) }}"
                                                class="btn btn-{{ $data->status == 1 ? 'warning' : 'success' }} btn-sm">
                                                {{ $data->status == 1 ? 'Deactive' : 'Active' }}
                                            </a>
                                            <a href="{{ route('backend.batman.edit', $data->id) }}"
                                                class="btn btn-primary btn-sm">View/Edit</a>
                                            <form class='d-inline'
                                                action="{{ route('backend.batman.destroy', $data->id) }}" method='POST'>
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
                                    <th class='colume-title'>Title</th>
                                    <th class='colume-title'>Description</th>
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
                                            <img width="100" src="{{ asset('/storage/service_details/' . $data->photo) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ Str::limit($data->description, 25, '...') }}</td>
                                        <td>{{ Str::limit($data->link, 25, '...') }}</td>
                                        <td>{{ $data->status == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td class="last">
                                            <a href="{{ route('backend.batman.restore', $data->id) }}"
                                                class="btn btn-primary btn-sm">Restore</a>

                                            <button id="delete" value="{{ route('backend.batman.hardDelete', $data->id) }}" class="btn btn-danger btn-sm">Hard Delete</button>
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

