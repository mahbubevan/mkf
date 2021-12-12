@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{__('Create A New Record')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('admin.employee.attendence.store')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="emp">{{__('Select Employee')}}</label>
                      <select id="emp" class="form-control" name="emp_id">
                            <option>{{__('Choose')}}</option>
                            @foreach ($employees as $emp)
                                <option value="{{$emp->id}}"> {{$emp->name}} </option>
                            @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label>{{__('Entry Time')}}</label>
                          <div class="input-group" data-target-input="nearest">
                              <input required name="entry" type="time" class="form-control"/>
                              <div class="input-group-append">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">{{__('Submit')}}</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{asset('admin/fileinput/fileinput2.css')}}">
{{-- <link rel="stylesheet" href="{{asset('admin/plugins/jquery-timepicker-1.3.5/jquery.timepicker.css')}}"> --}}
@endpush
@push('script')
    <script src="{{asset('admin/fileinput/fileinput2.js')}}"></script>
    <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- date-range-picker -->
    {{-- <script src="{{asset('admin/plugins/jquery-timepicker-1.3.5/jquery.timepicker.js')}}"></script> --}}

    <script>
        $(function(){
            

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endpush
