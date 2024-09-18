@extends('front.layouts.app')

@section('main_content')
    <div class="page-top" style="background-image: url({{ asset('uploads/' . $global_setting_data->banner) }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Volunteers</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Volunteers</li>
                        </ol>
                    </div>
                    <div class="breadcrumb-container text-center mt-2">
                        <!-- Become a volunteer button -->
                        @auth
                            @php
                                // Fetch the authenticated user's volunteer data
                                $volunteer = Auth::user()->volunteer;
                            @endphp

                            @if (!$volunteer || (!$volunteer->cv_file && $volunteer->status !== 'approve'))
                                <!-- Show the button only if the user is not a volunteer or has no CV and is not approved -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#volunteerModal">
                                    <i class="fas fa-file"></i> Become Volunteer?
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="team pt_70">
        <div class="container">
            <div class="row">
                @foreach ($volunteers as $volunteer)
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                            <div class="photo">
                                <img src="{{ asset('uploads/' . $volunteer->photo) }}" alt="" />
                            </div>
                            <div class="text">
                                <h2><a href="{{ route('volunteer', $volunteer->id) }}">{{ $volunteer->name }}</a></h2>
                                <div class="designation">{{ $volunteer->profession }}</div>
                                <div class="social">
                                    <ul>
                                        @if ($volunteer->facebook)
                                            <li><a href="{{ $volunteer->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        @if ($volunteer->twitter)
                                            <li><a href="{{ $volunteer->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                        @endif
                                        @if ($volunteer->linkedin)
                                            <li><a href="{{ $volunteer->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                        @endif
                                        @if ($volunteer->instagram)
                                            <li><a href="{{ $volunteer->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-12">
                    {{ $volunteers->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for CV Upload (moved outside of the loop) -->
    <div class="modal fade" id="volunteerModal" tabindex="-1" role="dialog" aria-labelledby="volunteerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="volunteerModalLabel">Upload your CV to Become a Volunteer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- CV upload form -->
                    <form action="{{ route('volunteer.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cv">Upload CV</label>
                            <input type="file" name="cv" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
@endsection
