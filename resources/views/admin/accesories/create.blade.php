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
                <form role="form" method="POST" action="{{route('admin.accesories.store')}}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="production_code">{{__('Select Accesories')}}</label>
                      <select class="form-control select2bs4" name="accesories_list">
                          @forelse ($accesories as $item)
                            <option value="{{$item->id}}"> {{__($item->name)}} </option>
                            @empty
                            <option>{{__('No Accessories Available')}}</option>
                          @endforelse
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">{{__('Quantity')}}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{__('Enter quantity (pcs)')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="amount">{{__('Amount')}}</label>
                        <input type="number" step="any" class="form-control" id="amount" name="amount" placeholder="{{__('Enter amount')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="rate">{{__('Rate')}}</label>
                        <input type="number" readonly class="form-control" id="rate" name="rate" placeholder="{{__('Enter rate')}}" required autofocus>
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

            $(document).on('keyup','#amount',function(){
                var amount = $(this).val()
                var qty = $("#quantity").val()
                var rate = parseFloat(amount/qty).toFixed(2)
                $("#rate").val(rate)
            })

            $(document).on('keyup','#quantity',function(){
                var qty = $(this).val()
                var amount = $("#amount").val()
                var rate = parseFloat(amount/qty).toFixed(2)
                $("#rate").val(rate)
            })


        })
    </script>
@endpush
