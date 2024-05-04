@extends('user.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Cause ({{ $cause_single->name }}) Videos</h1>
            <div>
                <a href="{{ route('user_cause') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Causes</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user_cause_video_submit') }}" method="post">
                                @csrf
                                <input type="hidden" name="cause_id" value="{{ $cause_single->id }}">
                                <div class="form-group mb-3">
                                    <label>YouTube Video Id *</label>
                                    <input type="text" name="youtube_video_id" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Video Preview</th>
                                            <th>Video Id</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cause_videos as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <iframe class="i1" width="100%" height="auto" src="https://www.youtube.com/embed/{{ $item->youtube_video_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </td>
                                            <td>
                                                {{ $item->youtube_video_id }}
                                            </td>
                                            <td class="pt_10 pb_10">
                                                <a href="{{ route('admin_cause_video_delete',$item->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a>
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