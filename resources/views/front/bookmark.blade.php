@extends('front.layouts.app')

@section('main_content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page-top" style="background-image: url({{ asset('uploads/' . $global_setting_data->banner) }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Bookmark</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home ></a></li>
                            <li class="breadcrumb-item active">Bookmark</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="cause pt_70">
            <div class="row">
                @foreach ($causes as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="item pb_70">
                            <div class="photo">
                                <img src="{{ asset('uploads/' . $item->featured_photo) }}" alt="">
                            </div>
                            <div class="text">
                                <h2>
                                    <a href="{{ route('cause', $item->slug) }}">{{ $item->name }}</a>
                                </h2>

                                <!-- Icons for likes, views, and bookmark -->
                                <div class="icons mb_10 d-flex justify-content-between">
                                    <div class="{{ Auth::check() ? 'text-start' : 'text-start' }}">
                                        @auth
                                            <!-- Heart Icon Toggle (only shown if authenticated) -->
                                            <span class="like-btn" data-id="{{ $item->id }}">
                                                <i class="{{ $item->liked_by_user ? 'fas' : 'far' }} fa-heart"></i>
                                                <span class="like-count">{{ $item->likes }}</span> Likes
                                            </span>
                                        @endauth

                                        <!-- View Icon (always visible) -->
                                        <span style="margin-left: {{ Auth::check() ? '15px' : '0' }};">
                                            <i class="fas fa-eye"></i> {{ $item->views }} Views
                                        </span>
                                    </div>

                                    @auth
                                        <!-- Bookmark Icon aligned to the right (only shown if authenticated) -->
                                        <div class="text-end">
                                            <span class="bookmark-btn" data-id="{{ $item->id }}">
                                                <i class="{{ $item->bookmarked_by_user ? 'fas' : 'far' }} fa-bookmark"></i>
                                            </span>
                                        </div>
                                    @endauth
                                </div>

                                <div class="short-des">
                                    <p>{!! nl2br($item->short_description) !!}</p>
                                </div>
                                @php
                                    $perc = ($item->raised / $item->goal) * 100;
                                    $perc = ceil($perc);
                                @endphp
                                <div class="progress mb_10">
                                    <div class="progress-bar w-0" role="progressbar" aria-valuenow="{{ $perc }}"
                                        aria-valuemin="0" aria-valuemax="100"
                                        style="animation: progressAnimation{{ $loop->iteration }} 2s linear forwards;">
                                    </div>
                                    <style>
                                        @keyframes progressAnimation{{ $loop->iteration }} {
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
                                    <div class="goal">Goal: ${{ $item->goal }}</div>
                                    <div class="raised">Raised: ${{ $item->raised }}</div>
                                </div>
                                <div class="button-style-2">
                                    <a href="{{ route('cause', $item->slug) }}">Donate Now <i
                                            class="fas fa-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Controls -->
            @if ($causes->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!-- Previous Page Link -->
                            <li class="page-item {{ $causes->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $causes->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <!-- Page Numbers -->
                            @for ($i = 1; $i <= $causes->lastPage(); $i++)
                                <li class="page-item {{ $causes->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $causes->url($i) }}">{{ $i }}
                                        @if ($causes->currentPage() == $i)
                                            <span class="visually-hidden">(current)</span>
                                        @endif
                                    </a>
                                </li>
                            @endfor

                            <!-- Next Page Link -->
                            <li class="page-item {{ !$causes->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $causes->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <!-- JavaScript for Like Button -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likeButtons = document.querySelectorAll('.like-btn');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            likeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const causeId = this.getAttribute('data-id');
                    const likeCount = this.querySelector('.like-count');
                    const icon = this.querySelector('i');

                    // Send AJAX request to toggle like
                    fetch(`/causes/${causeId}/like`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => {
                            if (response.headers.get('content-type').includes('text/html')) {
                                throw new Error('Received HTML instead of JSON');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Update like count and toggle the heart icon
                            likeCount.textContent = data.likes;
                            icon.classList.toggle('fas');
                            icon.classList.toggle('far');
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });

        //Add to bookmark
        $(document).on('click', '.bookmark-btn', function() {
            var causeId = $(this).data('id');
            var bookmarkBtn = $(this);

            $.ajax({
                url: '/causes/' + causeId + '/bookmark',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.bookmarked) {
                        bookmarkBtn.find('i').removeClass('far').addClass(
                            'fas'); // Switch to solid icon
                    } else {
                        bookmarkBtn.find('i').removeClass('fas').addClass(
                            'far'); // Switch to regular icon
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        alert('You need to log in to bookmark a cause.');
                    }
                }
            });
        });
    </script>
@endsection
