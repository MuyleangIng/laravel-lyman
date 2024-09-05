<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<section class="section">
    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Donation Invoice</h2>
                            <div class="invoice-number">Payment ID #{{ $donation_data->payment_id }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Invoice To</strong><br>
                                    {{ auth()->user()->name }}<br>
                                    {{ auth()->user()->email }}
                                </address>
                            </div>
                            <div class="col-md-6" style="text-align:right;">
                                <address>
                                    <strong>Invoice Date</strong><br>
                                    {{ $donation_data->created_at->format('M d, Y') }}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Donation Summary</div>
                        <p class="section-lead">The detail about the donation is shown below:</p>
                        <hr class="invoice-above-table">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th>SL</th>
                                    <th>Project Name</th>
                                    <th class="text-center">Amount Donated</th>
                                    <th class="text-right">Subtotal</th>
                                    <th>Payment Method</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        @php
                                            $cause = App\Models\Cause::find($donation_data->cause_id);
                                        @endphp
                                        {{ $cause->name }}
                                    </td>
                                    <td class="text-center">${{ $donation_data->price }}</td>
                                    <td class="text-right">${{ $donation_data->price }}</td>
                                    <td>{{ $donation_data->payment_method }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">
                                        ${{ $donation_data->price }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="about-print-button">
            <div class="text-md-right">
                <a href="javascript:window.print();"
                    class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i
                        class="fas fa-print"></i> Print</a>
            </div>
        </div>
    </div>
</section>
