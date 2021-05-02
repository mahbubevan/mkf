@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Fabric Records')}}</h3>
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
                    <th> {{__('Quantity - Yards')}} </th>
                    <th> {{__('Rate')}} ({{__($setting->currency??"BDT")}}) / {{__('Yds')}} </th>
                    <th>{{__('Amount')}} ({{__($setting->currency??"BDT")}})</th>
                    <th>{{__('Transaction Id')}}</th>
                    <th>{{__('Expected Pants')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Fabrics Buy Date')}}</th>
                    <th>{{__('Fabrics Used Date')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($fabrics as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{number_format($item->yards,2)}}
                        </td>
                        <td>
                            {{number_format($item->rate,2)}}
                        </td>
                        <td>
                            {{number_format($item->amount,2)}}
                        </td>
                        <td>
                            {{$item->trx_id}}
                        </td>
                        <td>
                            {{$item->expected_pant}}
                        </td>
                        <td>
                            @if ($item->status==\App\Models\Fabric::AVAIL)
                                <span class="badge badge-success"> {{__('AVAILABLE')}} </span>
                                @else
                                <span class="badge badge-danger"> {{__('USED')}} </span>
                            @endif
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->created_at)->format('d F Y')}}
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->updated_at)->format('d F Y')}}
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
                        <td></td>
                        <td>
                            <b>{{__($fabrics->sum('yards'))}} ({{__('yds')}})</b>
                        </td>
                        <td>
                            <b>{{__('Total Costs')}}</b>
                        </td>
                        <td>
                            <b>
                                {{__(number_format($fabrics->sum('amount'),2))}} {{(__($setting->currency??"BDT"))}}
                            </b>
                        </td>
                        <td></td>
                        <td>
                            <b>
                                {{__($fabrics->sum('expected_pant'))}} ({{__('Pcs')}})
                            </b>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{$fabrics->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection
