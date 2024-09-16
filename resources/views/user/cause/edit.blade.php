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

                                        <!-- Show the existing featured photo if it exists -->
                                        @if ($cause->featured_photo)
                                            <div class="mb-3">
                                                <img id="featuredPhoto"
                                                    src="{{ asset('uploads/' . $cause->featured_photo) }}"
                                                    alt="Featured Photo" width="200">
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <img id="featuredPhoto" src="" alt="No Photo" width="200"
                                                    style="display: none;">
                                            </div>
                                        @endif

                                        <!-- Input for uploading a new featured photo -->
                                        <input type="file" name="featured_photo" class="form-control"
                                            id="featuredPhotoInput" accept="image/*">
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
                                                            {{ in_array($audience->id, $selectedAudiences) ? 'selected' : '' }}>
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

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label>Existing Supporting Documents *</label>
                                    <div class="list-group mt-4">
                                        @foreach ($existingDocuments as $document)
                                            @php
                                                // Get the correct file path
                                                $filePath = public_path('uploads/supporting_documents/' . $document);

                                                // Get the file name without the path
                                                $fileName = basename($document);

                                                // Remove the prefix with numbers followed by 'supporting_document_XXXX_'
                                                $cleanFileName = preg_replace(
                                                    '/^\d+_supporting_document_\d+_/',
                                                    '',
                                                    $fileName,
                                                );

                                                // Initialize file size variable
                                                $formattedSize = 'Unknown size';

                                                // Check if the file exists and then get the size
                                                if (file_exists($filePath)) {
                                                    $fileSize = filesize($filePath); // Get size in bytes
                                                    $formattedSize = number_format($fileSize / 1024, 2) . ' KB'; // Convert to KB and format
                                                }
                                            @endphp
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <!-- Icon based on file type -->
                                                    <img src="{{ asset('uploads/file-icon.png') }}" alt="file-icon"
                                                        class="me-3" style="width: 50px; height: 50px;">

                                                    <div class="file-info">
                                                        <!-- Display the cleaned file name -->
                                                        <a href="{{ asset('uploads/supporting_documents/' . $document) }}"
                                                            target="_blank" class="text-truncate"
                                                            style="max-width: 250px; color: #007bff;">
                                                            {{ $cleanFileName }}
                                                        </a>
                                                        <div class="file-size">
                                                            {{ $formattedSize }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button"
                                                    onclick="removeDocument('{{ $document }}', {{ $cause->id }})"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update Supporting Document Section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin_cause_update_documents', $cause->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label>Update Supporting Document *</label>
                                        <input type="file" class="form-control mt-2" name="files[]" multiple>
                                        <small class="form-text text-muted">Upload new documents (e.g., budget plans,
                                            project reports)</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Documents</button>
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

        document.getElementById('featuredPhotoInput').addEventListener('change', function(event) {
            const input = event.target;
            const featuredPhoto = document.getElementById('featuredPhoto');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Replace the src of the existing image with the new uploaded image
                    featuredPhoto.src = e.target.result;
                    featuredPhoto.style.display = 'block'; // Ensure the image is visible
                };

                // Read the file as a Data URL
                reader.readAsDataURL(input.files[0]);
            } else {
                // Optionally hide the image if no file is selected
                featuredPhoto.style.display = 'none';
            }
        });

        function removeDocument(documentName, causeId) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this document!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    // Create a new form element
                    var form = document.createElement('form');
                    form.action = `/admin/causes/${causeId}/documents/${encodeURIComponent(documentName)}/delete`;
                    form.method = 'POST'; // Use POST for Laravel DELETE requests

                    // Add CSRF token input field
                    var csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}'; // Laravel CSRF token

                    // Add DELETE method input field
                    var methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    // Append input fields to form
                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);

                    // Append the form to the body
                    document.body.appendChild(form);

                    // Submit the form
                    form.submit();
                }
            });
        }
    </script>
@endsection
