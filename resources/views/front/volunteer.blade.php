@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $volunteer->name }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('volunteers') }}">Volunteers</a></li>
                        <li class="breadcrumb-item active">{{ $volunteer->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="team-single pt_70 pb_70 bg_f3f3f3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="photo">
                    <img src="{{ asset('uploads/'.$volunteer->photo) }}" alt="">
                </div>
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Name</td>
                            <td>{{ $volunteer->name }}</td>
                        </tr>
                        <tr>
                            <td>Profession</td>
                            <td>{{ $volunteer->profession }}</td>
                        </tr>

                        @if($volunteer->address != '')
                        <tr>
                            <td>Address</td>
                            <td>{{ $volunteer->address }}</td>
                        </tr>
                        @endif

                        @if($volunteer->email != '')
                        <tr>
                            <td>Email Address</td>
                            <td>{{ $volunteer->email }}</td>
                        </tr>
                        @endif

                        @if($volunteer->phone != '')
                        <tr>
                            <td>Phone</td>
                            <td>{{ $volunteer->phone }}</td>
                        </tr>
                        @endif

                        @if($volunteer->website != '')
                        <tr>
                            <td>Website</td>
                            <td><a href="{{ $volunteer->website }}" target="_blank">{{ $volunteer->website }}</a></td>
                        </tr>
                        @endif

                        <tr>
                            <td>Social Media</td>
                            <td>
                                <ul>
                                    @if($volunteer->facebook != '')
                                    <li><a href="{{ $volunteer->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    @endif

                                    @if($volunteer->twitter != '')
                                    <li><a href="{{ $volunteer->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    @endif

                                    @if($volunteer->linkedin != '')
                                    <li><a href="{{ $volunteer->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    @endif

                                    @if($volunteer->instagram != '')
                                    <li><a href="{{ $volunteer->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        
            @if($volunteer->detail != '')
            <div class="col-md-12 mt_30">
                <h4>Detail</h4>
                <div class="description">
                    {!! nl2br($volunteer->detail) !!}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection