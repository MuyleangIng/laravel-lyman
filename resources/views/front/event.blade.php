@extends('front.layouts.app')

@section('main_content')
    <div class="page-top" style="background-image: url({{ asset('uploads/' . $global_setting_data->banner) }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $event->name }}</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('events') }}">Events</a></li>
                            <li class="breadcrumb-item active">{{ $event->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="event-detail pt_50 pb_50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="left-item">
                        <div class="main-photo">
                            <img src="{{ asset('uploads/' . $event->featured_photo) }}" alt="">
                        </div>
                        <h2>
                            Description
                        </h2>
                        {!! $event->description !!}
                    </div>
                    <div class="left-item">
                        <h2>
                            Photos
                        </h2>
                        <div class="photo-all">
                            <div class="row">
                                @foreach ($event_photos as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="item">
                                            <a href="{{ asset('uploads/' . $item->photo) }}" class="magnific">
                                                <img src="{{ asset('uploads/' . $item->photo) }}" alt="" />
                                                <div class="icon">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                                <div class="bg"></div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="left-item">
                        <h2>
                            Videos
                        </h2>
                        <div class="video-all">
                            <div class="row">
                                @foreach ($event_videos as $item)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="item">
                                            <a class="video-button"
                                                href="http://www.youtube.com/watch?v={{ $item->youtube_video_id }}">
                                                <img src="http://img.youtube.com/vi/{{ $item->youtube_video_id }}/0.jpg"
                                                    alt="" />
                                                <div class="icon">
                                                    <i class="far fa-play-circle"></i>
                                                </div>
                                                <div class="bg"></div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12">

                    <div class="right-item">

                        @php
                            $current_timestamp = strtotime(date('Y-m-d H:i'));
                            $event_timestamp = strtotime($event->date . ' ' . $event->time);
                        @endphp

                        @if ($event_timestamp > $current_timestamp)
                            <div class="countdown show" data-Date='{{ $event->date }} {{ $event->time }}'>
                                <div class="boxes running">
                                    <div class="box">
                                        <div class="num">
                                            <timer><span class="days"></span></timer>
                                        </div>
                                        <div class="name">Days</div>
                                    </div>
                                    <div class="box">
                                        <div class="num">
                                            <timer><span class="hours"></span></timer>
                                        </div>
                                        <div class="name">Hours</div>
                                    </div>
                                    <div class="box">
                                        <div class="num">
                                            <timer><span class="minutes"></span></timer>
                                        </div>
                                        <div class="name">Minutes</div>
                                    </div>
                                    <div class="box">
                                        <div class="num">
                                            <timer><span class="seconds"></span></timer>
                                        </div>
                                        <div class="name">Seconds</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-danger"><b>Event Date is Over!</b></div>
                        @endif

                        <h2 class="mt_30">Event Information</h2>
                        <div class="summary">
                            <div class="table-responsive">
                                <table class="table table-bordered">


                                    @if ($event->price != 0)
                                        <tr>
                                            <td><b>Ticket Price</b></td>
                                            <td class="price">${{ $event->price }}</td>
                                        </tr>
                                    @endif


                                    <tr>
                                        <td><b>Location</b></td>
                                        <td>{{ $event->location }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Date</b></td>
                                        <td>{{ $event->date }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Time</b></td>
                                        <td>{{ $event->time }}</td>
                                    </tr>


                                    @if ($event->total_seat != '')
                                        <tr>
                                            <td><b>Total Seat</b></td>
                                            <td>{{ $event->total_seat }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Booked</b></td>
                                            <td>
                                                @if ($event->booked_seat == '')
                                                    0
                                                @else
                                                    {{ $event->booked_seat }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Remaining</b></td>
                                            <td>
                                                @php
                                                    $remaining = $event->total_seat - $event->booked_seat;
                                                @endphp
                                                {{ $remaining }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td><b>Booked</b></td>
                                            <td>
                                                @if ($event->booked_seat == '')
                                                    0
                                                @else
                                                    {{ $event->booked_seat }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        @if ($event_timestamp > $current_timestamp)
                            @if ($event->price != 0)
                                <h2 class="mt_30">Buy Ticket</h2>
                                <div class="pay-sec">
                                    <form id="bookingForm" action="{{ route('event_ticket_payment') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="price" value="{{ $event->price }}">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <input type="hidden" id="total_seats" value="{{ $event->total_seat }}">
                                        <input type="hidden" id="booked_seats" value="{{ $event->booked_seat }}">


                                        <div class="ticket-input-box mb-3">
                                            <div class="input-group">
                                                <span class="input-group-text">Tickets</span>
                                                <input name="number_of_tickets" type="number" class="form-control"
                                                    id="ticket-quantity-input" min="1" max="10"
                                                    placeholder="Enter number of tickets" onchange="updatePrice()">
                                            </div>
                                        </div>

                                        <select name="payment_method" class="form-select mb_15" id="paymentMethod"
                                            onchange="updatePrice()">
                                            <option value="">Select Payment Method</option>
                                            <option value="paypal">PayPal</option>
                                            <option value="stripe">Stripe</option>
                                            <option value="payway">ABA</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary w-100-p pay-now"
                                            id="bookedNowButton">Make Payment</button>
                                    </form>

                                </div>
                            @endif

                            @if ($event->price == 0)
                                <h2 class="mt_30">Free Booking</h2>
                                <div class="pay-sec">
                                    <form action="{{ route('event_ticket_free_booking') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="unit_price" value="{{ $event->price }}">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <select name="number_of_tickets" class="form-select mb_15">
                                            <option value="number_of_tickets">How many tickets?</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <button type="submit" class="btn btn-primary w-100-p pay-now">Book Now</button>
                                    </form>
                                </div>
                            @endif
                        @endif

                        @if ($event->map != '')
                            <h2 class="mt_30">Event Map</h2>
                            <div class="location-map">
                                {{ $event->map }}
                            </div>
                        @endif


                        <h2 class="mt_30">Recent Events</h2>
                        <ul>
                            @foreach ($recent_events as $item)
                                <li><a href="{{ route('event', $item->slug) }}"><i class="fas fa-angle-right"></i>
                                        {{ $item->name }}</a></li>
                            @endforeach
                        </ul>

                        <h2 class="mt_30">Event Enquery</h2>
                        <div class="enquery-form">
                            <form action="{{ route('event_send_message') }}" method="post">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <div class="mb-3">
                                    <input name="name" type="text" class="form-control" placeholder="Full Name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <input name="email" type="email" class="form-control"
                                        placeholder="Email Address" required>
                                </div>
                                <div class="mb-3">
                                    <input name="phone" type="text" class="form-control"
                                        placeholder="Phone Number (Optional)">
                                </div>
                                <div class="mb-3">
                                    <textarea name="message" class="form-control h-150" rows="3" placeholder="Message" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">
                                        Send Message <i class="fas fa-long-arrow-alt-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <form method="POST" target="aba_webservice" id="aba_merchant_request">
        @csrf
        <input type="hidden" name="hash" value="" id="hash" />
        <input type="hidden" name="tran_id" value="" id="tran_id" />
        <input type="hidden" name="amount" value="" id="amount" />
        <input type="hidden" name="firstname" value="" />
        <input type="hidden" name="lastname" value="" />
        <input type="hidden" name="phone" value="" />
        <input type="hidden" name="email" value="" />
        <input type="hidden" name="items" value="" id="items" />
        <input type="hidden" name="return_params" value="" />
        <input type="hidden" name="shipping" value="" />
        <input type="hidden" name="currency" value="" />
        <input type="hidden" name="type" value="" />
        <input type="hidden" name="payment_option" value="" />
        <input type="hidden" name="merchant_id" value="" />
        <input type="hidden" name="req_time" value="" />
    </form>
    <input type="button" id="checkout_button" value="Book Now" style="display: none;">
    <script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
    <script>
        function updatePrice() {
            // Get number of tickets and unit price
            var numberOfTickets = parseInt(document.getElementById('number_of_tickets').value);
            var unitPrice = parseFloat(document.getElementById('price').value);

            var totalPrice = unitPrice * (isNaN(numberOfTickets) ? 0 : numberOfTickets);
        }

        function validateTickets() {
            // Get the number of tickets and available seats
            var numberOfTickets = parseInt(document.getElementById('ticket-quantity-input').value);
            var totalSeats = parseInt(document.getElementById('total_seats').value);
            var bookedSeats = parseInt(document.getElementById('booked_seats').value);

            var remainingSeats = totalSeats - bookedSeats;

            // Check if the number of tickets exceeds the remaining seats
            if (numberOfTickets > remainingSeats) {
                alert('You cannot purchase more tickets than available.');
                return false;
            }
            return true;
        }

        // Attach the validation function to form submission
        document.getElementById('bookingForm').onsubmit = function() {
            return validateTickets();
        }



        document.getElementById('bookedNowButton').addEventListener('click', function(e) {
            e.preventDefault(); 

            var paymentMethod = document.getElementById('paymentMethod').value;
            var bookingForm = document.getElementById('bookingForm');
            var formData = new FormData(bookingForm);

            if (paymentMethod === '') {
                alert('Please select a payment method');
                return;
            }

            if (paymentMethod === 'paypal' || paymentMethod === 'stripe') {
                bookingForm.submit();
            } else if (paymentMethod === 'payway') {
                processPayWayPayment();
            }
        });

        function processPayWayPayment() {
            let form = $('#bookingForm');
            let formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    $('#aba_merchant_request').attr('action', response.api_url);
                    $('#hash').val(response.hash);
                    $('#tran_id').val(response.transactionId);
                    $('#amount').val(response.amount);
                    $('input[name="firstname"]').val(response.firstName);
                    $('input[name="lastname"]').val(response.lastName);
                    $('input[name="phone"]').val(response.phone);
                    $('input[name="email"]').val(response.email);
                    $('#items').val(response.items);
                    $('input[name="return_params"]').val(response.return_params);
                    $('input[name="shipping"]').val(response.shipping);
                    $('input[name="currency"]').val(response.currency);
                    $('input[name="type"]').val(response.type);
                    $('input[name="payment_option"]').val(response.payment_option);
                    $('input[name="merchant_id"]').val(response.merchant_id);
                    $('input[name="req_time"]').val(response.req_time);
                    $('#checkout_button').click();
                },
                error: function() {
                    alert('There was an issue processing your request.');
                }
            });
        }

        $(document).ready(function() {
            $('#checkout_button').click(function() {
                AbaPayway.checkout();
            });
        });
    </script>
@endsection
