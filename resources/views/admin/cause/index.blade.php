@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Projects</h1>
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
                                                    <td><img src="{{ asset('uploads/' . $item->featured_photo) }}"
                                                            alt="" class="w_150"></td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>${{ $item->goal }}</td>
                                                    <td>${{ $item->raised }}</td>
                                                    <td>{{ $item->is_featured }}</td>
                                                    <td>
                                                        <a href="{{ route('admin_cause_photo', $item->id) }}"
                                                            class="btn btn-primary btn-sm w_100_p mb_5">Photo Gallery</a>
                                                        <a href="{{ route('admin_cause_video', $item->id) }}"
                                                            class="btn btn-success btn-sm w_100_p mb_5">Video Gallery</a>
                                                        <a href="{{ route('admin_cause_faq', $item->id) }}"
                                                            class="btn btn-info btn-sm w_100_p mb_5">FAQ</a>
                                                        <a href="{{ route('admin_cause_donations', $item->id) }}"
                                                            class="btn btn-warning btn-sm w_100_p mb_5">Donations</a>
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm w_100_p"
                                                            data-toggle="modal" data-id="{{ $item->id }}"
                                                            data-target="#reportModal">
                                                            Report
                                                        </a>

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
                                                <div class="modal" id="reportModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="reportModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Project Reporting</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Dynamic content will be loaded here -->
                                                                <div id="reportContent"></div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary">Save
                                                                    changes</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-button').click(function(event) {
                event.preventDefault(); // Prevent the default action

                var form = $(this).closest('form'); // Get the closest form to the clicked button

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit(); // Submit the form after confirmation
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#reportModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var causeId = button.data('id'); // Extract the cause_id

                // Clear any previous content
                $('#reportContent').html('');

                // AJAX request to fetch report data
                $.ajax({
                    url: '/admin/cause/report/' + causeId, // Adjust the URL to match your route
                    type: 'GET',
                    success: function(data) {
                        // Populate the modal with the retrieved data
                        $('#reportContent').html(data);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        $('#reportContent').html('<p>Error fetching report details.</p>');
                    }
                });
            });
        });
    </script>
@endsection
