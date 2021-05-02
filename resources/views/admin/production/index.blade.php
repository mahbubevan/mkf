@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('Production Records')}}</h3>
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
                    <th> {{__('Fabric')}} </th>
                    <th> {{__('Code')}} </th>
                    <th>{{__('Total Pant (Pcs)')}}</th>
                    <th>{{__('Stock (Pcs)')}}</th>
                    <th>{{__('Remaining (Pcs)')}}</th>
                    <th>{{__('Expected Production Cost')}}</th>
                    <th>{{__('Expected Sale Price')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Production Started')}}</th>
                    <th>{{__('Production Ended')}}</th>
                    <th>{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($productions as $item)
                    <tr>
                        <td>
                            {{$item->fabric->name}}
                        </td>

                        <td>
                            {{$item->code}}
                        </td>
                        <td>
                            {{$item->pant_quantity}}
                        </td>
                        <td>
                            {{$item->stock}}
                        </td>
                        <td>
                            {{$item->pant_quantity-$item->stock}}
                        </td>
                        <td>
                            <b> {{number_format($item->ex_p_cost,2)}}  {{__($setting->currency??"BDT")}}/({{(__('Pcs'))}}) </b>
                        </td>
                        <td>
                            <b> {{number_format($item->ex_sale,2)}} {{__($setting->currency??"BDT")}}/({{(__('Pcs'))}}) </b>
                        </td>
                        <td>
                            @if ($item->status!=\App\Models\Production::COMPLETED)
                               <span class="badge badge-warning">{{__('RUNNING')}}</span>
                                @else
                                <span class="badge badge-success">
                                    {{__('COMPLETED')}}
                                </span>
                            @endif
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($item->created_at)->format('d F Y')}}
                        </td>
                        <td>
                            @if ($item->status!=\App\Models\Production::COMPLETED)
                                <span class="text-info">{{__('N/A')}}</span>
                                @else
                                {{\Carbon\Carbon::parse($item->updated_at)->format('d F Y')}}
                            @endif
                        </td>
                        <td>
                            @if ($item->status!=\App\Models\Production::COMPLETED)
                            <span>
                                <button data-id="{{$item->id}}"
                                    class="btn btn-sm btn-info partialStock">
                                    {{__('Partial Stock')}}
                                </button>
                            </span>
                            <span>
                                <button data-id="{{$item->id}}" class="btn btn-sm btn-success fullStock">{{__('Full Stock')}}</button>
                            </span>
                                @else
                                <span>
                                    <button disabled class="btn btn-sm btn-primary">{{__('Not Available')}}</button>
                                </span>
                            @endif
                            <a href="{{route('admin.production.show',$item->id)}}" class="btn btn-sm btn-primary">{{__('Details')}}</a>
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
                {{$productions->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>

<div class="modal fade" id="partialModal" tabindex="-1" role="dialog" aria-labelledby="partialModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="partialModalLabel">{{__('Production Partial Update Confirmation')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.production.partial')}}" method="post">
            @csrf
            <input type="hidden" name="productionId" class="productionId">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            <span class="mr-2"><i class="fas fa-exclamation-circle"></i></span> <b>{{__('Are you sure to update this production. It will update the STOCK and products will be available for sale!!!')}}</b>
                          </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="quantity"> {{__('Completed Product Quantity')}} </label>
                            <input type="number" class="form-control" name="stock">
                        </div>
                    </div>
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

  <div class="modal fade" id="fullModal" tabindex="-1" role="dialog" aria-labelledby="fullModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fullModalLabel">{{__('Production Completed Confirmation')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.production.full')}}" method="post">
            @csrf
            <input type="hidden" name="productionId" class="productionId">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            <span class="mr-2"><i class="fas fa-exclamation-circle"></i></span> <b>{{__('Are you sure to update this production. It will update the STOCK and products will be available for sale!!!')}}</b>
                          </div>
                    </div>
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


@endsection
@push('script')
    <script>
        $(function(){
            $(".partialStock").on('click',function(){
                var modal = $("#partialModal").modal()
                modal.find('.productionId').val($(this).data('id'))
                modal.show()
            })

            $(".fullStock").on('click',function(){
                var modal = $("#fullModal").modal()
                modal.find('.productionId').val($(this).data('id'))
                modal.show()
            })
        })
    </script>
@endpush
