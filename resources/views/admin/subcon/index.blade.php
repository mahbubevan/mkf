@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Sub Contract Lists')}}</h3>
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
                    <th> {{__('Buyer Name')}} </th>
                    <th>{{__('Quantity')}} {{__('Pcs')}} </th>
                    <th>{{__('Rate')}} ({{__($settting->currency??"BDT")}}/{{__('Pcs')}}) </th>
                    <th>{{__('Total Amount')}} ({{__($settting->currency??"BDT")}})</th>
                    <th>{{__('Status')}} </th>
                    <th>{{__('Work Status')}}</th>
                    <th>{{__('Payment Status')}}</th>
                    <th>{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr>
                        <td>
                            {{$item->production_code??"N/A"}}
                        </td>
                        <td>
                            {{$item->quantity}}
                        </td>
                        <td>
                            {{$item->remaining}}
                        </td>
                        <td>
                            {{$item->quantity-$item->remaining}}
                        </td>
                        <td>
                            @php
                                try{
                                    echo number_format($item->amount??"0",2);
                                }catch(\Exception $e){
                                    echo 0;
                                }
                            @endphp
                        </td>
                        <td>
                            <b>
                                @php
                                    try{
                                        echo number_format($item->quantity*$item->amount,2).' '.($setting->currency??"BDT");
                                    }catch(\Exception $e){
                                    echo 0;
                                }
                                @endphp
                            </b>
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
            @if($items->hasPages())
                <div class="card-footer">
                    {{$items->links()}}
                </div>
            @endif
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection
