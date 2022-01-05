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
                <form role="form" method="POST" action="{{route('admin.subcon.store')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{__('Contract Name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter name ')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="buyerName">{{__('Buyer Name')}}</label>
                        <input type="text" class="form-control" id="buyerName" name="buyerName" placeholder="{{__('Enter buyer name ')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="quantity">{{__('Quantity')}}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{__('Enter quantity (pcs)')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="rate">{{__('Rate')}} ({{__('BDT')}}/{{__('Pcs')}}) </label>
                        <input type="number" step="any" class="form-control" id="rate" name="rate" placeholder="{{__('Enter rate')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="total_amount">{{__('Total Amount')}} ({{__('BDT')}} </label>
                        <input readonly type="number" step="any" class="form-control" id="total_amount" name="total_amount" placeholder="{{__('Total amount')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="details">{{__('Details')}} </label>
                        <textarea class="form-control" name="details"></textarea>
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
@push('style')
<link rel="stylesheet" href="{{asset('admin/fileinput/fileinput2.css')}}">
@endpush
@push('script')
<script src="{{asset('admin/fileinput/fileinput2.js')}}"></script>
    <script>
        $(function(){
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    <script>
        $(function(){
            $(document).on('keyup keydown change','#rate',function(){
                var rate = parseFloat($(this).val())
                var qtn = parseFloat($("#quantity").val())
                $('#total_amount').val(rate * qtn)
            })
        })
    </script>
@endpush
