@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Send Message to All</h1>
            <div>
                <a href="{{ route('admin_subscriber_index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> All Subscribers</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_subscriber_send_message_submit') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label>Subject *</label>
                                    <input type="text" class="form-control" name="subject">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Content *</label>
                                    <textarea name="content" class="form-control h_200" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Send Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection