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

                                    <!-- Initial report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            {{ \Carbon\Carbon::parse($cause->start_date)->format('Y-m-d') }}<small>Initial
                                                Project</small>
                                        </div>
                                        <div class="timeline-dot fb-bg"></div>
                                        <div class="timeline-content">
                                            <i class="fa fa-map-marker"></i>
                                            <h4>Initial Project Report</h4>
                                            <p>Provide a detailed report outlining the project goals, anticipated
                                                challenges, and initial plans before the project officially starts.</p>
                                            @if (in_array('initial', $submittedReports))
                                                <button class="btn btn-secondary mt-3" disabled>Report Submitted</button>
                                            @else
                                                <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                                    data-bs-target="#initialReportModal">
                                                    Update Initial Report
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Progress report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            {{ $middleDate->format('Y-m-d') }}<small>Progress Project</small>
                                        </div>
                                        <div class="timeline-dot green-one-bg"></div>
                                        <div class="timeline-content green-one">
                                            <i class="fa fa-warning"></i>
                                            <h4>Progress Report</h4>
                                            <p>Share updates on the progress of the project, including any obstacles
                                                encountered and strategies implemented to address them.
                                            </p>
                                            @if (in_array('progress', $submittedReports))
                                                <button class="btn btn-secondary mt-3" disabled>Report Submitted</button>
                                            @else
                                                <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                                    data-bs-target="#progressReportModal">
                                                    Update Progress Report
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Final report -->
                                    <div class="timeline-row">
                                        <div class="timeline-time">
                                            {{ \Carbon\Carbon::parse($cause->end_date)->format('Y-m-d') }}<small>Final
                                                Project Report</small>
                                        </div>
                                        <div class="timeline-dot green-two-bg"></div>
                                        <div class="timeline-content green-two">
                                            <i class="fa fa-list"></i>
                                            <h4>Final Project Report</h4>
                                            <p>Submit a comprehensive report summarizing the project's outcomes, challenges
                                                faced, and solutions implemented. Reflect on the overall impact and lessons
                                                learned.</p>
                                            @if (in_array('final', $submittedReports))
                                                <button class="btn btn-secondary mt-3" disabled>Report Submitted</button>
                                            @else
                                                <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                                    data-bs-target="#finalReportModal">
                                                    Update Final Report
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

    <!-- Modal for Initial Report -->
    <div class="modal fade" id="initialReportModal" tabindex="-1" aria-labelledby="initialReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="initialReportLabel">Initial Project Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <input type="hidden" name="report_type" value="initial">
                        <div class="form-outline mb-4">
                            <textarea name="report" class="form-control" rows="4" placeholder="Write your initial project report here"
                                required></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="challenges" class="form-control" rows="3" placeholder="Challenges faced"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="solutions" class="form-control" rows="3" placeholder="Proposed solutions"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="file" name="images[]" id="initialReportImages" class="form-control" multiple
                                required>
                            <div id="initialReportPreview" class="mt-2"></div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-primary">Submit Initial Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Progress Report -->
    <div class="modal fade" id="progressReportModal" tabindex="-1" aria-labelledby="progressReportLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="progressReportLabel">Progress Project Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <input type="hidden" name="report_type" value="progress">
                        <div class="form-outline mb-4">
                            <textarea name="report" class="form-control" rows="4" placeholder="Write your progress project report here"
                                required></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="challenges" class="form-control" rows="3" placeholder="Challenges faced"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="solutions" class="form-control" rows="3" placeholder="Proposed solutions"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="file" name="images[]" id="progressReportImages" class="form-control"
                                multiple required>
                            <div id="progressReportPreview" class="mt-2"></div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-danger">Submit Progress Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Final Report -->
    <div class="modal fade" id="finalReportModal" tabindex="-1" aria-labelledby="finalReportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="finalReportLabel">Final Project Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cause_id" value="{{ $cause->id }}">
                        <input type="hidden" name="report_type" value="final">
                        <div class="form-outline mb-4">
                            <textarea name="report" class="form-control" rows="4" placeholder="Write your final project report here"
                                required></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="challenges" class="form-control" rows="3" placeholder="Challenges faced"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <textarea name="solutions" class="form-control" rows="3" placeholder="Proposed solutions"></textarea>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="file" name="images[]" id="finalReportImages" class="form-control" multiple
                                required>
                            <div id="finalReportPreview" class="mt-2"></div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-info">Submit Final Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
