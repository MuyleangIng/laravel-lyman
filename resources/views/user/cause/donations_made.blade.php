@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>Donations Made</h1>
                <div>
                    <a href="{{ route('donations.made.invoice') }}" class="btn btn-success"><i class="fas fa-file-invoice"></i>
                        Invoice</a>
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
                                                <th>Cause Name</th>
                                                <th>Payment Id</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total_price = 0; @endphp
                                            @foreach ($madeDonations as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td style="width:300px;">
                                                        <a
                                                            href="{{ route('cause', $item->cause->slug) }}">{{ $item->cause->name }}</a>
                                                    </td>
                                                    <td>
                                                        {{ $item->payment_id }}
                                                    </td>
                                                    <td>
                                                        ${{ $item->price }}
                                                    </td>
                                                </tr>
                                                @php $total_price += $item->price; @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="3" style="text-align:right">
                                                    <h5>Total Donations: </h5>
                                                </td>
                                                <td>
                                                    <h5>${{ $total_price }}</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end">
                                    {{ $madeDonations->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
