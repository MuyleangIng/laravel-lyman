@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="cause-detail pt_50 pb_50">
                <div class="row align-items-start">
                    <div class="col-lg-8 m-15px-tb">
                        <article class="article">
                            <div class="article-img">
                                <img width="100%" height="700px" src="{{ asset('uploads/' . $cause->featured_photo) }}"
                                    alt="">
                            </div>
                            <div class="article-title">
                                <h6>Start Date: {{ $cause->start_date }} - End Date: {{ $cause->end_date }}</h6>
                            </div>
                            <div class="article-content">
                                <h4>Project Name *</h4>
                                <hr>
                                <p>{!! $cause->name !!}</p>

                                <h4>Short Description of Project *</h4>
                                <hr>
                                <p>{!! $cause->short_description !!}</p>

                                <h4>Objectives *</h4>
                                <hr>
                                <p>{{ $cause->objective }}</p>

                                <h4>Expectations *</h4>
                                <hr>
                                <p>{{ $cause->expectations }}</p>

                                <h4>Legal Considerations *</h4>
                                <hr>
                                <p>{{ $cause->legal_considerations }}</p>

                                <h4>Challenges and Solution *</h4>
                                <hr>
                                <p>{{ $cause->challenges_and_solution }}</p>

                                <h4>Partnerships and Collaborations *</h4>
                                <div class="widget-body">
                                    @foreach ($cause->partnershipsAndCollaborations as $partnership)
                                        <button class="btn btn-warning">{{ $partnership->name }}</button>
                                    @endforeach
                                </div>

                                <h4 class="mt-4">Target Audiences *</h4>
                                <div class="widget-body">
                                    @foreach ($cause->targetAudiences as $audience)
                                        <button class="btn btn-success">{{ $audience->name }}</button>
                                    @endforeach
                                </div>
                            </div>

                        </article>
                    </div>
                    <div class="col-lg-4 m-15px-tb blog-aside">
                        <!-- Author -->
                        <div class="widget widget-author">
                            <div class="widget-title">
                                <h3>Youth Profile</h3>
                            </div>
                            <div class="widget-body">
                                <div class="media align-items-center">
                                    <div class="avatar">
                                        <img src="{{ asset('uploads/' . $cause->user->photo) }}"
                                            alt="{{ $cause->user->name }}">
                                    </div>
                                </div>
                                <h4>{{ $cause->user->name }}</h4>
                                <!-- Display the user's quote or bio (assuming 'quote' or 'bio' is a field in the User model) -->
                                <p>{{ $cause->user->quote ?? 'No quote available' }}</p>

                            </div>
                        </div>
                        <!-- End Author -->

                        <!-- Photos of the project -->
                        <div class="widget widget-latest-post">
                            <div class="widget-title">
                                <h3>Photos</h3>
                            </div>
                            <div class="row">
                                @foreach ($cause_photos as $item)
                                    <a href="{{ asset('uploads/' . $item->photo) }}" data-toggle="lightbox"
                                        data-gallery="gallery" class="col-md-4">
                                        <img src="{{ asset('uploads/' . $item->photo) }}" class="img-fluid rounded">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Latest Post -->

                        <!-- Photos of the project -->
                        <div class="widget widget-latest-post">
                            <div class="widget-title">
                                <h3>Videos</h3>
                            </div>
                            <div class="row">
                                @foreach ($cause_videos as $item)
                                    <div class="col-md-6">
                                        <!-- 4:3 aspect ratio -->
                                        <div class="ratio ratio-4x3">
                                            <!-- Embed the YouTube video using an iframe -->
                                            <iframe src="https://www.youtube.com/embed/{{ $item->youtube_video_id }}"
                                                title="YouTube video" allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- End videos section -->

                        <!-- FAQ is started -->
                        <div class="widget widget-latest-post">
                            <div class="widget-title">
                                <h3>Frequently asked questions</h3>
                            </div>
                            <div class="row">
                                @foreach ($cause_faqs as $faq)
                                    <div class="col-12 col-xl-11">
                                        <div class="accordion accordion-flush" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading_{{ $loop->iteration }}">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse_{{ $loop->iteration }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse_{{ $loop->iteration }}">
                                                        {{ $faq->question }}
                                                    </button>
                                                </h2>
                                                <div id="collapse_{{ $loop->iteration }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading_{{ $loop->iteration }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        {!! $faq->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- End FAQ -->

                        <!-- Supporting Documents -->
                        <div class="widget widget-latest-post mt-4">
                            <div class="widget-title">
                                <h3>Supporting Documents</h3>
                            </div>
                            <div class="row">
                                @if (!empty($supporting_documents))
                                    @foreach ($supporting_documents as $document)
                                        @php
                                            // Get the correct file path
                                            $filePath = public_path('uploads/supporting_documents/' . $document);

                                            // Get the file name without the path
                                            $fileName = basename($document);

                                            // Remove the prefix 'supporting_document_XXXX_' if it exists
                                            $cleanFileName = preg_replace('/^supporting_document_\d+_/', '', $fileName);

                                            // Initialize file size variable
                                            $formattedSize = 'Unknown size';

                                            // Check if the file exists and then get the size
                                            if (file_exists($filePath)) {
                                                $fileSize = filesize($filePath); // Get size in bytes
                                                $formattedSize = number_format($fileSize / 1024, 2) . ' KB'; // Convert to KB and format
                                            }
                                        @endphp
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <a href="{{ asset('uploads/supporting_documents/' . $document) }}"
                                                target="_blank" class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/icon-document.png') }}"
                                                    class="img-fluid flex-shrink-0 mr-2" alt="Document Icon"
                                                    style="width: 50px; height: 50px;">
                                                <div>
                                                    <p class="mb-0 text-truncate">{{ $cleanFileName }}</p>
                                                    <small class="text-muted">{{ $formattedSize }}</small>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No supporting documents available.</p>
                                @endif
                            </div>
                        </div>
                        {{-- End Supporting Documents --}}


                    </div>
                </div>
            </div>
        </section>
    </div>
    <style>
        .row {
            margin: 15px;
        }

        .blog-grid {
            box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
            border-radius: 5px;
            overflow: hidden;
            background: #ffffff;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .blog-grid .blog-img {
            position: relative;
        }


        .blog-grid .blog-info {
            padding: 20px;
        }

        .blog-grid .blog-info h5 {
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 10px;
        }

        .blog-grid .blog-info h5 a {
            color: #20247b;
        }

        .blog-grid .blog-info p {
            margin: 0;
        }

        .blog-grid .blog-info .btn-bar {
            margin-top: 20px;
        }


        /* Blog Sidebar
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    -------------------*/
        .blog-aside .widget {
            box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
            border-radius: 5px;
            overflow: hidden;
            background: #ffffff;
            margin-top: 15px;
            margin-bottom: 15px;
            width: 100%;
            display: inline-block;
            vertical-align: top;
        }

        .blog-aside .widget-body {
            padding: 15px;
        }

        .blog-aside .widget-title {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .blog-aside .widget-title h3 {
            font-size: 20px;
            font-weight: 700;
            color: #fc5356;
            margin: 0;
        }

        .blog-aside .widget-author .media {
            margin-bottom: 15px;
        }

        .blog-aside .widget-author p {
            font-size: 16px;
            margin: 0;
        }

        .blog-aside .widget-author .avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
        }

        .blog-aside .widget-author h6 {
            font-weight: 600;
            color: #20247b;
            font-size: 22px;
            margin: 0;
            padding-left: 20px;
        }

        .blog-aside .post-aside {
            margin-bottom: 15px;
        }

        .blog-aside .post-aside .post-aside-title h5 {
            margin: 0;
        }

        .blog-aside .post-aside .post-aside-title a {
            font-size: 18px;
            color: #20247b;
            font-weight: 600;
        }

        .blog-aside .post-aside .post-aside-meta {
            padding-bottom: 10px;
        }

        .blog-aside .post-aside .post-aside-meta a {
            color: #6F8BA4;
            font-size: 12px;
            text-transform: uppercase;
            display: inline-block;
            margin-right: 10px;
        }

        .blog-aside .latest-post-aside+.latest-post-aside {
            border-top: 1px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }

        .blog-aside .latest-post-aside .lpa-right {
            width: 90px;
        }

        .blog-aside .latest-post-aside .lpa-right img {
            border-radius: 3px;
        }

        .blog-aside .latest-post-aside .lpa-left {
            padding-right: 15px;
        }

        .blog-aside .latest-post-aside .lpa-title h5 {
            margin: 0;
            font-size: 15px;
        }

        .blog-aside .latest-post-aside .lpa-title a {
            color: #20247b;
            font-weight: 600;
        }

        .blog-aside .latest-post-aside .lpa-meta a {
            color: #6F8BA4;
            font-size: 12px;
            text-transform: uppercase;
            display: inline-block;
            margin-right: 10px;
        }

        .tag-cloud a {
            padding: 4px 15px;
            font-size: 13px;
            color: #ffffff;
            background: #20247b;
            border-radius: 3px;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .tag-cloud a:hover {
            background: #fc5356;
        }

        .blog-single {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .article {
            box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
            border-radius: 5px;
            overflow: hidden;
            background: #ffffff;
            padding: 15px;
            margin: 15px 0 30px;
        }

        .article .article-title {
            padding: 15px 0 20px;
        }

        .article .article-title h6 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .article .article-title h6 a {
            text-transform: uppercase;
            color: #fc5356;
            border-bottom: 1px solid #fc5356;
        }

        .article .article-title h2 {
            color: #20247b;
            font-weight: 600;
        }

        .article .article-title .media {
            padding-top: 15px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 20px;
        }

        .article .article-title .media .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
        }

        .article .article-title .media .media-body label {
            font-weight: 600;
            color: #fc5356;
            margin: 0;
        }

        .article .article-title .media .media-body span {
            display: block;
            font-size: 12px;
        }

        .article .article-content h1,
        .article .article-content h2,
        .article .article-content h3,
        .article .article-content h4,
        .article .article-content h5,
        .article .article-content h6 {
            color: #20247b;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .px-btn {
            padding: 0 50px 0 20px;
            line-height: 60px;
            position: relative;
            display: inline-block;
            color: #20247b;
            background: none;
            border: none;
        }

        .px-btn:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            border-radius: 30px;
            background: transparent;
            border: 1px solid rgba(252, 83, 86, 0.6);
            border-right: 1px solid transparent;
            -moz-transition: ease all 0.35s;
            -o-transition: ease all 0.35s;
            -webkit-transition: ease all 0.35s;
            transition: ease all 0.35s;
            width: 60px;
            height: 60px;
        }

        .px-btn .arrow {
            width: 13px;
            height: 2px;
            background: currentColor;
            display: inline-block;
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto;
            right: 25px;
        }

        .px-btn .arrow:after {
            width: 8px;
            height: 8px;
            border-right: 2px solid currentColor;
            border-top: 2px solid currentColor;
            content: "";
            position: absolute;
            top: -3px;
            right: 0;
            display: inline-block;
            -moz-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
@endsection
