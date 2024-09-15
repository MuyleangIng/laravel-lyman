@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Edit Project</h1>
                <a href="{{ route('user_cause') }}" class="btn btn-primary"><i class="fas fa-plus"></i> View All</a>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user_cause_edit_submit', $cause->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Featured Photo -->
                                    <div class="form-group mb-3">
                                        <label>Featured Photo *</label>
                                        <input type="file" name="featured_photo" class="form-control">
                                    </div>

                                    <!-- Name and Goal -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Name *</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', $cause->name) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Goal *</label>
                                                <input type="number" class="form-control" name="goal"
                                                    value="{{ old('goal', $cause->goal) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Short Description -->
                                    <div class="form-group mb-3">
                                        <label>Short Description *</label>
                                        <textarea name="short_description" class="form-control h_100" cols="30" rows="10" required>{{ old('short_description', $cause->short_description) }}</textarea>
                                    </div>

                                    <!-- Objective -->
                                    <div class="form-group mb-3">
                                        <label>Objective *</label>
                                        <input type="text" class="form-control" name="objective"
                                            value="{{ old('objective', $cause->objective) }}" required>
                                    </div>

                                    <!-- Expectations -->
                                    <div class="form-group mb-3">
                                        <label>Expectations *</label>
                                        <textarea name="expectations" class="form-control" cols="30" rows="10" required>{{ old('expectations', $cause->expectations) }}</textarea>
                                    </div>

                                    <!-- Legal and Ethical Considerations -->
                                    <div class="form-group mb-3">
                                        <label>Legal and Ethical Considerations</label>
                                        <textarea name="legal_considerations" class="form-control" cols="30" rows="5">{{ old('legal_considerations', $cause->legal_considerations) }}</textarea>
                                    </div>

                                    <!-- Challenges and Solutions -->
                                    <div class="form-group mb-3">
                                        <label>Challenges and Solutions</label>
                                        <textarea name="challenges_and_solution" class="form-control" cols="30" rows="5">{{ old('challenges_and_solution', $cause->challenges_and_solution) }}</textarea>
                                    </div>

                                    <!-- Target Audience, Partnerships, and Target Regions -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Target Audience</label>
                                                <select class="form-select" name="target_audience[]" id="target_audience"
                                                    multiple>
                                                    @foreach ($targetAudiences as $audience)
                                                        <option value="{{ $audience->id }}"
                                                            {{ in_array($audience->id, $cause->targetAudienceCategories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                            {{ $audience->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Partnerships and Collaborations</label>
                                                <select name="partnerships_and_collaborations[]" id="partnerships" multiple>
                                                    @foreach ($partnerships as $partnership)
                                                        <option value="{{ $partnership->id }}"
                                                            {{ in_array($partnership->id, $cause->partnershipsAndCollaborations->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                            {{ $partnership->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label>Target Regions</label>
                                                <select class="form-select" name="target_regions[]" id="target_regions"
                                                    multiple>
                                                    @foreach ($targetRegions as $region)
                                                        <option value="{{ $region->id }}"
                                                            {{ in_array($region->id, $cause->targetRegions->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                            {{ $region->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Supporting Documents -->
                                    <div class="form-group mb-3">
                                        <label>Supporting Documents</label>
                                        <input type="file" name="supporting_documents[]" class="form-control" multiple>
                                        <small class="form-text text-muted">Upload files as necessary. They will be saved as
                                            JSON.</small>
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

    <script>
        new MultiSelectTag('partnerships')
        new MultiSelectTag('target_audience')
        new MultiSelectTag('target_regions')
    </script>
@endsection
