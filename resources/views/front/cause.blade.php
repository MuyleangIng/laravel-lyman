@extends('front.layouts.app')

@section('main_content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="page-top" style="background-image: url({{ asset('uploads/' . $global_setting_data->banner) }})">
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
                            <img src="{{ asset('uploads/' . $cause->featured_photo) }}" alt="">
                        </div>
                        @php
                            $perc = ($cause->raised / $cause->goal) * 100;
                            $perc = ceil($perc);
                        @endphp
                        <div class="progress mb_10">
                            <div class="progress-bar w-0" role="progressbar" aria-label="Example with label"
                                aria-valuenow="{{ $perc }}" aria-valuemin="0" aria-valuemax="100"
                                style="animation: progressAnimation1 2s linear forwards;"></div>
                            <style>
                                @keyframes progressAnimation1 {
                                    from {
                                        width: 0;
                                    }

                                    to {
                                        width: {{ $perc }}%;
                                    }
                                }
                            </style>
                        </div>
                        <div class="lbl mb_20">
                            <div class="goal">Goal: ${{ $cause->goal }}</div>
                            <div class="raised">Raised: ${{ $cause->raised }}</div>
                        </div>
                    </div>
                    <div class="left-item">
                        <h2>Objective</h2>
                        {{ $cause->objective }}
                    </div>
                    <div class="left-item">
                        <h2>Expectations</h2>
                        {!! $cause->expectations !!}
                    </div>
                    <div class="left-item">
                        <h2>Legal Considerations</h2>
                        {!! $cause->legal_considerations !!}
                    </div>
                    <div class="left-item">
                        <h2>Challenges and Solution</h2>
                        {!! $cause->legal_considerations !!}
                    </div>
                    <div class="left-item">
                        <h2>Target Audience</h2>
                        @foreach ($cause->targetAudiences as $audience)
                            <button class="btn btn-success">{{ $audience->name }}</button>
                        @endforeach
                    </div>

                    <div class="left-item">
                        <h2>Partnerships and Collaborations</h2>
                        @foreach ($cause->partnershipsAndCollaborations as $partnership)
                            <button class="btn btn-warning">{{ $partnership->name }}</button>
                        @endforeach
                    </div>

                    <div class="left-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Project Timeline</h6>
                                        <div id="content">
                                            <ul class="timeline">
                                                <li class="event" data-date="{{ $cause->start_date }}">
                                                    <h3>Start Date</h3>
                                                    <p>This is the date when the youth project officially begins. It marks
                                                        the commencement of all planned activities, initiatives, and
                                                        milestones.</p>
                                                </li>
                                                <li class="event" data-date="{{ $cause->end_date }}">
                                                    <h3>End Date</h3>
                                                    <p>This is the date when the youth project is scheduled to be completed.
                                                        By the end date, all activities and objectives outlined in the
                                                        project's plan should be achieved.</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="left-item">
                        <h2>Photos</h2>
                        <div class="photo-all">
                            <div class="row">
                                @foreach ($cause_photos as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="item">
                                            <a href="{{ asset('uploads/' . $item->photo) }}" class="magnific">
                                                <img src="{{ asset('uploads/' . $item->photo) }}" alt="" />
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
                        <h2>Videos</h2>
                        <div class="video-all">
                            <div class="row">
                                @foreach ($cause_videos as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="item">
                                            <div class="ratio ratio-4x3">
                                                <!-- Embed the YouTube video using an iframe -->
                                                <iframe src="https://www.youtube.com/embed/{{ $item->youtube_video_id }}"
                                                    title="YouTube video" allowfullscreen>
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="left-item faq-cause">
                        <h2>FAQ</h2>
                        <div class="accordion" id="accordionExample">
                            @foreach ($cause_faqs as $faq)
                                <div class="accordion-item mb_30">
                                    <h2 class="accordion-header" id="heading_{{ $loop->iteration }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse_{{ $loop->iteration }}" aria-expanded="false"
                                            aria-controls="collapse_{{ $loop->iteration }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse_{{ $loop->iteration }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading_{{ $loop->iteration }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="left-item">
                        <div class="card">
                            <div class="card-body p-4">
                                <h4 class="text-center mb-4 pb-2">Comments Section</h4>
                                @foreach ($comments as $comment)
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="d-flex flex-start">
                                                <!-- Commenter Avatar and Details -->
                                                <img class="rounded-circle shadow-1-strong me-3"
                                                    src="{{ asset('uploads/' . ($comment->user->photo ?? 'default.png')) }}"
                                                    alt="avatar" width="65" height="65" />
                                                <div class="flex-grow-1 flex-shrink-1">
                                                    <div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-1">
                                                                {{ $comment->user->name }} <span class="small">-
                                                                    {{ $comment->created_at->diffForHumans() }}</span>
                                                            </p>
                                                            <div class="dropdown">
                                                                <a href="#"
                                                                    id="dropdownMenuButton-{{ $comment->id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </a>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton-{{ $comment->id }}">
                                                                    <li><a class="dropdown-item" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#reply-form-{{ $comment->id }}">Reply</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" href="#">Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="#"
                                                                            onclick="event.preventDefault(); deleteCauseCommentOrReply({{ $comment->id }}, 'comment');">Delete</a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <p class="small mb-0">
                                                            {{ $comment->message }}
                                                        </p>
                                                    </div>

                                                    <!-- Replies Section -->
                                                    <div class="mt-4">
                                                        @foreach ($comment->replies as $reply)
                                                            <div class="d-flex flex-start mb-4">
                                                                <img class="rounded-circle shadow-1-strong me-3"
                                                                    src="{{ asset('uploads/' . ($reply->user->photo ?? 'default.png')) }}"
                                                                    alt="avatar" width="65" height="65" />
                                                                <div class="flex-grow-1 flex-shrink-1">
                                                                    <div>
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <p class="mb-1">
                                                                                {{ $reply->user->name }} <span
                                                                                    class="small">-
                                                                                    {{ $reply->created_at->diffForHumans() }}</span>
                                                                            </p>
                                                                            <div class="dropdown">
                                                                                <a href="#"
                                                                                    id="dropdownMenuButton-{{ $reply->id }}"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                                </a>
                                                                                <ul class="dropdown-menu"
                                                                                    aria-labelledby="dropdownMenuButton-{{ $reply->id }}">
                                                                                    <li><a class="dropdown-item"
                                                                                            href="#"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#reply-form-{{ $reply->id }}">Reply</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="#"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#edit-reply-{{ $reply->id }}">Edit</a>
                                                                                    </li>
                                                                                    <li><a class="dropdown-item"
                                                                                            href="#"
                                                                                            onclick="event.preventDefault(); deleteCauseCommentOrReply({{ $reply->id }}, 'reply');">Delete</a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <p class="small mb-0">
                                                                            {{ $reply->reply }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Nested Replies -->
                                                            <div class="mt-4">
                                                                @foreach ($reply->children as $childReply)
                                                                    <div class="d-flex flex-start mb-4">
                                                                        <img class="rounded-circle shadow-1-strong me-3"
                                                                            src="{{ asset('uploads/' . ($childReply->user->photo ?? 'default.png')) }}"
                                                                            alt="avatar" width="65"
                                                                            height="65" />
                                                                        <div class="flex-grow-1 flex-shrink-1">
                                                                            <div>
                                                                                <div
                                                                                    class="d-flex justify-content-between align-items-center">
                                                                                    <p class="mb-1">
                                                                                        {{ $childReply->user->name }} <span
                                                                                            class="small">-
                                                                                            {{ $childReply->created_at->diffForHumans() }}</span>
                                                                                    </p>
                                                                                    <div class="dropdown">
                                                                                        <a href="#"
                                                                                            id="dropdownMenuButton-{{ $childReply->id }}"
                                                                                            data-bs-toggle="dropdown"
                                                                                            aria-expanded="false">
                                                                                            <i
                                                                                                class="fas fa-ellipsis-v"></i>
                                                                                        </a>
                                                                                        <ul class="dropdown-menu"
                                                                                            aria-labelledby="dropdownMenuButton-{{ $childReply->id }}">
                                                                                            <li><a class="dropdown-item"
                                                                                                    href="#"
                                                                                                    data-bs-toggle="modal"
                                                                                                    data-bs-target="#edit-reply-{{ $childReply->id }}">Edit</a>
                                                                                            </li>
                                                                                            <li><a class="dropdown-item"
                                                                                                    href="#"
                                                                                                    onclick="event.preventDefault(); deleteCauseCommentOrReply({{ $childReply->id }}, 'reply');">Delete</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="small mb-0">
                                                                                    {{ $childReply->reply }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <!-- Modal for Reply Form (for Replies) -->
                                                            <div class="modal fade" id="reply-form-{{ $reply->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="replyFormLabel-{{ $reply->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="replyFormLabel-{{ $reply->id }}">
                                                                                Reply to {{ $reply->name }}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('replies.store') }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="comment_id"
                                                                                    value="{{ $reply->comment_id }}">
                                                                                <input type="hidden" name="parent_id"
                                                                                    value="{{ $reply->id }}">
                                                                                <div class="form-outline mb-4">
                                                                                    <textarea name="reply" class="form-control" rows="4" placeholder="Write your reply here" required></textarea>
                                                                                    <label class="form-label"
                                                                                        for="reply">Your reply</label>
                                                                                </div>
                                                                                <div class="text-start">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Submit
                                                                                        Reply</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal for Editing Reply -->
                                                            <div class="modal fade" id="edit-reply-{{ $reply->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="editReplyLabel-{{ $reply->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="editReplyLabel-{{ $reply->id }}">
                                                                                Edit Reply</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('replies.update', ['id' => $reply->id, 'type' => 'reply']) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('PATCH')
                                                                                <div class="form-outline mb-4">
                                                                                    <textarea name="reply" class="form-control" rows="4" required>{{ $reply->reply }}</textarea>
                                                                                    <label class="form-label"
                                                                                        for="reply">Your reply</label>
                                                                                </div>
                                                                                <div class="text-start">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Update
                                                                                        Reply</button>
                                                                                </div>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <!-- Modal for Reply Form (for Comments) -->
                                                    <div class="modal fade" id="reply-form-{{ $comment->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="replyFormLabel-{{ $comment->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="replyFormLabel-{{ $comment->id }}">Reply to
                                                                        Comment</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('replies.store') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="comment_id"
                                                                            value="{{ $comment->id }}">
                                                                        <input type="hidden" name="parent_id"
                                                                            value="">
                                                                        <div class="form-outline mb-4">
                                                                            <textarea name="reply" class="form-control" rows="4" placeholder="Write your reply here" required></textarea>
                                                                            <label class="form-label" for="reply">Your
                                                                                reply</label>
                                                                        </div>
                                                                        <div class="text-start">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Submit
                                                                                Reply</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal for Editing Comment -->
                                                    <div class="modal fade" id="edit-comment-{{ $comment->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="editCommentLabel-{{ $comment->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editCommentLabel-{{ $comment->id }}">Edit
                                                                        Comment</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('replies.update', ['id' => $comment->id, 'type' => 'comment']) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <div class="form-outline mb-4">
                                                                            <textarea name="message" class="form-control" rows="4" required>{{ $comment->message }}</textarea>
                                                                            <label class="form-label"
                                                                                for="message">Comment</label>
                                                                        </div>
                                                                        <div class="text-start">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Update
                                                                                Comment</button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="right-item">
                        <h2>Donate Now</h2>
                        <form id="donationForm" action="{{ route('donation_payment') }}" method="post">
                            @csrf
                            <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                            <div class="donate-sec">
                                <!-- Donation Amount Input -->
                                <h3>How much would you like to donate?</h3>
                                <div class="donate-box">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">$</span>
                                        <input name="price" type="text" class="form-control" id="donation-amount"
                                            required>
                                    </div>
                                </div>

                                <!-- Select an Amount Buttons -->
                                <h3>Select an Amount:</h3>
                                <div class="donate-select">
                                    <ul>
                                        <li>
                                            <button type="button" class="btn btn-primary donation-button"
                                                data-amount="10">$10</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-primary donation-button"
                                                data-amount="25">$25</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-primary donation-button selected"
                                                data-amount="50">$50</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-primary donation-button"
                                                data-amount="100">$100</button>
                                        </li>
                                        <li>
                                            <button type="button" class="btn btn-primary donation-button"
                                                data-amount="">Custom</button>
                                        </li>
                                    </ul>
                                </div>

                                <input type="hidden" name="send_invoice" id="sendInvoice" value="0">

                                <!-- Select Payment Method -->
                                <h3>Select Payment Method:</h3>
                                <div class="form-control">
                                    <select name="payment_method" class="form-select" required id="paymentMethod">
                                        <option value="">Select Payment Method</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="stripe">Stripe</option>
                                        <option value="payway">ABA</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <button type="button" class="btn btn-danger w-100-p donate-now"
                                    id="donatedNowButton">Donate
                                    Now</button>
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
                                        <td>${{ $cause->goal - $cause->raised }}</td>
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
                            @foreach ($recent_causes as $item)
                                <li><a href="{{ route('cause', $item->slug) }}"><i class="fas fa-angle-right"></i>
                                        {{ $item->name }}</a></li>
                            @endforeach
                        </ul>

                        <h2 class="mt_30">Cause Enquiry</h2>
                        <div class="enquiry-form">
                            <form action="{{ route('cause_send_message') }}" method="post">
                                @csrf
                                <input type="hidden" name="cause_id" value="{{ $cause->id }}">
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
    <form method="POST" target="aba_webservice" id="aba_merchant_request">
        @csrf
        <input type="hidden" name="hash" value="" id="hash" />
        <input type="hidden" name="tran_id" value="" id="tran_id" />
        <input type="hidden" name="amount" value="" id="amount" />
        <input type="hidden" name="firstname" value="" />
        <input type="hidden" name="lastname" value="" />
        <input type="hidden" name="phone" value="" />
        <input type="hidden" name="email" value="" />
        <input type="hidden" name="items" value="" id="items" />
        <input type="hidden" name="return_params" value="" />
        <input type="hidden" name="shipping" value="" />
        <input type="hidden" name="currency" value="" />
        <input type="hidden" name="type" value="" />
        <input type="hidden" name="payment_option" value="" />
        <input type="hidden" name="merchant_id" value="" />
        <input type="hidden" name="req_time" value="" />
    </form>

    <input type="button" id="checkout_button" value="Donate Now" style="display: none;">
    <script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
    <script>
        $(document).ready(function() {
            $("#donation-amount").val("50");
            $(".donation-button").on('click', function() {
                $(".donation-button").removeClass("selected");
                var amount = $(this).data("amount");
                $("#donation-amount").val(amount);
                $(this).addClass("selected");
                if (amount === "") {
                    $("#donation-amount").focus();
                }
            });
        });


        document.getElementById('donatedNowButton').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form from auto-submitting

            var paymentMethod = document.getElementById('paymentMethod').value;
            var donationForm = document.getElementById('donationForm');

            if (!paymentMethod) {
                alert('Please select a payment method');
                return; // Stop the function if no payment method is selected
            }

            // Prompt user to choose if they want to receive an invoice
            swal({
                title: "Receive Invoice",
                text: "Would you like to receive an invoice via email?",
                icon: "info",
                buttons: {
                    cancel: "No",
                    confirm: "Yes"
                }
            }).then((willSendInvoice) => {
                if (willSendInvoice) {
                    document.getElementById('sendInvoice').value = "1";
                }

                // Handle payment submission based on selected method
                if (paymentMethod === 'paypal' || paymentMethod === 'stripe') {
                    donationForm.submit(); // Directly submit the form for PayPal or Stripe
                } else if (paymentMethod === 'payway') {
                    processPayWayPayment(); // Call PayWay payment function
                }
            });
        });


        function processPayWayPayment() {
            let form = $('#donationForm');
            let formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    // Populate hidden form inputs with the PayWay response
                    $('#aba_merchant_request').attr('action', response.api_url);
                    $('#hash').val(response.hash);
                    $('#tran_id').val(response.transactionId);
                    $('#amount').val(response.amount);
                    $('input[name="firstname"]').val(response.firstName);
                    $('input[name="lastname"]').val(response.lastName);
                    $('input[name="phone"]').val(response.phone);
                    $('input[name="email"]').val(response.email);
                    $('#items').val(response.items);
                    $('input[name="return_params"]').val(response.return_params);
                    $('input[name="shipping"]').val(response.shipping);
                    $('input[name="currency"]').val(response.currency);
                    $('input[name="type"]').val(response.type);
                    $('input[name="payment_option"]').val(response.payment_option);
                    $('input[name="merchant_id"]').val(response.merchant_id);
                    $('input[name="req_time"]').val(response.req_time);

                    $('#checkout_button').click();
                },
                error: function() {
                    alert('There was an issue processing your request.');
                }
            });
        }

        $(document).ready(function() {
            @if (session('payment_success'))
                swal({
                    title: 'Thank you for your donation!',
                    text: 'Your generosity helps us make a difference. We appreciate your support!',
                    icon: 'success'
                });
                setTimeout(() => {
                    @php
                        session()->forget('payment_success');
                    @endphp
                }, 3000);
            @endif
        });

        $(document).ready(function() {
            $('#checkout_button').click(function() {
                AbaPayway.checkout();
            });
        });

        function deleteCauseCommentOrReply(id, type) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Create a form and submit it
                    var form = document.createElement('form');
                    form.action = `/cause/delete/${id}/${type}`;
                    form.method = 'DELETE';

                    // Add CSRF token
                    var csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);

                    // Add method spoofing input for DELETE request
                    var methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
