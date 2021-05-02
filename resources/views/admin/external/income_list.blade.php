@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Income Records')}}</h3>
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
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th> {{__('Details')}} </th>
                    <th>{{__('Amount')}}</th>
                    <th>{{__('Transaction Id')}}</th>
                    <th>{{__('Date')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($incomes as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->amount}}
                        </td>
                        <td>
                            {{$item->trx_id}}
                        </td>
                        <td>
                            {{$item->created_at}}
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
                {{$incomes->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection
