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
                            <i class="fa-solid fa-hands-holding-child"></i>
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
                            <i class="fa-regular fa-calendar"></i>
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
                        <div class="card-icon bg-warning">
                            <i class="fa-regular fa-comments"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Testimonials</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_testimonials }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fa-solid fa-user"></i>
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
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fa-solid fa-people-carry-box"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Volunteers</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_volunteers }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fa-solid fa-people-roof"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Subscribers</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_subscribers }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Posts</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_posts }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fa-solid fa-image"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Photos</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_photos }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fa-solid fa-video"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Videos</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_videos }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    {!! $eventsBarChart->container() !!}
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

    <script src="{{ $eventsBarChart->cdn() }}"></script>
    {{ $eventsBarChart->script() }}

    <!-- Datatables Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin_dashboard') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'profession', name: 'profession' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'address', name: 'address' },
                    { data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });
        });
    </script>
@endsection