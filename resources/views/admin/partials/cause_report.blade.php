<div class="accordion" id="myAccordion">
    <!-- Before Project Section -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                data-bs-target="#collapseOne">
                1. Before Project
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse">
            <div class="card-body">
                <div class="mb-3">
                    <strong>Report:
                    </strong>{{ $report->where('report_type', 'before')->first()->report ?? 'No report available' }}
                </div>
                <div class="mb-3">
                    <strong>Challenges:
                    </strong>{{ $report->where('report_type', 'before')->first()->challenges ?? 'No challenges reported' }}
                </div>
                <div class="mb-3">
                    <strong>Solutions:</strong>{{ $report->where('report_type', 'before')->first()->solutions ?? 'No solutions provided' }}
                </div>
                <div>
                    <strong>Images: </strong>
                    @if ($report->where('report_type', 'before')->first())
                        @foreach ($report->where('report_type', 'before')->first()->media as $image)
                            <img src="{{ $image->getUrl('thumb') }}" alt="No images" class="img-fluid">
                        @endforeach
                    @else
                        <p>No images available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- During Project Section -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo">
                2. During Project
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse">
            <div class="card-body">
                <h5>Report:</h5>
                <p>{{ $report->where('report_type', 'during')->first()->report ?? 'No report available' }}
                </p>
                <h5>Challenges:</h5>
                <p>{{ $report->where('report_type', 'during')->first()->challenges ?? 'No challenges reported' }}
                </p>
                <h5>Solutions:</h5>
                <p>{{ $report->where('report_type', 'during')->first()->solutions ?? 'No solutions provided' }}
                </p>
                <h5>Images:</h5>
                @if ($report->where('report_type', 'during')->first() && $report->where('report_type', 'during')->first()->images)
                    @foreach (json_decode($report->where('report_type', 'during')->first()->images) as $image)
                        <img src="{{ asset('uploads/reports/' . $image) }}" alt="During Project Image"
                            class="img-fluid mb-2" />
                    @endforeach
                @else
                    <p>No images available.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- After Project Section -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                data-bs-target="#collapseThree">
                3. After Project
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse">
            <div class="card-body">
                <h5>Report:</h5>
                <p>{{ $report->where('report_type', 'after')->first()->report ?? 'No report available' }}
                </p>
                <h5>Challenges:</h5>
                <p>{{ $report->where('report_type', 'after')->first()->challenges ?? 'No challenges reported' }}
                </p>
                <h5>Solutions:</h5>
                <p>{{ $report->where('report_type', 'after')->first()->solutions ?? 'No solutions provided' }}
                </p>
                <h5>Images:</h5>
                @if ($report->where('report_type', 'before')->first())
                    @foreach ($report->where('report_type', 'before')->first()->media as $image)
                        <img src="{{ $report->getFirstMediaUrl('images', 'thumb') }}" alt="" class="img-fluid">
                    @endforeach
                @else
                    <p>No images available.</p>
                @endif


            </div>
        </div>
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
