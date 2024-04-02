@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Volunteers</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Volunteers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="team pt_70">
    <div class="container">
        <div class="row">
            @foreach($volunteers as $volunteer)
            <div class="col-lg-3 col-md-6">
                <div class="item pb_50">
                    <div class="photo">
                        <img src="{{ asset('uploads/'.$volunteer->photo) }}" alt="" />
                    </div>
                    <div class="text">
                        <h2><a href="{{ route('volunteer',$volunteer->id) }}">{{ $volunteer->name }}</a></h2>
                        <div class="designation">{{ $volunteer->profession }}</div>
                        <div class="social">
                            <ul>
                                @if($volunteer->facebook != '')
                                <li><a href="{{ $volunteer->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif

                                @if($volunteer->twitter != '')
                                <li><a href="{{ $volunteer->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif

                                @if($volunteer->linkedin != '')
                                <li><a href="{{ $volunteer->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif

                                @if($volunteer->instagram != '')
                                <li><a href="{{ $volunteer->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-12">
                {{ $volunteers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection