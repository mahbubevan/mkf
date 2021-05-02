@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Sale List')}}</h3>
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
                    <th> {{__('Sell By')}} </th>
                    <th> {{__('Production Code')}} </th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th>{{__('Transaction Id')}}</th>
                    <th>{{__('Remarks')}}</th>
                    <th>{{__('Date')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $item)
                    <tr>
                        <td>
                            {{$item->sell_by??"N/A"}}
                        </td>
                        <td>
                            {{$item->production_code??"N/A"}}
                        </td>
                        <td>
                            {{number_format($item->quantity,2)}}
                        </td>
                        <td>
                            <b>{{number_format($item->amount,2)}} {{__($setting->currency??"BDT")}}</b>
                        </td>
                        <td>
                            {{$item->trx_id}}
                        </td>
                        <td>
                            {{$item->remarks}}
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->created_at)->format('d F Y')}}
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
                {{$sales->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection
