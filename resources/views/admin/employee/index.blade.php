@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Employee List')}}</h3>
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
                    <th>{{__('Salary')}}</th>
                    <th>{{__('Hire Date')}}</th>
                    <th>{{__('Type')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>

                        <td>
                            <b>{{number_format($item->salary,2)}}  {{$setting->currency??"BDT"}}</b>
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->hire_date)->format('d F Y')}}
                        </td>
                        <td>
                            @if ($item->type==\App\Models\Employee::FULLTIME)
                                <span class="badge badge-info">{{__('Full Time')}}</span>
                                @else
                                <span class="badge badge-warning">{{__('Part Time')}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($item->status==\App\Models\Employee::ACTIVE)
                                <span class="badge badge-primary">{{__('Active')}}</span>
                            @else
                                <span class="badge badge-danger">{{__('In Active')}}</span>
                        @endif
                        </td>
                        <td>
                            <span>
                                <a href="{{route('admin.employee.show',$item->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                            </span>
                            <span>
                                <a href="#" data-id="{{$item->id}}" class="btn btn-sm btn-danger destroy"><i class="fas fa-trash"></i></a>
                            </span>
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
            <div class="card-footer">
                {{$employees->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>


<!-- Modal -->
<div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="destroyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="destroyModalLabel">{{__('Confirmation Of Deletion')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.employee.destroy')}}" method="post">
            @csrf
            <input type="hidden" name="id" id="employeeId">
            <div class="modal-body">
                <h6 class="alert alert-danger"> <span class="mr-1"><i class="far fa-times-circle"></i></span> {{__('Are You Sure To Delete This Employee Record ?')}}</h6>
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

@push('script')
  <script>
      $(function(){
          $(".destroy").on('click',function(){
              var modal = $("#destroyModal").modal()
              modal.find('#employeeId').val($(this).data('id'))
              modal.show()
          })
      })
  </script>
@endpush
