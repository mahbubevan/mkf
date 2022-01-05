@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <button data-toggle="modal" data-target="#addModal" type="button" class="btn btn-block btn-success"> {{__('Add Balance')}} </button>
                    <button data-toggle="modal" data-target="#subModal" type="button" class="btn btn-block btn-danger">{{__('Substract Balance')}}</button>
                </div>
            </div>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-body table-responsive p-0">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th> {{__('Current Balance')}} </th>
                    <th> {{__('Last Month Balance')}} </th>
                    <th>{{__('Last Updated At')}}</th>
                    <th>{{__('Date')}}</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{number_format($account->current_balance,2)}} {{$setting->currency??""}}
                        </td>
                        <td>
                            {{number_format($account->last_month_balance,2)}} {{$setting->currency??""}}
                        </td>
                        <td>
                          @if($account->updated_at)
                            {{$account->updated_at->diffforhumans()}}
                          @endif
                        </td>
                        <td>
                            {{$account->updated_at}}
                        </td>
                      </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('Add Balance')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.company.account.add_bal')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="amount">{{__('Amount')}}</label>
                    <input type="number" step="any" class="form-control" name="amount" id="amount" placeholder="{{__('Enter Amount')}}">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal">{{__('Close')}}</button>
              <button type="submit" class="btn btn-primary">{{__('Add Balance')}}</button>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="subModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('Substract Balance')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.company.account.sub_bal')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="amount">{{__('Amount')}}</label>
                    <input type="number" step="any" class="form-control" name="amount" id="amount" placeholder="{{__('Enter Amount')}}">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal">{{__('Close')}}</button>
              <button type="submit" class="btn btn-danger">{{__('Substract Balance')}}</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection
