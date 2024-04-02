@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Edit Special</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_special_edit_submit',$special->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Heading *</label>
                                            <input type="text" class="form-control" name="heading" value="{{ $special->heading }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Sub Heading</label>
                                            <input type="text" class="form-control" name="sub_heading" value="{{ $special->sub_heading }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group mb-3">
                                    <label>Text *</label>
                                    <textarea name="text" class="form-control editor" cols="30" rows="10">{{ $special->text }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Button Text</label>
                                            <input type="text" class="form-control" name="button_text" value="{{ $special->button_text }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Button Link</label>
                                            <input type="text" class="form-control" name="button_link" value="{{ $special->button_link }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Video Id *</label>
                                            <input type="text" class="form-control" name="video_id" value="{{ $special->video_id }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Existing Photo</label>
                                            <div>
                                                <img src="{{ asset('uploads/'.$special->photo) }}" alt="" class="w_200">
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Change Photo</label>
                                            <div>
                                                <input type="file" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select name="status" class="form-select">
                                                <option value="Show" @if($special->status == 'Show') selected @endif>Show</option>
                                                <option value="Hide" @if($special->status == 'Hide') selected @endif>Hide</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
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