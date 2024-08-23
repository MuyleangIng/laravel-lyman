@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Edit User</h1>
                <div>
                    <a href="{{ route('admin_user_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_user_edit_submit', $user->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <!-- Existing Photo -->
                                    <div class="form-group mb-3">
                                        <label>Existing Photo</label>
                                        <div>
                                            @if ($user->photo)
                                                <img src="{{ asset('uploads/' . $user->photo) }}" alt=""
                                                    class="w_200">
                                            @else
                                                <p>No photo available</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Change Photo -->
                                    <div class="form-group mb-3">
                                        <label>Change Photo</label>
                                        <div>
                                            <input type="file" name="photo">
                                        </div>
                                    </div>

                                    <!-- Name Field -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Name *</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $user->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ $user->phone }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- First Name Field -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ $user->first_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ $user->last_name }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
