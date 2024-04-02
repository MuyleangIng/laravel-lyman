@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Photo Gallery</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Photo Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content pt_40 pb_45">
    <div class="container">
        <div class="row">

            @foreach ($photo_categories as $photo_category)
            <div class="col-md-12 mb_15">
                <h2 class="photo-gallery-heading pt_30">{{ $photo_category->name }}</h2>
            </div>

            @foreach ($photo_category->rPhoto as $photo)
            <div class="col-md-6 col-lg-3">
                <div class="photo-gallery-item mb_25">
                    <div class="photo-gallery-item-bg"></div>
                    <a href="{{ asset('uploads/'.$photo->photo) }}" class="magnific" title="">
                        <img src="{{ asset('uploads/'.$photo->photo) }}">
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