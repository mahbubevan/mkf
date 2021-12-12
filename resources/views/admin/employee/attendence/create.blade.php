@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{__('Entry Record')}}</h3>
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
                    <div class="form-group">
                        <label>{{__('Remarks')}}</label>
                        <div class="input-group">
                            <input name="remarks" type="text" class="form-control"/>                              
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">{{__('Entry')}}</button>
                  </div>
                </form>
              </div>
        </div>
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{__('Exit Record')}}</h3>
                </div>
                <form role="form" method="POST" action="{{route('admin.employee.attendence.exit')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="emp">{{__('Select Employee')}}</label>
                      <select id="emp" class="form-control" name="emp_id">
                            <option>{{__('Choose')}}</option>
                            @foreach ($attendedEmployee as $emp)
                                <option value="{{$emp->id}}"> {{$emp->name}} </option>
                            @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label>{{__('Exit Time')}}</label>
                          <div class="input-group" data-target-input="nearest">
                              <input required name="exit" type="time" class="form-control"/>
                              <div class="input-group-append">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                    </div>
                    <div class="form-group">
                        <label>{{__('Remarks')}}</label>
                        <div class="input-group">
                            <input name="remarks" type="text" class="form-control"/>                              
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">{{__('Exit')}}</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{__('Attendence List')}}</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th> {{__('Name')}} </th>
                  <th>{{__('Entry Time')}}</th>
                  <th>{{__('Exit Time')}}</th>
                  <th>{{__('Remarks')}}</th>
                  <th>{{__('Attendance')}}</th>                
                </tr>
              </thead>
              <tbody>
                  @forelse ($todayAttendences as $item)
                  <tr>
                      <td>
                          {{$item->employee->name}}
                      </td>

                      <td>
                          {{$item->entry}}
                      </td>
                      <td>
                          {{$item->exit}}
                      </td>
                      <td>
                          {{$item->remarks}}
                      </td>
                      <td>
                          @if ($item->attendance==\App\Models\Attendance::PRESENT)
                              <span class="badge badge-primary">{{__('Present')}}</span>
                          @else
                              <span class="badge badge-danger">{{__('Absent')}}</span>
                      @endif
                      </td>                   
                    </tr>
                  @empty
                    <tr>
                        <td> {{__('No Data')}} </td>
                    </tr>
                  @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
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
