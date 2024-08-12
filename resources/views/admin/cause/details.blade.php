@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="cause-detail pt_50 pb_50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="left-item">
                            <div class="main-photo">
                                <img src="{{ asset('uploads/'.$cause->featured_photo) }}" alt="">
                            </div>
                            <div class="py-4">
                                @if($cause->status === 'reject')
                                    <a href="{{ route('admin_undo_reject', $cause->id) }}" class="btn btn-primary btn-sm">Undo Reject</a>
                                @endif
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
                </div>
            </div>
        </div>
    </section>
</div>

@endsection