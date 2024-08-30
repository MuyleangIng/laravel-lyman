@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Invoice - Donations Made</h1>
            </div>
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">Invoice #{{ $invoiceNumber ?? 'N/A' }}</div>
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
                                    <div class="col-md-6 text-right">
                                        <address>
                                            <strong>Invoice Date</strong><br>
                                            {{ now()->format('M d, Y') }}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title">Donation Summary</div>
                                <p class="section-lead">Details about the donations made are shown below:</p>
                                <hr class="invoice-above-table">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tr>
                                            <th>SL</th>
                                            <th>Cause Name</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Subtotal</th>
                                            <th>Payment Method</th>
                                        </tr>
                                        @foreach ($donationsMade as $index => $donation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $donation->cause->name }}</td>
                                                <td class="text-center">${{ $donation->price }}</td>
                                                <td class="text-center">1</td>
                                                <td class="text-right">${{ $donation->price }}</td>
                                                <td>{{ $donation->payment_method }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12 text-right">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                ${{ $donationsMade->sum('price') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="about-print-button">
                    <div class="text-md-right">
                        <a href="javascript:window.print();"
                            class="btn btn-warning btn-icon icon-left text-white print-invoice-button">
                            <i class="fas fa-print"></i> Print
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
