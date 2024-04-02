@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Settings</h1>
        </div>
        <form action="{{ route('admin_settings_update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="section-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        
                                        <button class="nav-link active" id="i1-tab" data-bs-toggle="tab" data-bs-target="#i1" type="button" role="tab" aria-controls="i1" aria-selected="true">Logo, Favicon, Banner</button>
                                        
                                        <button class="nav-link" id="i2-tab" data-bs-toggle="tab" data-bs-target="#i2" type="button" role="tab" aria-controls="i2" aria-selected="false">Top Bar</button>
                                        
                                        <button class="nav-link" id="i3-tab" data-bs-toggle="tab" data-bs-target="#i3" type="button" role="tab" aria-controls="i3" aria-selected="false">CTA</button>
                                        
                                        <button class="nav-link" id="i4-tab" data-bs-toggle="tab" data-bs-target="#i4" type="button" role="tab" aria-controls="i4" aria-selected="false">Footer</button>
                                        
                                        <button class="nav-link" id="i5-tab" data-bs-toggle="tab" data-bs-target="#i5" type="button" role="tab" aria-controls="i5" aria-selected="false">Map</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="i1" role="tabpanel" aria-labelledby="i1-tab" tabindex="0">
                                        <!-- Logo, Favicon, Banner - Start -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Existing Logo</label>
                                                    <div>
                                                        <img src="{{ asset('uploads/'.$settings->logo) }}" alt="" class="w_200">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Change Logo</label>
                                                    <div>
                                                        <input type="file" name="logo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Existing Favicon</label>
                                                    <div>
                                                        <img src="{{ asset('uploads/'.$settings->favicon) }}" alt="" class="w_50">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Change Favicon</label>
                                                    <div>
                                                        <input type="file" name="favicon">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Existing Banner</label>
                                                    <div>
                                                        <img src="{{ asset('uploads/'.$settings->banner) }}" alt="" class="w_200">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Change Banner</label>
                                                    <div>
                                                        <input type="file" name="banner">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Logo, Favicon, Banner - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i2" role="tabpanel" aria-labelledby="i2-tab" tabindex="0">
                                        <!-- Top Bar - Start -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Phone</label>
                                                    <input type="text" name="top_phone" class="form-control" value="{{ $settings->top_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Email</label>
                                                    <input type="text" name="top_email" class="form-control" value="{{ $settings->top_email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Top Bar - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i3" role="tabpanel" aria-labelledby="i3-tab" tabindex="0">
                                        <!-- CTA - Start -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label>Heading</label>
                                                    <input type="text" name="cta_heading" class="form-control" value="{{ $settings->cta_heading }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label>Text</label>
                                                    <textarea name="cta_text" class="form-control h_100" cols="30" rows="10">{{ $settings->cta_text }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Button Text</label>
                                                    <input type="text" name="cta_button_text" class="form-control" value="{{ $settings->cta_button_text }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Button URL</label>
                                                    <input type="text" name="cta_button_url" class="form-control" value="{{ $settings->cta_button_url }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Status *</label>
                                                    <select name="cta_status" class="form-select">
                                                        <option value="Show" @if($settings->cta_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($settings->cta_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- CTA - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i4" role="tabpanel" aria-labelledby="i4-tab" tabindex="0">
                                        <!-- Footer - Start -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Address</label>
                                                    <input type="text" name="footer_address" class="form-control" value="{{ $settings->footer_address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Phone</label>
                                                    <input type="text" name="footer_phone" class="form-control" value="{{ $settings->footer_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Email</label>
                                                    <input type="text" name="footer_email" class="form-control" value="{{ $settings->footer_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Facebook</label>
                                                    <input type="text" name="facebook" class="form-control" value="{{ $settings->facebook }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Twitter</label>
                                                    <input type="text" name="twitter" class="form-control" value="{{ $settings->twitter }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>YouTube</label>
                                                    <input type="text" name="youtube" class="form-control" value="{{ $settings->youtube }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Linkedin</label>
                                                    <input type="text" name="linkedin" class="form-control" value="{{ $settings->linkedin }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Instagram</label>
                                                    <input type="text" name="instagram" class="form-control" value="{{ $settings->instagram }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label>Copyright</label>
                                                    <input type="text" name="copyright" class="form-control" value="{{ $settings->copyright }}">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Footer - End -->
                                    </div>
                                    <div class="tab-pane fade" id="i5" role="tabpanel" aria-labelledby="i5-tab" tabindex="0">
                                        <!-- Map - Start -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label>Map (iFrame Code)</label>
                                                    <textarea name="map" class="form-control h_150" cols="30" rows="10">{{ $settings->map }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Map - End -->
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