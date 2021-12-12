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
                <form role="form" method="POST" action="{{route('admin.employee.store')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">{{__('Full Name')}}</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter name')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="designation">{{__('Designation')}}</label>
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="{{__('Enter designation')}}" required autofocus>
                      </div>
                    <div class="form-group">
                      <label for="salary">{{__('Salary')}}</label>
                      <input type="number" required step="any" class="form-control" name="salary" id="salary" placeholder="{{__('Enter Amount')}}">
                    </div>
                    <div class="form-group">
                        <label>{{__('Hire Date')}}</label>
                          <div class="input-group date" data-target-input="nearest">
                              <input required name="hire_date" type="text" class="form-control datetimepicker-input" id="reservationdate" data-target="#reservationdate"/>
                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                    </div>
                    <div class="form-group">
                        <label for="type">{{__('Employment Type')}}</label>
                        <select class="form-control select2bs4" name="type">
                            <option value="{{\App\Models\Employee::FULLTIME}}" >{{__('Full Time')}}</option>
                            <option value="{{\App\Models\Employee::PARTTIME}}" >{{__('Part Time')}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profileImage">{{__('Photo Of Employee')}}</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    {{__('Browse…')}} <input required type="file" name="image" id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nidImage">{{__('NID Of Employee')}}</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    {{__('Browse…')}} <input required type="file" name="nid" id="imgInp2">
                                </span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-around">
                        <div>
                            <img id='img-upload' class="img-fluid"/>
                        </div>
                        <div>
                            <img id='img-upload2' class="img-fluid"/>
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
<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endpush
@push('script')
    <script src="{{asset('admin/fileinput/fileinput2.js')}}"></script>
    <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script>
        $(function(){
            $('#reservationdate').daterangepicker({
                format: 'L',
                singleDatePicker: true,
            });

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endpush
