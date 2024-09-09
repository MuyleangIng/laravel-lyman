@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Project Reporting</h1>
            </div>
            <div class="section-body">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Timeline start -->
                                <div class="timeline">

                                    <!-- Before report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            7:45 PM<small>Before Project</small>
                                        </div>
                                        <div class="timeline-dot fb-bg"></div>
                                        <div class="timeline-content">
                                            <i class="fa fa-map-marker"></i>
                                            <h4>Before Project Report</h4>
                                            <p>Submit the initial project report including goals, expectations, and
                                                challenges.</p>
                                            <button class="btn btn-primary mt-3" onclick="openReportForm('before')">
                                                Update Before Report
                                            </button>
                                        </div>
                                    </div>

                                    <!-- During report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            8:00 AM<small>During Project</small>
                                        </div>
                                        <div class="timeline-dot green-one-bg"></div>
                                        <div class="timeline-content green-one">
                                            <i class="fa fa-warning"></i>
                                            <h4>During Project Report</h4>
                                            <p>Submit updates on the project's progress, ongoing challenges, and solutions.
                                            </p>
                                            <button class="btn btn-danger mt-3" onclick="openReportForm('during')">
                                                Update During Report
                                            </button>
                                        </div>
                                    </div>

                                    <!-- After report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            7:25 PM<small>After Project</small>
                                        </div>
                                        <div class="timeline-dot green-two-bg"></div>
                                        <div class="timeline-content green-two">
                                            <i class="fa fa-list"></i>
                                            <h4>After Project Report</h4>
                                            <p>Submit the final report covering the project's outcomes, challenges faced,
                                                and solutions implemented.</p>
                                            <button class="btn btn-info mt-3" onclick="openReportForm('after')">
                                                Update After Report
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <!-- Timeline end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function openReportForm(stage) {
            // Replace this with the logic to open the form for the specific stage
            alert('Open report form for ' + stage);
        }
    </script>

    <style>
        .timeline {
            position: relative;
            padding: 10px;
            margin: 0 auto;
            overflow: hidden;
            color: #ffffff;
        }

        .timeline:after {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -1px;
            border-right: 2px dashed #c4d2e2;
            height: 100%;
            display: block;
        }

        .timeline-row {
            padding-left: 50%;
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-row .timeline-time {
            position: absolute;
            right: 50%;
            top: 31px;
            text-align: right;
            margin-right: 20px;
            color: #000000;
            font-size: 1.5rem;
        }

        .timeline-row .timeline-time small {
            display: block;
            font-size: .8rem;
            color: #8796af;
        }

        .timeline-row .timeline-content {
            position: relative;
            padding: 20px 30px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }

        .timeline-row .timeline-content:after {
            content: "";
            position: absolute;
            top: 20px;
            height: 3px;
            width: 40px;
        }

        .timeline-row .timeline-content:before {
            content: "";
            position: absolute;
            top: 20px;
            right: -50px;
            width: 20px;
            height: 20px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
            z-index: 100;
            background: #ffffff;
            border: 2px dashed #c4d2e2;
        }

        .timeline-row .timeline-content h4 {
            margin: 0 0 20px 0;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            line-height: 150%;
        }

        .timeline-row .timeline-content p {
            margin-bottom: 30px;
            line-height: 150%;
        }

        .timeline-row .timeline-content i {
            font-size: 2rem;
            color: #ffffff;
            line-height: 100%;
            padding: 10px;
            border: 2px solid #ffffff;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .timeline-row .timeline-content .thumbs {
            margin-bottom: 20px;
        }

        .timeline-row .timeline-content .thumbs img {
            margin-bottom: 10px;
        }

        .timeline-row:nth-child(even) .timeline-content {
            background-color: #ff5000;
            /* Fallback Color */
            background-image: -webkit-gradient(linear, left top, left bottom, from(#fc6d4c), to(#ff5000));
            /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient(top, #fc6d4c, #ff5000);
            /* Chrome 10+, Saf5.1+, iOS 5+ */
            background-image: -moz-linear-gradient(top, #fc6d4c, #ff5000);
            /* FF3.6 */
            background-image: -ms-linear-gradient(top, #fc6d4c, #ff5000);
            /* IE10 */
            background-image: -o-linear-gradient(top, #fc6d4c, #ff5000);
            /* Opera 11.10+ */
            background-image: linear-gradient(top, #fc6d4c, #ff5000);
            margin-left: 40px;
            text-align: left;
        }

        .timeline-row:nth-child(even) .timeline-content:after {
            left: -39px;
            border-right: 18px solid #ff5000;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
        }

        .timeline-row:nth-child(even) .timeline-content:before {
            left: -50px;
            right: initial;
        }

        .timeline-row:nth-child(odd) {
            padding-left: 0;
            padding-right: 50%;
        }

        .timeline-row:nth-child(odd) .timeline-time {
            right: auto;
            left: 50%;
            text-align: left;
            margin-right: 0;
            margin-left: 20px;
        }

        .timeline-row:nth-child(odd) .timeline-content {
            background-color: #5a99ee;
            /* Fallback Color */
            background-image: -webkit-gradient(linear, left top, left bottom, from(#1379bb), to(#5a99ee));
            /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient(top, #1379bb, #5a99ee);
            /* Chrome 10+, Saf5.1+, iOS 5+ */
            background-image: -moz-linear-gradient(top, #1379bb, #5a99ee);
            /* FF3.6 */
            background-image: -ms-linear-gradient(top, #1379bb, #5a99ee);
            /* IE10 */
            background-image: -o-linear-gradient(top, #1379bb, #5a99ee);
            /* Opera 11.10+ */
            background-image: linear-gradient(top, #1379bb, #5a99ee);
            margin-right: 40px;
            margin-left: 0;
            text-align: right;
        }

        .timeline-row:nth-child(odd) .timeline-content:after {
            right: -39px;
            border-left: 18px solid #1379bb;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
        }

        @media (max-width: 767px) {
            .timeline {
                padding: 15px 10px;
            }

            .timeline:after {
                left: 28px;
            }

            .timeline .timeline-row {
                padding-left: 0;
                margin-bottom: 16px;
            }

            .timeline .timeline-row .timeline-time {
                position: relative;
                right: auto;
                top: 0;
                text-align: left;
                margin: 0 0 6px 56px;
            }

            .timeline .timeline-row .timeline-time strong {
                display: inline-block;
                margin-right: 10px;
            }

            .timeline .timeline-row .timeline-icon {
                top: 52px;
                left: -2px;
                margin-left: 0;
            }

            .timeline .timeline-row .timeline-content {
                padding: 15px;
                margin-left: 56px;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
                position: relative;
            }

            .timeline .timeline-row .timeline-content:after {
                right: auto;
                left: -39px;
                top: 32px;
            }

            .timeline .timeline-row:nth-child(odd) {
                padding-right: 0;
            }

            .timeline .timeline-row:nth-child(odd) .timeline-time {
                position: relative;
                right: auto;
                left: auto;
                top: 0;
                text-align: left;
                margin: 0 0 6px 56px;
            }

            .timeline .timeline-row:nth-child(odd) .timeline-content {
                margin-right: 0;
                margin-left: 55px;
            }

            .timeline .timeline-row:nth-child(odd) .timeline-content:after {
                right: auto;
                left: -39px;
                top: 32px;
                border-right: 18px solid #5a99ee;
                border-left: inherit;
            }

            .timeline.animated .timeline-row:nth-child(odd) .timeline-content {
                left: 20px;
            }

            .timeline.animated .timeline-row.active:nth-child(odd) .timeline-content {
                left: 0;
            }
        }
    </style>
@endsection
