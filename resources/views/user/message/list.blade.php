@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section>
            <div class="container py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-12">
                        <div class="card" id="chat1" style="border-radius: 15px;">
                            <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
                                style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                <i class="fas fa-angle-left"></i>
                                <p class="mb-0 fw-bold">Live chat</p>
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="card-body">
                                <!-- Displaying messages -->
                                @foreach ($messages as $message)
                                    <div
                                        class="d-flex flex-row {{ $message->user_id === auth()->user()->id ? 'justify-content-end mb-4' : 'justify-content-start mb-4' }}">
                                        <!-- Check if the message is from the authenticated user -->
                                        <div class="{{ $message->user_id === auth()->user()->id ? 'p-3 me-3 border bg-body-tertiary' : 'p-3 ms-3' }}"
                                            style="border-radius: 15px; background-color: {{ $message->user_id === auth()->user()->id ? 'rgba(0,0,0,.1)' : 'rgba(57, 192, 237,.2)' }};">
                                            <p class="small mb-0">{{ $message->message }}</p>
                                            <small
                                                class="text-muted d-block">{{ $message->created_at->format('H:i') }}</small>
                                        </div>
                                        <img src="{{ $message->user_id === auth()->user()->id
                                            ? (Auth::guard('web')->user()->photo != null
                                                ? asset('uploads/' . Auth::guard('web')->user()->photo)
                                                : asset('uploads/default.png'))
                                            : asset('uploads/chatbot.png') }}"
                                            alt="avatar" class="rounded-circle-custom">
                                    </div>
                                @endforeach

                                <!-- Message input form -->
                                <div data-mdb-input-init class="form-outline mt-4">
                                    <form action="{{ route('user_message_store') }}" method="POST">
                                        @csrf
                                        <textarea class="form-control bg-body-tertiary" id="textAreaExample" name="message" rows="4"
                                            placeholder="Type your message"></textarea>
                                        <label class="form-label" for="textAreaExample">Type your message</label>
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <button type="submit" class="btn btn-primary mt-2">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
