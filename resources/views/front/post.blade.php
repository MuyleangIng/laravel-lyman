@extends('front.layouts.app')

@section('main_content')
<div class="page-top" style="background-image: url({{ asset('uploads/'.$global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $post->title }}</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                        <li class="breadcrumb-item active">{{ $post->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="post pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="left-item">
                    <div class="main-photo">
                        <img src="{{ asset('uploads/'.$post->photo) }}" alt="">
                    </div>
                    <div class="sub">
                        <ul>
                            <li><i class="fas fa-calendar-alt"></i> On: {{ $post_date }}</li>
                            <li><i class="fas fa-th-large"></i> Category: <a href="{{ route('category',$post->rPostCategory->slug) }}">{{ $post->rPostCategory->name }}</a></li>
                        </ul>
                    </div>
                    <div class="description">
                        {!! nl2br($post->description) !!}
                    </div>
                    <div class="tags" style="margin-top:30px;margin-bottom:15px;">
                        <h5>Tags:</h5>
                        @for($i=0;$i<count($post_tags);$i++)
                        <a href="{{ route('tag',$post_tags[$i]) }}" style="background:#1455c6;padding:5px 10px;color:#fff;border-radius:6px;">{{ $post_tags[$i] }}</a>
                        @endfor
                    </div>
                    <div class="comment">

                        <h2>{{ $total_comments }} Comments</h2>

                        @foreach($comments as $item)
                        <div class="comment-section">
                            <div class="comment-box d-flex justify-content-start">
                                <div class="left">
                                    @php
                                    $default = "";
                                    $size = 200;
                                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($item->email))) . "?d=" . urlencode($default) . "&s=" . $size;
                                    @endphp
                                    <img src="{{ $gravatar_url }}" alt="">
                                </div>
                                <div class="right">
                                    <div class="name">{{ $item->name }}</div>
                                    <div class="date">
                                        @php
                                        $date = \Carbon\Carbon::parse($item->created_at)->format('j F, Y');
                                        @endphp
                                        {{ $date }}
                                    </div>
                                    <div class="text">
                                        {!! nl2br($item->comment) !!}
                                    </div>
                                    <div class="reply">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#reply_modal{{$loop->iteration}}"><i class="fas fa-reply"></i> Reply</a>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="modal fade" id="reply_modal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Give a Reply</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('reply_submit') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{ $item->id }}">
                                                <div class="mb-3">
                                                    <input name="name" type="text" class="form-control" placeholder="Name">
                                                </div>
                                                <div class="mb-3">
                                                    <input name="email" type="text" class="form-control" placeholder="Email">
                                                </div>
                                                <div class="mb-3">
                                                    <textarea name="reply" class="form-control h_100" cols="30" rows="10"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                            $replies = App\Models\Reply::where('comment_id',$item->id)->get();
                            @endphp
                            @foreach($replies as $reply)
                            @php
                            if($reply->user_type == 'Admin')
                            {
                                $name = Auth::guard('admin')->user()->name;
                                $email = Auth::guard('admin')->user()->email;
                            } else {
                                $name = $reply->name;
                                $email = $reply->email;
                            }
                            
                            @endphp
                            <div class="comment-box reply-box d-flex justify-content-start">
                                <div class="left">
                                    @php
                                    $default = "";
                                    $size = 200;
                                    $gravatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
                                    @endphp
                                    <img src="{{ $gravatar_url }}" alt="">
                                </div>
                                <div class="right">
                                    <div class="name">
                                        {{ $name }}
                                        @if($reply->user_type == 'Admin')
                                        <span class="badge bg-primary">Admin</span>
                                        @endif
                                    </div>
                                    <div class="date">
                                        @php
                                        $date = \Carbon\Carbon::parse($reply->created_at)->format('j F, Y');
                                        @endphp
                                        {{ $date }}
                                    </div>
                                    <div class="text">
                                        {!! nl2br($reply->reply) !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach


                        <div class="mt_40"></div>

                        <h2>Leave Your Comment</h2>
                        <form action="{{ route('comment_submit') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input name="name" type="text" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input name="email" type="text" class="form-control" placeholder="Email Address">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea name="comment" class="form-control" rows="3" placeholder="Comment"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit <i class="fas fa-long-arrow-alt-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <div class="right-item">

                    <h2>Latest Posts</h2>
                    <ul>
                        @foreach($latest_posts as $latest_post)
                        <li><a href="{{ route('post',$latest_post->slug) }}"><i class="fas fa-angle-right"></i> {{ $latest_post->title }}</a></li>
                        @endforeach
                    </ul>

                    <h2 class="mt_40">Categories</h2>
                    <ul>
                        @foreach($post_categories as $post_category)
                        <li><a href="{{ route('category',$post_category->slug) }}"><i class="fas fa-angle-right"></i> {{ $post_category->name }}</a></li>
                        @endforeach
                    </ul>

                    <h2 class="mt_40">Tags</h2>
                    <ul class="tag">
                        @for($i=0;$i<count($tags);$i++)
                        <li><a href="{{ route('tag', $tags[$i]) }}">{{ $tags[$i] }}</a></li>
                        @endfor
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection