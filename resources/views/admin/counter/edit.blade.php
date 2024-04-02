@extends('admin.layouts.app')

@section('main_content')
<div class="main-content">
    <section class="section">
        <div class="section-header d-flex justify-content-between">
            <h1>Edit Counter</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_counter_edit_submit',$counter->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 1 - Number *</label>
                                            <input type="text" class="form-control" name="counter1_number" value="{{ $counter->counter1_number }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 1 - Name *</label>
                                            <input type="text" class="form-control" name="counter1_name" value="{{ $counter->counter1_name }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 2 - Number *</label>
                                            <input type="text" class="form-control" name="counter2_number" value="{{ $counter->counter2_number }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 2 - Name *</label>
                                            <input type="text" class="form-control" name="counter2_name" value="{{ $counter->counter2_name }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 3 - Number *</label>
                                            <input type="text" class="form-control" name="counter3_number" value="{{ $counter->counter3_number }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 3 - Name *</label>
                                            <input type="text" class="form-control" name="counter3_name" value="{{ $counter->counter3_name }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 4 - Number *</label>
                                            <input type="text" class="form-control" name="counter4_number" value="{{ $counter->counter4_number }}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Counter 4 - Name *</label>
                                            <input type="text" class="form-control" name="counter4_name" value="{{ $counter->counter4_name }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label>Status</label>
                                            <select name="status" class="form-select">
                                                <option value="Show" @if($counter->status == 'Show') selected @endif>Show</option>
                                                <option value="Hide" @if($counter->status == 'Hide') selected @endif>Hide</option>
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