@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Inventory List')}}</h3>
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
                    <th> {{__('Name')}} </th>
                    <th> {{__('Quantity')}} </th>
                    <th>{{__('Amount')}} {{__($setting->currency??"BDT")}}</th>
                    <th>{{__('Transaction ID')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Details')}}</th>
                    <th>{{__('Purchase Date')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($inventories as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->quantity}}
                        </td>
                        <td>
                            {{number_format($item->amount,2)}}
                        </td>
                        <td>
                            {{$item->trx_id}}
                        </td>
                        <td>
                            {{$item->status}}
                        </td>
                        <td>
                            {{$item->details}}
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
                <tfoot>
                    <tr>
                        <td> </td>
                        <td>
                            <b>{{__('Total Amount')}}</b>
                        </td>
                        <td>
                            <span class="text-success">
                                <b> {{__(number_format($inventories->sum('amount'),2))}} {{__($setting->currency??"BDT")}} </b>
                            </span>
                        </td>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$inventories->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection
