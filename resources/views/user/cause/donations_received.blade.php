@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Donations Received</h1>
                <div>
                    <a href="{{ route('user_donation_received_invoice') }}" class="btn btn-primary"><i
                            class="fas fa-file-invoice"></i> Invoice</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Donor Name</th>
                                                <th>Cause Name</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($receivedDonations as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td style="width:300px;">
                                                        <a
                                                            href="{{ route('cause', $item->cause->slug) }}">{{ $item->cause->name }}</a>
                                                    </td>
                                                    <td>${{ $item->price }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    {{ $receivedDonations->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
