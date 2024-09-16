@extends('user.layouts.app')

@section('main_content')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between">
                <h1>ChatBot</h1>
            </div>
            <div class="section-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-12">
                        <div class="card-body">
                            <!-- Displaying messages -->
                            @foreach ($messages as $message)
                                <div
                                    class="d-flex flex-row {{ $message->user_id === auth()->user()->id ? 'justify-content-end mb-4' : 'justify-content-start mb-4' }}">
                                    <!-- Check if the message is from the authenticated user -->
                                    <div class="{{ $message->user_id === auth()->user()->id ? 'p-3 me-3 border bg-body-tertiary' : 'p-3 ms-3' }}"
                                        style="border-radius: 15px; background-color: {{ $message->user_id === auth()->user()->id ? 'rgba(0,0,0,.1)' : 'rgba(57, 192, 237,.2)' }}; max-width: 75%; word-wrap: break-word; overflow-wrap: break-word;">
                                        <p class="small mb-0">{{ $message->message }}</p>
                                        <small class="text-muted d-block">{{ $message->created_at->format('H:i') }}</small>
                                    </div>
                                    <img src="{{ $message->user_id === auth()->user()->id
                                        ? (auth()->user()->photo != null
                                            ? asset('uploads/' . auth()->user()->photo)
                                            : asset('uploads/default.png'))
                                        : asset('uploads/chatbot.png') }}"
                                        alt="avatar" class="rounded-circle-custom">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-lg-6 col-xl-12">
                        <!-- Message input form -->
                        <div class="form-outline mt-4">
                            <form action="{{ route('user_message_store') }}" method="POST" class="d-flex">
                                @csrf
                                <input type="text" id="form1" name="message" placeholder="Type your message"
                                    class="form-control me-2" />
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
