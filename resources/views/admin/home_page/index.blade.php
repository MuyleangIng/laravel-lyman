@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Home Page Items</h1>
        </div>
        <form action="{{ route('admin_home_page_update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        
                                        <button class="nav-link active" id="i1-tab" data-bs-toggle="tab" data-bs-target="#i1" type="button" role="tab" aria-controls="i1" aria-selected="true">Cause</button>
                                        
                                        <button class="nav-link" id="i2-tab" data-bs-toggle="tab" data-bs-target="#i2" type="button" role="tab" aria-controls="i2" aria-selected="false">Feature</button>
                                        
                                        <button class="nav-link" id="i3-tab" data-bs-toggle="tab" data-bs-target="#i3" type="button" role="tab" aria-controls="i3" aria-selected="false">Event</button>
                                        
                                        <button class="nav-link" id="i4-tab" data-bs-toggle="tab" data-bs-target="#i4" type="button" role="tab" aria-controls="i4" aria-selected="false">Testimonial</button>
                                        
                                        <button class="nav-link" id="i5-tab" data-bs-toggle="tab" data-bs-target="#i5" type="button" role="tab" aria-controls="i5" aria-selected="false">Blog</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="i1" role="tabpanel" aria-labelledby="i1-tab" tabindex="0">
                                        <!-- Cause - Start -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Heading</label>
                                                    <input type="text" name="cause_heading" class="form-control" value="{{ $home_page_items->cause_heading }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>SubHeading</label>
                                                    <input type="text" name="cause_subheading" class="form-control" value="{{ $home_page_items->cause_subheading }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Status *</label>
                                                    <select name="cause_status" class="form-select">
                                                        <option value="Show" @if($home_page_items->cause_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($home_page_items->cause_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Cause - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i2" role="tabpanel" aria-labelledby="i2-tab" tabindex="0">
                                        <!-- Feature - Start -->
                                        <div class="form-group mb-3">
                                            <label>Existing Photo</label>
                                            <div>
                                                <img src="{{ asset('uploads/'.$home_page_items->feature_background) }}" alt="" class="w_200">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Change Photo</label>
                                            <div><input type="file" name="feature_background"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Status *</label>
                                                    <select name="feature_status" class="form-select">
                                                        <option value="Show" @if($home_page_items->feature_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($home_page_items->feature_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Feature - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i3" role="tabpanel" aria-labelledby="i3-tab" tabindex="0">
                                        <!-- Event - Start -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Heading</label>
                                                    <input type="text" name="event_heading" class="form-control" value="{{ $home_page_items->event_heading }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>SubHeading</label>
                                                    <input type="text" name="event_subheading" class="form-control" value="{{ $home_page_items->event_subheading }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Status *</label>
                                                    <select name="event_status" class="form-select">
                                                        <option value="Show" @if($home_page_items->event_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($home_page_items->event_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Event - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i4" role="tabpanel" aria-labelledby="i4-tab" tabindex="0">
                                        <!-- Testimonial - Start -->
                                        <div class="form-group mb-3">
                                            <label>Existing Photo</label>
                                            <div>
                                                <img src="{{ asset('uploads/'.$home_page_items->testimonial_background) }}" alt="" class="w_200">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Change Photo</label>
                                            <div><input type="file" name="testimonial_background"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Heading</label>
                                                    <input type="text" name="testimonial_heading" class="form-control" value="{{ $home_page_items->testimonial_heading }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Status *</label>
                                                    <select name="testimonial_status" class="form-select">
                                                        <option value="Show" @if($home_page_items->testimonial_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($home_page_items->testimonial_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Testimonial - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i5" role="tabpanel" aria-labelledby="i5-tab" tabindex="0">
                                        <!-- Blog - Start -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Heading</label>
                                                    <input type="text" name="blog_heading" class="form-control" value="{{ $home_page_items->blog_heading }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>SubHeading</label>
                                                    <input type="text" name="blog_subheading" class="form-control" value="{{ $home_page_items->blog_subheading }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Status *</label>
                                                    <select name="blog_status" class="form-select">
                                                        <option value="Show" @if($home_page_items->blog_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($home_page_items->blog_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Blog - End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </section>
</div>
@endsection