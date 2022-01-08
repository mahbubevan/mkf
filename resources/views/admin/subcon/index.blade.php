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
                            {{$item->name??"N/A"}}
                        </td>
                        <td>
                            {{$item->buyer_name}}
                        </td>
                        <td>
                            {{$item->quantity}}
                        </td>
                        <td>
                            {{$item->rate}}
                        </td>
                        <td>
                            {{$item->total_amount}}
                        </td>
                        <td>
                            @if ($item->status==\App\Models\SubContract::PENDING)
                                  <span class="badge badge-warning"> Pending </span>
                                @elseif($item->status==\App\Models\SubContract::APPROVED)
                                  <span class="badge badge-success"> Approved </span>
                                @else 
                                  <span class="badge badge-danger"> Canceled </span>
                            @endif
                        </td>
                        <td>
                          @if($item->status==\App\Models\SubContract::APPROVED)
                              @if ($item->work_status==\App\Models\SubContract::CUTTING)
                              <span class="badge badge-info"> Cutting </span>
                            @elseif($item->work_status==\App\Models\SubContract::SEWING)
                              <span class="badge badge-info"> Sewing </span>
                            @elseif($item->work_status==\App\Models\SubContract::WASHING) 
                              <span class="badge badge-info"> Washing </span>
                            @elseif($item->work_status==\App\Models\SubContract::CTN) 
                              <span class="badge badge-info"> In CTN </span>
                            @else 
                              <span class="badge badge-success"> Delivered </span>
                            @endif
                          @else 
                            <span> N/A </span>
                          @endif
                        </td>
                        <td>
                          @if ($item->status==\App\Models\SubContract::APPROVED)
                            @if ($item->payment_status==\App\Models\SubContract::UNPAID)
                              <span class="badge badge-danger"> Unpaid </span>
                            @elseif($item->payment_status==\App\Models\SubContract::PARTPAID)
                              <span class="badge badge-warning"> Partial Paid </span>
                            @else 
                              <span class="badge badge-success"> Paid </span>
                            @endif
                          @else 
                            <span> N/A </span>
                          @endif
                      </td>
                      <td>
                        <a href="{{route('admin.subcon.edit',$item->id)}}" class="btn btn-sm btn-info"> Edit </a>
                        <a href="{{route('admin.subcon.destroy',$item->id)}}" class="btn btn-sm btn-danger"> Delete </a>
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
