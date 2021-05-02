@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Accesories Records')}}</h3>
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
                    <th> {{__('Quantity - (Pcs)')}} </th>
                    <th> {{__('Remainig - (Pcs)')}} </th>
                    <th> {{__('Rate')}} ({{__($setting->currency??"BDT")}}) </th>
                    <th>{{__('Amount')}} ({{__($setting->currency??"BDT")}})</th>
                    <th>{{__('Transaction Id')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Accesories Buy Date')}}</th>
                    <th>{{__('Accesories Last Used')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($accesories as $item)
                    <tr>
                        <td>
                            {{$item->accesories_name->name}}
                        </td>
                        <td>
                            {{$item->quantity}}
                        </td>
                        <td>
                            {{$item->remaining}}
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
                            @if ($item->status==\App\Models\Accesories::ACTIVE)
                                <span class="badge badge-success">{{__('AVAILABLE')}}</span>
                                @else
                                <span class="badge badge-danger">{{__('NOT AVAILABLE')}}</span>
                            @endif
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->created_at)->format('j F Y')}}
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->updated_at)->format('j F Y')}}
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
@endsection
