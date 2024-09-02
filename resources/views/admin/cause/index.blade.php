@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Causes</h1>
                <div>
                    <a href="{{ route('admin_cause_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                    <a href="{{ route('admin_cause_export') }}" class="btn btn-success"><i
                            class="fa-solid fa-sheet-plastic"></i> Export</a>
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
                                                <th>Goal</th>
                                                <th>Raised</th>
                                                <th>Is Featured?</th>
                                                <th>Options</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($causes as $item)
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
                                                        ${{ $item->goal }}
                                                    </td>
                                                    <td>
                                                        ${{ $item->raised }}
                                                    </td>
                                                    <td>
                                                        {{ $item->is_featured }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin_cause_photo', $item->id) }}"
                                                            class="btn btn-primary btn-sm w_100_p mb_5">Photo Gallery</a>
                                                        <a href="{{ route('admin_cause_video', $item->id) }}"
                                                            class="btn btn-success btn-sm w_100_p mb_5">Video Gallery</a>
                                                        <a href="{{ route('admin_cause_faq', $item->id) }}"
                                                            class="btn btn-info btn-sm w_100_p mb_5">FAQ</a>
                                                        <a href="{{ route('admin_cause_donations', $item->id) }}"
                                                            class="btn btn-warning btn-sm w_100_p">Donations</a>
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('admin_cause_edit', $item->id) }}"
                                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin_cause_delete', $item->id) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm delete-button"
                                                                data-id="{{ $item->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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
                event.preventDefault(); // Prevent the default link action

                var button = $(this); // Get the button that was clicked
                var id = button.data('id'); // Get the ID of the cause

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: `/cause/delete/${id}`,
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                swal("Deleted!", response.message, "success").then(
                                    () => {
                                        location
                                            .reload(); // Reload the page after deletion
                                    });
                            },
                            error: function(xhr) {
                                swal("Oops!", "Something went wrong!", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
