@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Causes</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_causes }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Events</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_events }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_users }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Year Filter Form -->
            <form id="filter-form" action="{{ route('admin_dashboard') }}" method="GET">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="year">Select Year:</label>
                            <select class="form-control" id="year" name="year">
                                @for ($i = 2020; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}"
                                        {{ request()->get('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 align-self-end mb-4">
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    {!! $chart->container() !!}
                </div>

                <!-- Causes Area Chart -->
                <div class="col-xl-4 col-md-12">
                    {!! $causesAreaChart->container() !!}
                </div>

                <!-- Events Column Chart -->
                <div class="col-xl-4 col-md-12">
                    {!! $causesDonationsBarChart->container() !!}
                </div>
            </div>

            <!-- Volunteer Data Table -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Volunteers</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Profession</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Chart Scripts -->
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

    <script src="{{ $causesAreaChart->cdn() }}"></script>
    {{ $causesAreaChart->script() }}

    <script src="{{ $causesDonationsBarChart->cdn() }}"></script>
    {{ $causesDonationsBarChart->script() }}

    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin_dashboard') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'profession',
                        name: 'profession'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // SweetAlert delete button
            $(document).on('click', '.delete-button', function(event) {
                event.preventDefault();
                var deleteUrl = $(this).data('url');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this volunteer!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                swal("Volunteer deleted successfully!", {
                                    icon: "success",
                                });
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                swal("Error occurred while deleting!", {
                                    icon: "error",
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
