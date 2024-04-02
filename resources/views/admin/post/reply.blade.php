@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Replies</h1>
            <div>
                {{-- <a href="{{ route('admin_faq_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a> --}}
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
                                            <th>Reply</th>
                                            <th>Comment</th>
                                            <th>Post</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>User Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($replies as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $item->reply }}
                                            </td>
                                            <td>
                                                {{ $item->rComment->comment }}
                                            </td>
                                            <td>
                                                @php
                                                $post_data = App\Models\Post::where('id',$item->rComment->post_id)->first();
                                                @endphp
                                                {{ $post_data->title }}<br>
                                                <a href="{{ route('post',$post_data->slug) }}">See Post</a>
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->user_type }}</td>
                                            <td>
                                                @if ($item->status == "Active")
                                                    <a href="{{ route('admin_reply_status_change',$item->id) }}"><span class="badge badge-success">Active</span></a>
                                                @else
                                                    <a href="{{ route('admin_reply_status_change',$item->id) }}"><span class="badge badge-danger">Pending</span></a>
                                                @endif
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_reply_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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