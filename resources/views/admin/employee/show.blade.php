@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">

            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{asset('img/employee/profile/'.$employee->img)}}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">
                  {{__($employee->name)}}
              </h3>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>{{__('Salary')}}</b> <a class="float-right">{{number_format($employee->salary,2)}} {{$setting->currency??"BDT"}}</a>
                </li>
                <li class="list-group-item">
                  <b>{{__('Hire Date')}}</b> <a class="float-right">{{\Carbon\Carbon::parse($employee->hire_date)->format('d F Y')}}</a>
                </li>
                <li class="list-group-item">
                  <b>{{__('Employment Type')}}</b> <a class="float-right">
                    @if ($employee->type==\App\Models\Employee::FULLTIME)
                        <span class="badge badge-info">{{__('Full Time')}}</span>
                    @else
                        <span class="badge badge-warning">{{__('Part Time')}}</span>
                     @endif
                  </a>
                </li>
                <li class="list-group-item">
                    <b>{{__('Status')}}</b> <a class="float-right">
                      @if ($employee->status==\App\Models\Employee::ACTIVE)
                          <span class="badge badge-primary">{{__('Active')}}</span>
                      @else
                          <span class="badge badge-danger">{{__('In Active')}}</span>
                       @endif
                    </a>
                </li>
              </ul>
              <div class="row justify-content-between">
                    <div class="col-md-6 my-auto">
                        <b>{{__('Action')}}</b>
                    </div>
                    <div class="col-md-6">
                        <div class="row justify-content-around">
                                    <button data-toggle="modal" data-target="#salaryModal" type="button" class="btn btn-success" >{{__('Update Salary')}}</button>
                            @if ($employee->type==\App\Models\Employee::FULLTIME)
                                    <button data-toggle="modal" data-target="#changeTypeModal" type="button" class="btn btn-warning" >{{__('Change To Part-time')}}</button>
                                @else
                                    <button data-toggle="modal" data-target="#changeTypeModal" type="button" class="btn btn-info" >{{__('Change To Full-time')}}</button>
                            @endif
                            @if ($employee->status==\App\Models\Employee::ACTIVE)
                                <button data-toggle="modal" data-target="#changeStatusModal" type="button" class="btn btn-danger" >{{__('In active')}}</button>
                            @else
                                <button data-toggle="modal" data-target="#changeStatusModal" type="submit" class="btn btn-success" >{{__('Active')}}</button>
                            @endif
                        </div>
                    </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{__('About ')}} {{__($employee->name)}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-12">
                                <h4 class="text-center mb-2">{{__('Photo Of Employee')}}</h4>
                              </div>
                              <div class="col-12">
                                <img src="{{asset('img/employee/profile/'.$employee->img)}}" class="img-fluid img-thumbnail" alt="">
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center mb-2">{{__('NID Of Employee')}}</h4>
                            </div>
                            <div class="col-12">
                                <img src="{{asset('img/employee/nid/'.$employee->nid)}}" class="img-fluid img-thumbnail" alt="">
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
        </div>
    </div>
</div>

<div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="salaryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="salaryModalLabel">{{__('Update Salary')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.employee.update.salary',$employee->id)}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="amount">{{__('Amount')}}</label>
                    <input type="number" step="any" class="form-control" name="salary" value={{$employee->salary}}>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
              <button type="submit" class="btn btn-success">{{__('Proceed')}}</button>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="changeTypeModal" tabindex="-1" role="dialog" aria-labelledby="changeTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeTypeModalLabel">{{__('Update Employment Type')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.employee.update.type',$employee->id)}}" method="post">
            @csrf
            @if ($employee->type==\App\Models\Employee::FULLTIME)
                <input type="hidden" name="type" value="{{\App\Models\Employee::PARTTIME}}">
                @else
                <input type="hidden" name="type" value="{{\App\Models\Employee::FULLTIME}}">
            @endif
            <div class="modal-body">
                <div class="form-group">
                    <h6 class="alert alert-warning">
                    <span class="mr-1">
                        <i class="fas fa-exclamation-circle"></i>
                    </span> {{__('Are You Sure To Update This Employee Type To -')}} @if ($employee->type==\App\Models\Employee::FULLTIME)
                        {{__('Part Time')}} @else {{__('Full Time')}}@endif
                </h6>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
              <button type="submit" class="btn btn-warning">{{__('Proceed')}}</button>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeStatusModalLabel">{{__('Update Employment Status')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.employee.update.status',$employee->id)}}" method="post">
            @csrf
            @if ($employee->status==\App\Models\Employee::ACTIVE)
                <input type="hidden" name="status" value="{{\App\Models\Employee::INACTIVE}}">
                @else
                <input type="hidden" name="status" value="{{\App\Models\Employee::ACTIVE}}">
            @endif
            <div class="modal-body">
                <div class="form-group">
                    <h6 class="alert alert-danger">
                    <span class="mr-1">
                        <i class="fas fa-exclamation-circle"></i>
                    </span> {{__('Are You Sure To Update This Employee Type To -')}} @if ($employee->status==\App\Models\Employee::ACTIVE)
                        {{__('In active')}} @else {{__('Active')}}@endif
                </h6>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
              <button type="submit" class="btn btn-danger">{{__('Proceed')}}</button>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection
