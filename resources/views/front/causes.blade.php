@extends('front.layouts.app')

@section('main_content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="page-top" style="background-image: url({{ asset('uploads/' . $global_setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Proposal</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active"> Proposal</li>
                    </ol>
                </div>
                <div class="container">
                    <div class="row height d-flex justify-content-center align-items-center">
                        <div class="col-md-6 mt-2">
                            <div class="form">
                                <form action="{{ route('causes') }}" method="GET">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="search" class="form-control form-input" 
                                           placeholder="Search for a project..." 
                                           value="{{ request()->input('search') }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($causes->isEmpty())
                    <p>No projects found for "{{ request()->input('search') }}".</p>
                @endif
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
                                <div class="text-start">
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
                                $perc = $item->goal > 0 ? ceil(($item->raised / $item->goal) * 100) : 0;
                            @endphp
                            <div class="progress mb_10">
                                <div class="progress-bar w-0" role="progressbar" aria-label="Example with label"
                                    aria-valuenow="{{ $perc }}" aria-valuemin="0" aria-valuemax="100"
                                    style="animation: progressAnimation{{ $loop->iteration }} 2s linear forwards;">
                                </div>
                                <style>
                                    @keyframes progressAnimation{{ $loop->iteration }} {
                                        from { width: 0; }
                                        to { width: {{ $perc }}%; }
                                    }
                                </style>
                            </div>

                            <div class="lbl mb_20">
                                <div class="goal">Goal: ${{ $item->goal }}</div>
                                <div class="raised">Raised: ${{ $item->raised }}</div>
                            </div>

                            <div class="button-style-2">
                                <a href="{{ route('cause', $item->slug) }}">Donate Now 
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </a>
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

<style>
    .form {
        position: relative;
    }
    .form .fa-search {
        position: absolute;
        top: 20px;
        left: 20px;
        color: #9ca3af;
    }
    .form-input {
        height: 55px;
        text-indent: 33px;
        border-radius: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const likeButtons = document.querySelectorAll('.like-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        likeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const causeId = this.getAttribute('data-id');

                fetch(`/causes/${causeId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ cause_id: causeId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Toggle heart icon class and update like count
                        const icon = this.querySelector('i');
                        icon.classList.toggle('fas');
                        icon.classList.toggle('far');
                        const likeCountElement = this.querySelector('.like-count');
                        likeCountElement.textContent = data.likes;
                    } else {
                        alert('You need to be logged in to like a project.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while trying to like the project.');
                });
            });
        });
    });

    const bookmarkButtons = document.querySelectorAll('.bookmark-btn');

    bookmarkButtons.forEach(button => {
        button.addEventListener('click', function() {
            const causeId = this.getAttribute('data-id');

            fetch(`/causes/${causeId}/bookmark`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ cause_id: causeId }),
            })
            .then(response => {
                if (response.ok) {
                    // Toggle bookmark icon class
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fas');
                    icon.classList.toggle('far');
                } else {
                    alert('An error occurred while trying to bookmark the project.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while trying to bookmark the project.');
            });
        });
    });
</script>
@endsection
