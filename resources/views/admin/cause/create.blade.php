@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Create Project</h1>
                <div>
                    <a href="{{ route('admin_cause_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_cause_create_submit') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label>Featured Photo *</label>
                                        <input type="file" name="featured_photo" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Name *</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Goal *</label>
                                                <input type="number" class="form-control" name="goal"
                                                    value="{{ old('goal') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Short Description *</label>
                                        <textarea name="short_description" class="form-control h_100" cols="30" rows="10" required>{{ old('short_description') }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Objective *</label>
                                        <input type="text" class="form-control" name="objective"
                                            value="{{ old('objective') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Expectations *</label>
                                        <textarea name="expectations" class="form-control" cols="30" rows="10" required>{{ old('expectations') }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Legal and Ethical Considerations</label>
                                        <textarea name="legal_considerations" class="form-control" cols="30" rows="5">{{ old('legal_considerations') }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Challenges and Solutions</label>
                                        <textarea name="challenges_and_solution" class="form-control" cols="30" rows="5">{{ old('challenges_and_solution') }}</textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Target Audience</label>
                                                <select class="form-select" name="target_audience[]" id="target_audience"
                                                    multiple>
                                                    @foreach ($targetAudiences as $audience)
                                                        <option value="{{ $audience->id }}">{{ $audience->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Partnerships and Collaborations</label>
                                                <select name="partnerships_and_collaborations[]" id="partnerships" multiple>
                                                    @foreach ($partnerships as $partnership)
                                                        <option value="{{ $partnership->id }}">{{ $partnership->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Start Date *</label>
                                                <input type="date" class="form-control" name="start_date"
                                                    value="{{ old('start_date') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>End Date *</label>
                                                <input type="date" class="form-control" name="end_date"
                                                    value="{{ old('end_date') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Supporting Documents</label>
                                        <input type="file" name="supporting_documents[]" class="form-control" multiple>
                                        <small class="form-text text-muted">Upload files as necessary. They will be saved as
                                            JSON.</small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Is Featured? *</label>
                                                <select name="is_featured" class="form-select">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>User *</label>
                                                <select name="user_id" class="form-select">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        new MultiSelectTag('partnerships')
        new MultiSelectTag('target_audience')
    </script>
@endsection
