@extends('layouts.backendapp')
@section('title', 'Contact | ')


@section('content')
    <div class="container">
        <div class="row">
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
                                    <th class='colume-title'>Name</th>
                                    <th class='colume-title'>Email</th>
                                    <th class='colume-title'>Subject</th>
                                    <th class='colume-title'>Message</th>
                                    <th class='colume-title'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr class="even pointer">
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->subject }}</td>
                                        <td>{{ $data->message }}</td>
                                        <td class="last">
                                            <button id="delete" value="{{ route('backend.message.hardDelete', $data->id) }}" class="btn btn-danger btn-sm">Delete</button>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('backend_css')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.min.css'></script>
@endsection

@section('backend_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.all.min.js"></script>

    <script>

        // alart
        let url = $('#delete').val(); //JavaScript
        $('#delete').on('click', function() { //JQuary
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; //return
                }
            })
        })
    </script>
@endsection

