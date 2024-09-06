@extends('front.layouts.app')

@section('main_content')
    <!-- START AWARDS SECTION -->
    <section class="section-awards text-center">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-12 col-md-10 col-lg-7">
                    <div class="header-section">
                        <div class="content">
                            <h2 class="title">Youth Achievement</h2>
                            <p class="description">We are proud to recognize three outstanding youths
                                who have submitted powerful projects that are making a positive impact on our community.
                                Most of their projects have been approved by the admin, and their contributions are driving
                                meaningful change.</p>
                        </div>
                        <span class="back-title">Awards</span>
                    </div>
                </div>
            </div>
            <div class="row no-gutters align-items-lg-center justify-content-around">
                <!-- start single award -->
                <div class="col-12 col-md-6 col-lg-4 mt-30">
                    @if ($topUsers->count() > 1)
                        <div class="single-award">
                            <img class="icon" src="{{ asset('uploads/' . $topUsers[1]->photo) }}" alt="">
                            <h3 class="title">{{ $topUsers[1]->name }}</h3>
                            <span class="date">Top 2</span>
                            <p class="description">{{ $topUsers[1]->quote ?? 'No description available.' }}</p>
                        </div>
                    @endif
                </div>

                <!-- Second (Top) User in the Center -->
                <div class="col-12 col-md-6 col-lg-4 mt-30">
                    @if ($topUsers->isNotEmpty())
                        <div class="single-award active">
                            <img class="icon" src="{{ asset('uploads/' . $topUsers[0]->photo) }}" alt="">
                            <h3 class="title">{{ $topUsers[0]->name }}</h3>
                            <span class="date">Top 1</span>
                            <p class="description">{{ $topUsers[0]->quote ?? 'No description available.' }}</p>
                            <a class="read-more" href="#">Read More</a>
                        </div>
                    @endif
                </div>

                <!-- Third User -->
                <div class="col-12 col-md-6 col-lg-4 mt-30">
                    @if ($topUsers->count() > 2)
                        <div class="single-award">
                            <img class="icon" src="{{ asset('uploads/' . $topUsers[2]->photo) }}" alt="">
                            <h3 class="title">{{ $topUsers[2]->name }}</h3>
                            <span class="date">Top 3</span>
                            <p class="description">{{ $topUsers[2]->quote ?? 'No description available.' }}</p>
                        </div>
                    @endif
                </div>
                <!-- / end single award -->
            </div>
        </div>
    </section>
    <!-- / END AWARDS SECTION -->
    <style>
        .mt-30 {
            margin-top: 30px;
        }

        .section-awards {
            position: relative;
            padding: 120px 0;
        }

        .section-awards .header-section {
            margin-bottom: 44px;
        }

        .section-awards .header-section .content {
            position: relative;
            z-index: 2;
        }

        .section-awards .header-section .title {
            font-family: "PT Serif", sans-serif;
            font-size: 60px;
            font-weight: 700;
            color: #2d2d2d;
        }

        .section-awards .header-section .description {
            font-size: 15px;
            color: #a2a2a2;
        }

        .section-awards .header-section .back-title {
            position: absolute;
            top: -40px;
            left: 50%;
            font-family: "PT Serif", sans-serif;
            font-size: 160px;
            color: #f3f3f3;
            transform: translateX(-50%);
            z-index: 1;
        }

        .section-awards .single-award {
            padding: 75px 50px;
            border-top: 6px solid #f7f7f7;
            border-bottom: 6px solid #f7f7f7;
        }

        .section-awards .no-gutters>div:first-child .single-award {
            border-left: 6px solid #f7f7f7;
        }

        .section-awards .no-gutters>div:last-child .single-award {
            border-right: 6px solid #f7f7f7;
        }

        .section-awards .active {
            border: 6px solid #157efb;
        }

        .section-awards .single-award .icon {
            height: 80px;
            width: 80px;
            margin-bottom: 40px;
            border-radius: 50%;
            /* Makes the image circular */
            object-fit: cover;
        }

        .section-awards .single-award .date {
            display: block;
            margin-bottom: 5px;
            color: #157efb;
        }

        .section-awards .single-award .title {
            font-family: "PT Serif", sans-serif;
            font-size: 30px;
            font-weight: 700;
        }

        .section-awards .single-award .description {
            font-size: 15px;
            color: #a2a2a2;
        }

        .section-awards .single-award .read-more {
            display: inline-block;
            text-decoration: none;
            margin-top: 18px;
            font-size: 17px;
            color: #777;
        }

        @media (max-width: 575.99px) {

            .section-awards .header-section .title {
                font-size: 38px;
            }

            .section-awards .header-section .back-title {
                font-size: 75px;
            }

            .section-awards .single-award:not(.active) {
                border: 6px solid #f7f7f7;
            }
        }

        @media (min-width: 576px) and (max-width: 767.99px) {

            .section-awards .header-section .title {
                font-size: 44px;
            }

            .section-awards .header-section .back-title {
                font-size: 90px;
            }

            .section-awards .single-award:not(.active) {
                border: 6px solid #f7f7f7;
            }
        }

        @media (min-width: 768px) and (max-width: 991.99px) {

            .section-awards .header-section .title {
                font-size: 47px;
            }

            .section-awards .header-section .back-title {
                font-size: 120px;
            }

            .section-awards .single-award:not(.active) {
                border: 6px solid #f7f7f7;
            }
        }

        @media (min-width: 992px) and (max-width: 1199.99px) {

            .section-awards .header-section .title {
                font-size: 50px;
            }

            .section-awards .header-section .back-title {
                font-size: 140px;
            }

            .section-awards .single-award {
                padding: 50px 30px;
            }

            .section-awards .single-award .title {
                margin-bottom: 20px;
                font-size: 27px;
            }

            .section-awards .single-award .read-more {
                margin-top: 10px;
            }
        }

        @media (min-width: 1200px) {}
    </style>
@endsection
