@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Projects Approval</h1>
                <div>
                    <a href="{{ route('admin_cause_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                                <th>Status</th>
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
                                                        @if ($item->status == 'approve')
                                                            <span class="badge badge-success">Approved</span>
                                                        @elseif($item->status == 'reject')
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @else
                                                            <form method="POST"
                                                                action="{{ route('update_cause_status', $item->id) }}">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm"
                                                                    name="status" value="approve">Approve</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm reject-button"
                                                                    name="status" value="reject">Reject</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route('admin_cause_details', $item->slug) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fa-solid fa-eye"></i> View
                                                            </a>
                                                            @if ($item->status == 'reject')
                                                                <form method="POST"
                                                                    action="{{ route('admin_undo_reject', $item->id) }}"
                                                                    class="mr-4">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-warning btn-sm undo-button">
                                                                        <i class="fa-solid fa-rotate-left"></i> Undo Reject
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
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
            $('.reject-button').click(function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "Once rejected, this cause will be marked as rejected and the action cannot be undone!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willReject) => {
                    if (willReject) {
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'status',
                            value: 'reject'
                        }).appendTo(form);
                        form.submit();
                    }
                });
            });

            $('.approve-button').click(function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                $('<input>').attr({
                    type: 'hidden',
                    name: 'status',
                    value: 'approve'
                }).appendTo(form);
                form.submit();
            });

            $('.undo-button').click(function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to undo the rejection of this cause?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                }).then((willUndo) => {
                    if (willUndo) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
