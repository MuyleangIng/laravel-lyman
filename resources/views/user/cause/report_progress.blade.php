@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Project Reporting</h1>
            </div>
            <div class="section-body">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Timeline start -->
                                <div class="timeline">

                                    <!-- Before report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            {{ \Carbon\Carbon::parse($cause->start_date)->format('Y-m-d') }}<small>Before
                                                Project</small>
                                        </div>
                                        <div class="timeline-dot fb-bg"></div>
                                        <div class="timeline-content">
                                            <i class="fa fa-map-marker"></i>
                                            <h4>Initial Project Report</h4>
                                            <p>Provide a detailed report outlining the project goals, anticipated
                                                challenges, and initial plans before the project officially starts.</p>
                                            @if (in_array('before', $submittedReports))
                                                <button class="btn btn-secondary mt-3" disabled>Report Submitted</button>
                                            @else
                                                <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                                    data-bs-target="#beforeReportModal">
                                                    Update Before Report
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- During report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            {{ $middleDate->format('Y-m-d') }}<small>During Project</small>
                                        </div>
                                        <div class="timeline-dot green-one-bg"></div>
                                        <div class="timeline-content green-one">
                                            <i class="fa fa-warning"></i>
                                            <h4>Progress Report</h4>
                                            <p>Share updates on the progress of the project, including any obstacles
                                                encountered and strategies implemented to address them.
                                            </p>
                                            @if (in_array('during', $submittedReports))
                                                <button class="btn btn-secondary mt-3" disabled>Report Submitted</button>
                                            @else
                                                <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                                    data-bs-target="#duringReportModal">
                                                    Update During Report
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- After report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            {{ \Carbon\Carbon::parse($cause->end_date)->format('Y-m-d') }}<small>Final
                                                Project Report</small>
                                        </div>
                                        <div class="timeline-dot green-two-bg"></div>
                                        <div class="timeline-content green-two">
                                            <i class="fa fa-list"></i>
                                            <h4>After Project Report</h4>
                                            <p>Submit a comprehensive report summarizing the project's outcomes, challenges
                                                faced, and solutions implemented. Reflect on the overall impact and lessons
                                                learned.</p>
                                            @if (in_array('after', $submittedReports))
                                                <button class="btn btn-secondary mt-3" disabled>Report Submitted</button>
                                            @else
                                                <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                                    data-bs-target="#afterReportModal">
                                                    Update After Report
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <!-- Timeline end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal for Before Report -->
    <div class="modal fade" id="beforeReportModal" tabindex="-1" aria-labelledby="beforeReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beforeReportLabel">Before Project Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <input type="hidden" name="report_type" value="before">
                        <div class="form-outline mb-4">
                            <textarea name="report" class="form-control" rows="4" placeholder="Write your before project report here"
                                required></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="challenges" class="form-control" rows="3" placeholder="Challenges faced"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="solutions" class="form-control" rows="3" placeholder="Proposed solutions"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="file" name="images[]" id="beforeReportImages" class="form-control" multiple
                                required>
                            <div id="beforeReportPreview" class="mt-2"></div>
                        </div>
                        @if (in_array('after', $submittedReports))
                            <button class="btn btn-secondary mt-3" disabled>Report Submitted</button>
                        @else
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#duringReportModal">
                                Update Before Report
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for During Report -->
    <div class="modal fade" id="duringReportModal" tabindex="-1" aria-labelledby="duringReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="duringReportLabel">During Project Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <input type="hidden" name="report_type" value="before">
                        <div class="form-outline mb-4">
                            <textarea name="report" class="form-control" rows="4" placeholder="Write your during project report here"
                                required></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="challenges" class="form-control" rows="3" placeholder="Challenges faced"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="solutions" class="form-control" rows="3" placeholder="Proposed solutions"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="file" name="images[]" id="duringReportImages" class="form-control" multiple
                                required>
                            <div id="duringReportPreview" class="mt-2"></div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-danger">Submit After Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for After Report -->
    <div class="modal fade" id="afterReportModal" tabindex="-1" aria-labelledby="afterReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="afterReportLabel">After Project Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <input type="hidden" name="report_type" value="before">
                        <div class="form-outline mb-4">
                            <textarea name="report" class="form-control" rows="4" placeholder="Write your after project report here"
                                required></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="challenges" class="form-control" rows="3" placeholder="Challenges faced"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="solutions" class="form-control" rows="3" placeholder="Proposed solutions"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="file" name="images[]" id="afterReportImages" class="form-control" multiple
                                required>
                            <div id="afterReportPreview" class="mt-2"></div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-info">Submit After Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImages(input, previewContainerId) {
            const previewContainer = document.getElementById(previewContainerId);
            previewContainer.innerHTML = ""; // Clear any existing previews

            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.style.width = "100px";
                        img.style.height = "100px";
                        img.style.margin = "5px";
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        document.getElementById('beforeReportImages').addEventListener('change', function() {
            previewImages(this, 'beforeReportPreview');
        });

        document.getElementById('duringReportImages').addEventListener('change', function() {
            previewImages(this, 'duringReportPreview');
        });

        document.getElementById('afterReportImages').addEventListener('change', function() {
            previewImages(this, 'afterReportPreview');
        });
    </script>
@endsection
