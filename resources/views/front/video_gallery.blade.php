@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Video Gallery</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Video Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content pt_40 pb_45">
    <div class="container">
        <div class="row">

            @foreach ($video_categories as $video_category)
            <div class="col-md-12 mb_15">
                <h2 class="video-gallery-heading pt_30">{{ $video_category->name }}</h2>
            </div>

            @foreach ($video_category->rVideo as $video)
            <div class="col-md-6 col-lg-3">
                <div class="video-gallery-item mb_25">
                    <div class="video-gallery-item-bg"></div>
                    <a class="video-button" href="http://www.youtube.com/watch?v={{ $video->youtube_video_id }}">
                        <img src="http://img.youtube.com/vi/{{ $video->youtube_video_id }}/0.jpg">
                        <div class="plus-icon"><i class="fas fa-search-plus"></i></div>
                    </a>
                </div>
            </div>
            @endforeach
            
            @endforeach

        </div>
    </div>
</div>
@endsection