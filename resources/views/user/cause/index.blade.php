@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Projects</h1>
                <div>
                    <a href="{{ route('user_cause_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                                <th>Status</th> 
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
                                                        @if ($item->status == 'pending')
                                                            <span class="badge badge-primary">Pending</span>
                                                        @elseif($item->status == 'reject')
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @elseif($item->status == 'approve')
                                                            <span class="badge badge-success">Approved</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('user_cause_photo', $item->id) }}"
                                                            class="btn btn-primary btn-sm w_100_p mb_5">Photo Gallery</a>
                                                        <a href="{{ route('user_cause_video', $item->id) }}"
                                                            class="btn btn-success btn-sm w_100_p mb_5">Video Gallery</a>
                                                        <a href="{{ route('user_cause_faq', $item->id) }}"
                                                            class="btn btn-info btn-sm w_100_p mb_5">FAQ</a>
                                                        <a href="{{ route('user_cause_report', $item->id) }}"
                                                            class="btn btn-warning btn-sm w_100_p mb_5">Report</a>
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        @if ($item->status == 'pending')
                                                            <a href="{{ route('user_cause_edit', $item->id) }}"
                                                                class="btn btn-primary btn-sm"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <a href="{{ route('user_cause_delete', $item->id) }}"
                                                                class="btn btn-danger btn-sm"
                                                                onClick="return confirm('Are you sure?');"><i
                                                                    class="fas fa-trash"></i></a>
                                                        @endif
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
@endsection
