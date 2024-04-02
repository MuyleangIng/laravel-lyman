<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ env('APP_NAME') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('uploads/'.$global_setting_data->favicon) }}">

        @include('front.layouts.styles')
        
        @include('front.layouts.scripts')

        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 left-side">
                        <ul>
                            @if($global_setting_data->top_phone!='')
                            <li class="phone-text"><i class="fas fa-phone"></i> {{ $global_setting_data->top_phone }}</li>
                            @endif

                            @if($global_setting_data->top_email!='')
                            <li class="email-text"><i class="fas fa-envelope"></i> {{ $global_setting_data->top_email }}</li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-6 right-side">
                        <ul class="right">
                            @if(Auth::guard('web')->check())
                            <li class="menu">
                                <a href="{{ route('user_dashboard') }}"><i class="fas fa-sign-in-alt"></i> Dashboard</a>
                            </li>
                            @else
                            <li class="menu">
                                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                            </li>
                            <li class="menu">
                                <a href="{{ route('register') }}"><i class="fas fa-user"></i> Sign Up</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('front.layouts.nav')

        @yield('main_content')

        @if($global_setting_data->cta_status == "Show")
        <div class="cta">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="left mt_50 mb_50 xs_mb_30">
                            <h2>{{ $global_setting_data->cta_heading }}</h2>
                            <p>
                                {!! nl2br($global_setting_data->cta_text) !!}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="right">
                            <div class="inner">
                                <a href="{{ $global_setting_data->cta_button_url }}">{{ $global_setting_data->cta_button_text }} <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="footer pt_70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Important Pages</h2>
                            <ul class="useful-links">
                                <li><a href="{{ route('home') }}"><i class="fas fa-angle-right"></i> Home</a></li>
                                <li><a href="{{ route('causes') }}"><i class="fas fa-angle-right"></i> Causes</a></li>
                                <li><a href="{{ route('events') }}"><i class="fas fa-angle-right"></i> Events</a></li>
                                <li><a href="{{ route('volunteers') }}"><i class="fas fa-angle-right"></i> Volunteers</a></li>
                                <li><a href="{{ route('blog') }}"><i class="fas fa-angle-right"></i> Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Useful Links</h2>
                            <ul class="useful-links">
                                <li><a href="{{ route('faqs') }}"><i class="fas fa-angle-right"></i> FAQ</a></li>
                                <li><a href="{{ route('terms') }}"><i class="fas fa-angle-right"></i> Terms and Conditions</a></li>
                                <li><a href="{{ route('privacy') }}"><i class="fas fa-angle-right"></i> Privacy Policy</a></li>
                                <li><a href="{{ route('about') }}"><i class="fas fa-angle-right"></i> About Us</a></li>
                                <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i> Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Contact</h2>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="right">
                                    {{ $global_setting_data->footer_address }}
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="right">{{ $global_setting_data->footer_phone }}</div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="right">{{ $global_setting_data->footer_email }}</div>
                            </div>
                            <ul class="social">
                                @if($global_setting_data->facebook != '')
                                <li><a href="{{ $global_setting_data->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif

                                @if($global_setting_data->twitter != '')
                                <li><a href="{{ $global_setting_data->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif

                                @if($global_setting_data->youtube != '')
                                <li><a href="{{ $global_setting_data->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                @endif

                                @if($global_setting_data->linkedin != '')
                                <li><a href="{{ $global_setting_data->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif

                                @if($global_setting_data->instagram != '')
                                <li><a href="{{ $global_setting_data->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="item pb_50">
                            <h2 class="heading">Newsletter</h2>
                            <p>
                                To get the latest news from our website, please
                                subscribe us here:
                            </p>
                            <form action="{{ route('subscriber_submit') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Subscribe Now">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="copyright">
                            {{ $global_setting_data->copyright }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="scroll-top">
            <i class="fas fa-angle-up"></i>
        </div>

        @include('front.layouts.scripts_footer')
    </body>
</html>
