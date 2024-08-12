@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Causes Approval</h1>
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
                                            <th>Status</th> <!-- Updated column heading -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($causes as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="" class="w_150">
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                <!-- Display buttons for approve and reject -->
                                                @if($item->status == 'approve')
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif($item->status == 'reject')
                                                    <span class="badge badge-danger">Rejected</span>
                                                @else
                                                    <form method="POST" action="{{ route('update_cause_status', $item->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm" name="status" value="approve">Approve</button>
                                                        <button type="submit" class="btn btn-danger btn-sm" name="status" value="reject">Reject</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_cause_details',$item->slug) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
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
