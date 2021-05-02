@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Accesories Names')}}</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm">
                    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-sm btn-primary">{{__('ADD NEW')}}</button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th> {{__('Name')}} </th>
                    <th> {{__('Total Quantity')}}</th>
                    <th> {{__('Used')}}</th>
                    <th> {{__('Remaining')}}</th>
                    <th> {{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($accesories as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->accessories->sum('quantity')}}
                        </td>
                        <td>
                            {{$item->accessories->sum('quantity') - $item->accessories->sum('remaining')}}
                        </td>
                        <td>
                            {{$item->accessories->sum('remaining')}}
                        </td>
                        <td>
                            <span>
                                <a href="#"  class="btn btn-sm btn-success editModal" data-id="{{$item->id}}" data-name="{{$item->name}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
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
                {{$accesories->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">{{__('Add Accessories name')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.accesories.name.store')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">{{__('Name')}}</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            <button type="submit" class="btn btn-primary">{{__('Proceed')}}</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">{{__('Edit Accessories name')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.accesories.name.update')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">{{__('Name')}}</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
            <button type="submit" class="btn btn-primary">{{__('Proceed')}}</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('script')
    <script>
        $(function(){
            $(".editModal").on('click',function(){
                var modal = $("#editModal").modal()
                modal.find("#id").val($(this).data('id'))
                modal.find("#name").val($(this).data('name'))
                modal.show()
            })
        })
    </script>
@endpush
