@extends('front.layouts.app')

@section('main_content')
<div class="slider">
    <div class="slide-carousel owl-carousel">

        @foreach($slider as $slide)
        <div class="item" style="background-image:url('{{ asset('uploads/'.$slide->photo) }}');">
            <div class="bg"></div>
            <div class="text">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-wrapper">
                                <div class="text-content">
                                    <h2>{{ $slide->heading }}</h2>
                                    <p>
                                        {!! $slide->text !!}
                                    </p>
                                    <div class="button-style-1 mt_20">
                                        <a href="{{ $slide->button_link }}">{{ $slide->button_text }} <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>


@if($special->status == 'Show')
<div class="special pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="left-side">
                                <div class="inner">
                                    <h2>{{ $special->sub_heading }}</h2>
                                    <h3>{{ $special->heading }}</h3>
                                    {!! $special->text !!}
                                    <div class="button-style-1 mt_20">
                                        <a href="{{ $special->button_link }}">{{ $special->button_text }} <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right-side" style="background-image: url('{{ asset('uploads/'.$special->photo) }}');">
                                <a class="video-button" href="https://www.youtube.com/watch?v={{ $special->video_id }}"><span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@if($home_page_item->cause_status == 'Show')
<div class="cause pt_70">
    <div class="container">
        
        @if( $home_page_item->cause_heading != '' || $home_page_item->cause_subheading != '' )
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>{{ $home_page_item->cause_heading }}</h2>
                    <p>
                        {{ $home_page_item->cause_subheading }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            @foreach($featured_causes as $item)
            <div class="col-lg-4 col-md-6">
                <div class="item pb_70">
                    <div class="photo">
                        <img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="">
                    </div>
                    <div class="text">
                        <h2>
                            <a href="{{ route('cause', $item->slug) }}">{{ $item->name }}</a>
                        </h2>
                        <div class="short-des">
                            <p>
                                {!! nl2br($item->short_description) !!}
                            </p>
                        </div>
                        @php
                            $perc = ($item->raised / $item->goal) * 100;
                            $perc = ceil($perc);
                        @endphp
                        <div class="progress mb_10">
                            <div class="progress-bar w-0" role="progressbar" aria-label="Example with label" aria-valuenow="{{ $perc }}" aria-valuemin="0" aria-valuemax="100" style="animation: progressAnimation{{ $loop->iteration }} 2s linear forwards;"></div>
                            <style>
                                @keyframes progressAnimation{{ $loop->iteration }} {
                                    from {
                                        width: 0;
                                    }
                                    to {
                                        width: {{ $perc }}%;
                                    }
                                }
                            </style>
                        </div>
                        <div class="lbl mb_20">
                            <div class="goal">Goal: ${{ $item->goal }}</div>
                            <div class="raised">Raised: ${{ $item->raised }}</div>
                        </div>
                        <div class="button-style-2">
                            <a href="{{ route('cause', $item->slug) }}">Donate Now <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif


@if($home_page_item->feature_status == 'Show')
<div class="why-choose pt_70" style="background-image: url({{ asset('uploads/'.$home_page_item->feature_background) }})">
    <div class="container">
        <div class="row">
            @foreach($features as $feature)
            <div class="col-md-4">
                <div class="inner pb_70">
                    <div class="icon">
                        <i class="{{ $feature->icon }}"></i>
                    </div>
                    <div class="text">
                        <h2>{{ $feature->heading }}</h2>
                        <p>
                            {!! $feature->text !!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif


@if($home_page_item->event_status == 'Show')
<div class="event pt_70">
    <div class="container">

        @if( $home_page_item->event_heading != '' || $home_page_item->event_subheading != '' )
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>{{ $home_page_item->event_heading }}</h2>
                    <p>
                        {{ $home_page_item->event_subheading }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            @foreach($events as $item)
            @php
            $current_timestamp = strtotime(date('Y-m-d H:i'));
            $event_timestamp = strtotime($item->date.' '.$item->time);
            @endphp

            @if($event_timestamp < $current_timestamp)
            @continue
            @endif

            <div class="col-lg-4 col-md-6">
                <div class="item pb_70">
                    <div class="photo">
                        <img src="{{ asset('uploads/'.$item->featured_photo) }}" alt="">
                    </div>
                    <div class="text">
                        <h2>
                            <a href="{{ route('event', $item->slug) }}">{{ $item->name }}</a>
                        </h2>
                        <div class="date-time">
                            <i class="fas fa-calendar-alt"></i> 
                            @php
                            $date = \Carbon\Carbon::parse($item->date)->format('j M, Y');
                            $time = \Carbon\Carbon::parse($item->time)->format('h:i A');
                            @endphp
                            {{ $date }}, {{ $time }}
                        </div>
                        <div class="short-des">
                            <p>
                                {!! nl2br($item->short_description) !!}
                            </p>
                        </div>
                        <div class="button-style-2">
                            <a href="{{ route('event', $item->slug) }}">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif


@if($home_page_item->testimonial_status == 'Show')
<div class="testimonial pt_70 pb_70" style="background-image: url({{ asset('uploads/'.$home_page_item->testimonial_background) }})">
    <div class="bg"></div>
    <div class="container">
        
        @if($home_page_item->testimonial_heading != '')
        <div class="row">
            <div class="col-md-12">
                <h2 class="main-header">{{ $home_page_item->testimonial_heading }}</h2>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="testimonial-carousel owl-carousel">
                    @foreach($testimonials as $testimonial)
                    <div class="item">
                        <div class="photo">
                            <img src="{{ asset('uploads/'.$testimonial->photo) }}" alt="" />
                        </div>
                        <div class="text">
                            <h4>{{ $testimonial->name }}</h4>
                            <p>{{ $testimonial->designation }}</p>
                        </div>
                        <div class="description">
                            <p>
                                {!! $testimonial->comment !!}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@if($home_page_item->blog_status == 'Show')
<div class="blog pt_70">
    <div class="container">
        
        @if( $home_page_item->blog_heading != '' || $home_page_item->blog_subheading != '' )
        <div class="row">
            <div class="col-md-12">
                <div class="heading">
                    <h2>{{ $home_page_item->blog_heading }}</h2>
                    <p>
                        {{ $home_page_item->blog_subheading }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="row">
            @foreach($posts as $item)
            <div class="col-lg-4 col-md-6">
                <div class="item pb_70">
                    <div class="photo">
                        <img src="{{ asset('uploads/'.$item->photo) }}" alt="" />
                    </div>
                    <div class="text">
                        <h2>
                            <a href="{{ route('post',$item->slug) }}">{{ $item->title }}</a>
                        </h2>
                        <div class="short-des">
                            <p>
                                {!! nl2br($item->short_description) !!}
                            </p>
                        </div>
                        <div class="button-style-2 mt_20">
                            <a href="{{ route('post',$item->slug) }}">Read More <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection