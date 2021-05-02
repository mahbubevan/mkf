@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{__('Create A New Record')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('admin.external.expense.store')}}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="details">{{__('Details')}}</label>
                        <textarea required class="form-control" name="details" id="details"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="amount">{{__('Amount')}} {{$setting->currency??"BDT"}}</label>
                      <input type="number" required step="any" class="form-control" name="amount" id="amount" placeholder="{{__('Enter Amount')}}">
                    </div>

                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">{{__('Submit')}}</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>
@endsection
