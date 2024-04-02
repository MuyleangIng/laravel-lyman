@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Create Video</h1>
            <div>
                <a href="{{ route('admin_video_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_video_create_submit') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Youtube Video Id *</label>
                                    <input type="text" name="youtube_video_id" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Select Category *</label>
                                    <select name="video_category_id" class="form-select">
                                        @foreach ($video_categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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