@extends('user.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Donations</h1>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_price = 0;
                                        @endphp
                                        @foreach ($donations as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="width:300px;">
                                                @php
                                                $cause = App\Models\Cause::find($item->cause_id);
                                                @endphp
                                                <a href="{{ route('cause',$cause->slug) }}">{{ $cause->name }}</a>
                                            </td>
                                            <td>
                                                @php
                                                $original_text = $item->payment_id;
                                                $max_length = 30;
                                                if(strlen($original_text) > $max_length) {
                                                    $line1 = substr($original_text, 0, $max_length);
                                                    $line2 = substr($original_text, $max_length);
                                                }
                                                else {
                                                    $line1 = $original_text;
                                                    $line2 = "";
                                                }
                                                echo $line1 . "<br>" . $line2;
                                                @endphp
                                            </td>
                                            <td>
                                                ${{ $item->price }}
                                            </td>
                                            <td style="width:140px;">
                                                <a href="{{ route('user_cause_donation_invoice',$item->id) }}" class="btn btn-primary btn-sm">See Invoice</a>
                                            </td>
                                        </tr>
                                        @php
                                        $total_price += $item->price;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="3" style="text-align:right">
                                                <h5>Total Donations: </h5>
                                            </td>
                                            <td>
                                                <h5>${{ $total_price }}</h5>
                                            </td>
                                            <td></td>
                                        </tr>
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
@endsection