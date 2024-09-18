@extends('admin.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Projects Approval</h1>
                <div>
                    <a href="{{ route('admin_cause_create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Featured Photo</th>
                                                <th>Name</th>
                                                <th>Approve</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($causes as $cause)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset('uploads/' . $cause->featured_photo) }}" alt="" class="w_150">
                                                    </td>
                                                    <td>{{ $cause->name }}</td>
                                                    <td>
                                                        <div class="outerDivFull">
                                                            <form action="{{ route('update_cause_status', $cause->id) }}" method="POST" class="status-form">
                                                                @csrf
                                                                <input type="hidden" name="status" class="status-input" value="{{ $cause->status }}">
                                                                <div class="switchToggle">
                                                                    <input type="checkbox" id="switch-{{ $cause->id }}" class="status-checkbox" {{ $cause->status == 'approve' ? 'checked' : '' }}>
                                                                    <label for="switch-{{ $cause->id }}">Toggle</label>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route('admin_cause_details', $cause->slug) }}" class="btn btn-primary btn-sm">
                                                                <i class="fa-solid fa-eye"></i> View
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Handle status toggle changes for causes
        document.querySelectorAll('.status-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const form = this.closest('.status-form');
                const statusInput = form.querySelector('.status-input');
                statusInput.value = this.checked ? 'approve' : 'reject';
                form.submit();
            });
        });
    </script>
@endsection
