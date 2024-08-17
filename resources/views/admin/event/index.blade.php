@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Events</h1>
                <div>
                    <a href="{{ route('admin_event_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Featured Photo</th>
                                                <th>Name</th>
                                                <th>Date & Time</th>
                                                <th>Price</th>
                                                <th>Total Seat</th>
                                                <th>Booked Seat</th>
                                                <th>Options</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . $item->featured_photo) }}"
                                                            alt="" class="w_150">
                                                    </td>
                                                    <td>
                                                        {{ $item->name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->date }} <br>
                                                        {{ $item->time }}
                                                    </td>
                                                    <td>
                                                        {{ $item->price }}
                                                    </td>
                                                    <td>
                                                        {{ $item->total_seat }}
                                                    </td>
                                                    <td>
                                                        {{ $item->booked_seat }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin_event_photo', $item->id) }}"
                                                            class="btn btn-primary btn-sm w_100_p mb_5">Photo Gallery</a>
                                                        <a href="{{ route('admin_event_video', $item->id) }}"
                                                            class="btn btn-success btn-sm w_100_p mb_5">Video Gallery</a>
                                                        <a href="{{ route('admin_event_tickets', $item->id) }}"
                                                            class="btn btn-warning btn-sm w_100_p">Tickets</a>
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_event_edit', $item->id) }}"
                                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin_event_delete', $item->id) }}"
                                                            class="btn btn-danger btn-sm delete-button"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $('.delete-button').click(function(event) {
                event.preventDefault(); 

                var form = $(this).closest(
                    'form');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this event!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
