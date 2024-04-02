@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Events</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="event pt_70">
    <div class="container">
        <div class="row">

            @foreach($events as $item)
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
@endsection