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
                <form role="form" method="POST" action="{{route('admin.fabric.store')}}">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">{{__('Fabric Name')}}</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter name')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="yards">{{__('Enter Quantity (Yards)')}}</label>
                        <input type="numeric" step="any" class="form-control" id="yards" name="yards" placeholder="{{__('Enter quantity (yards)')}}" required autofocus>
                      </div>
                    <div class="form-group">
                      <label for="amount">{{__('Cost')}} {{$setting->currency??"BDT"}}</label>
                      <input type="number" required step="any" class="form-control" name="amount" id="amount" placeholder="{{__('Enter Amount')}}">
                    </div>
                    <div class="form-group">
                        <label for="rate">{{__('Rate')}} {{$setting->currency??"BDT"}}</label>
                        <input type="number" readonly required step="any" class="form-control" name="rate" id="rate">
                    </div>
                    <div class="form-group">
                        <label for="expected_pant">{{__('Expected Pants (Pcs)')}}</label>
                        <input type="number" readonly required class="form-control" name="expected_pant" id="expected_pant">
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

@push('script')
    <script>
        $(function(){
            $(document).on('keyup','#amount',function(){
                var yards = $("#yards").val()
                var amount = $(this).val()
                var rate = amount/yards
                $("#rate").val(parseFloat(rate).toFixed(2))
            })

            $(document).on('keyup','#yards',function(){
                var amount = $("#amount").val()
                var yards = $(this).val()
                var rate = amount/yards
                $("#rate").val(parseFloat(rate).toFixed(2))
                var pantRate = "{{getYardsOfPants()}}"
                var expected_pants = yards/pantRate                
                $('#expected_pant').val(Math.round(expected_pants))
            })
        })
    </script>
@endpush
