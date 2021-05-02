@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{__('Start New Productions')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('admin.production.store')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="type">{{__('Select Available Fabric')}}</label>
                        <select class="form-control select2bs4" required name="fabric_id" id="fabric_id">
                            <option>{{__('Select')}}</option>
                            @forelse ($fabrics as $item)
                                <option data-expected="{{$item->expected_pant}}" data-name="{{$item->name}}" value="{{$item->id}}"> {{$item->name}} - {{number_format($item->yards,2)}} ({{__('yds')}}) - {{$item->expected_pant}} {{__('Pcs Expected')}} </option>
                            @empty
                                <option> {{__('Not Available')}} </option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{__('Accessories Lists')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    @foreach ($accesories as $item)
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="{{$item->name}}">{{__($item->name)}} ({{__('Pcs')}}) </label>
                                            <input type="text" name="accesories[{{$item->name}}]" id="{{$item->name}}" class="form-control accesoriesValue">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code">{{__('Production Code')}}</label>
                        <input type="text" readonly class="form-control" name="code" id="code" placeholder="{{__('Required')}}">
                    </div>
                    <div class="form-group">
                        <label for="pattern_name">{{__('Pattern Name')}}</label>
                        <input type="text" class="form-control" name="pattern_name" id="pattern_name" placeholder="{{__('Optional')}}">
                    </div>
                    <div class="form-group">
                        <label for="model_name">{{__('Model Name')}}</label>
                        <input type="text" class="form-control" name="model_name" id="model_name" placeholder="{{__('Optional')}}">
                    </div>
                    <div class="form-group">
                        <label for="pant_quantity">{{__('Pant Quantity')}}</label>
                        <input type="number" required class="form-control" name="pant_quantity" id="pant_quantity" placeholder="{{__('Required')}}">
                    </div>
                    <div class="form-group">
                        <label for="ex_p_cost">{{__('Expected Production Cost')}} ({{__($setting->currency??"BDT")}}/{{__('Pcs')}}) </label>
                        <input type="number" step="any" required class="form-control" name="ex_p_cost" id="ex_p_cost" placeholder="{{__('Required')}}">
                    </div>
                    <div class="form-group">
                        <label for="ex_sale">{{__('Expected Selling Price')}} ({{__($setting->currency??"BDT")}}/{{__('Pcs')}}) </label>
                        <input type="number" step="any" required class="form-control" name="ex_sale" id="ex_sale" placeholder="{{__('Required')}}">
                    </div>
                    <div class="form-group">
                        <label for="profileImage">{{_('Sample Image')}}</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    {{__('Browse…')}} <input required type="file" name="image" id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row justify-content-around">
                        <div>
                            <img id='img-upload' class="img-fluid"/>
                        </div>
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
<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endpush
@push('script')
    <script src="{{asset('admin/fileinput/fileinput2.js')}}"></script>
    <script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>

    <script>
        $(function(){
            $('#reservationdate').daterangepicker({
                format: 'L',
                singleDatePicker: true,
            });

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

        $(document).on('change','#fabric_id',function(){
            $('.accesoriesValue').val($(this).find(':selected').data('expected'))
            $.ajax({
                method:"GET",
                url:"{{route('admin.get.production.code')}}",
                data:{
                    id:$(this).find(':selected').val()
                },
                success:function(data,status){
                    $("#code").val(data)
                }
            })
        })
    </script>
@endpush
