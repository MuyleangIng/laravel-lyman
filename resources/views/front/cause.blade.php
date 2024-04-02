@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $cause->name }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('causes') }}">Causes</a></li>
                        <li class="breadcrumb-item active">{{ $cause->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="cause-detail pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="left-item">
                    <div class="main-photo">
                        <img src="{{ asset('uploads/'.$cause->featured_photo) }}" alt="">
                    </div>
                    @php
                        $perc = ($cause->raised / $cause->goal) * 100;
                        $perc = ceil($perc);
                    @endphp
                    <div class="progress mb_10">
                        <div class="progress-bar w-0" role="progressbar" aria-label="Example with label" aria-valuenow="{{ $perc }}" aria-valuemin="0" aria-valuemax="100" style="animation: progressAnimation1 2s linear forwards;"></div>
                        <style>
                            @keyframes progressAnimation1 {from {width: 0;}to {width: {{ $perc }}%;}}
                        </style>
                    </div>
                    <div class="lbl mb_20">
                        <div class="goal">Goal: ${{ $cause->goal }}</div>
                        <div class="raised">Raised: ${{ $cause->raised }}</div>
                    </div>
                    {!! $cause->description !!}
                </div>
                <div class="left-item">
                    <h2>
                        Photos
                    </h2>
                    <div class="photo-all">
                        <div class="row">
                            @foreach($cause_photos as $item)
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ asset('uploads/'.$item->photo) }}" class="magnific">
                                        <img src="{{ asset('uploads/'.$item->photo) }}" alt="" />
                                        <div class="icon">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="bg"></div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="left-item">
                    <h2>
                        Videos
                    </h2>
                    <div class="video-all">
                        <div class="row">
                            @foreach($cause_videos as $item)
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a class="video-button" href="http://www.youtube.com/watch?v={{ $item->youtube_video_id }}">
                                        <img src="http://img.youtube.com/vi/{{ $item->youtube_video_id }}/0.jpg" alt="" />
                                        <div class="icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                        <div class="bg"></div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="left-item faq-cause">
                    <h2>
                        FAQ
                    </h2>
                    <div class="accordion" id="accordionExample">
                        @foreach($cause_faqs as $faq)
                        <div class="accordion-item mb_30">
                            <h2 class="accordion-header" id="heading_{{ $loop->iteration }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse_{{ $loop->iteration }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse_{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="heading_{{ $loop->iteration }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="right-item">
                    <h2>Donate Now</h2>
                    <form action="{{ route('donation_payment') }}" method="post">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <div class="donate-sec">
                            <h3>How much would you like to donate?</h3>
                            <div class="donate-box">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input name="price" type="text" class="form-control" id="donation-amount" required>
                                </div>
                            </div>
                            <h3>Select an Amount:</h3>
                            <div class="donate-select">
                                <ul>
                                    <li>
                                        <button type="button" class="btn btn-primary donation-button" data-amount="10">$10</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary donation-button" data-amount="25">$25</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary donation-button selected" data-amount="50">$50</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary donation-button" data-amount="100">$100</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-primary donation-button" data-amount="">Custom</button>
                                    </li>
                                </ul>
                            </div>
                            <h3>Select Payment Method:</h3>
                            <div class="form-control">
                                <select name="payment_method" class="form-select" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger w-100-p donate-now">Donate Now</button>
                        </div>
                    </form>
                    <h2 class="mt_30">Information</h2>
                    <div class="summary">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td><b>Goal</b></td>
                                    <td>${{ $cause->goal }}</td>
                                </tr>
                                <tr>
                                    <td><b>Raised</b></td>
                                    <td>${{ $cause->raised }}</td>
                                </tr>
                                <tr>
                                    <td><b>Remaining</b></td>
                                    <td>${{ ($cause->goal-$cause->raised) }}</td>
                                </tr>
                                <tr>
                                    <td><b>Percentage</b></td>
                                    @php
                                        $perc = ($cause->raised / $cause->goal) * 100;
                                        $perc = ceil($perc);
                                    @endphp
                                    <td>{{ $perc }}%</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    

                    <h2 class="mt_30">Recent Causes</h2>
                    <ul>
                        @foreach($recent_causes as $item)
                        <li><a href="{{ route('cause',$item->slug) }}"><i class="fas fa-angle-right"></i> {{ $item->name }}</a></li>
                        @endforeach
                    </ul>


                    <h2 class="mt_30">Cause Enquery</h2>
                    <div class="enquery-form">
                        <form action="{{ route('cause_send_message') }}" method="post">
                            @csrf
                            <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                            <div class="mb-3">
                                <input name="name" type="text" class="form-control" placeholder="Full Name" required>
                            </div>
                            <div class="mb-3">
                                <input name="email" type="email" class="form-control" placeholder="Email Address" required>
                            </div>
                            <div class="mb-3">
                                <input name="phone" type="text" class="form-control" placeholder="Phone Number (Optional)">
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control h-150" rows="3" placeholder="Message" required></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Send Message <i class="fas fa-long-arrow-alt-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $("#donation-amount").val("50");
    $(".donation-button").on('click',function () {
        $(".donation-button").removeClass("selected");
        var amount = $(this).data("amount");
        $("#donation-amount").val(amount);
        $(this).addClass("selected");
        if (amount === "") {
            $("#donation-amount").focus();
        }
    });
});
</script>
@endsection