@extends('user.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Event Tickets</h1>
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
                                            <th>Event Name</th>
                                            <th>Payment Id</th>
                                            <th>Unit Price</th>
                                            <th>Number of Tickets</th>
                                            <th>Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_tickets = 0;
                                        $total_price = 0;
                                        @endphp
                                        @foreach ($event_tickets as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="width:300px;">
                                                @php
                                                $event = App\Models\Event::find($item->event_id);
                                                @endphp
                                                <a href="{{ route('event',$event->slug) }}">{{ $event->name }}</a><br>
                                                {{ $event->date }}, 
                                                {{ $event->time }}
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
                                                ${{ $item->unit_price }}
                                            </td>
                                            <td>
                                                {{ $item->number_of_tickets }}
                                            </td>
                                            <td>
                                                ${{ $item->total_price }}
                                            </td>
                                            <td style="width:140px;">
                                                <a href="{{ route('user_event_ticket_invoice',$item->id) }}" class="btn btn-primary btn-sm">See Invoice</a>
                                            </td>
                                        </tr>
                                        @php
                                        $total_tickets += $item->number_of_tickets;
                                        $total_price += $item->total_price;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4" style="text-align:right">
                                                <h5>Total Tickets</h5>
                                            </td>
                                            <td>
                                                <h5>{{ $total_tickets }}</h5>
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