@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Edit Video</h1>
            <div>
                <a href="{{ route('admin_video_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_video_edit_submit',$video->id) }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Existing Video</label>
                                    <div>
                                        <iframe class="i1" width="200" height="100" src="https://www.youtube.com/embed/{{ $video->youtube_video_id }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Youtube Video Id *</label>
                                    <input type="text" name="youtube_video_id" class="form-control" value="{{ $video->youtube_video_id }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Select Category *</label>
                                    <select name="video_category_id" class="form-select">
                                        @foreach ($video_categories as $item)
                                            <option value="{{ $item->id }}" @if($item->id == $video->video_category_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection