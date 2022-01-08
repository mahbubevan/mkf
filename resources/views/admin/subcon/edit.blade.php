@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">{{__('Update A Record')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{route('admin.subcon.update',$subContract->id)}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Subcontact Name</span>
                                    <span> {{$subContract->name}} </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Buyer Name</span>
                                    <span> {{$subContract->buyer_name}} </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Quantity</span>
                                    <span> {{$subContract->quantity}} pcs </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Rate </span>
                                    <span> {{$subContract->rate}} {{$general->currency??('BDT')}}/pcs </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total Amount</span>
                                    <span> {{$subContract->total_amount}} {{$general->currency??('BDT')}} </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Details</span>
                                    <span>{{$subContract->details}}</span>
                                </li>
                              </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Status</span>
                                    @if (\App\Models\SubContract::PENDING == $subContract->status)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif(\App\Models\SubContract::APPROVED == $subContract->status)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Canceled</span> 
                                    @endif
                                    <span>
                                        <select name="status" id="" class="form-control">
                                            <option @if (\App\Models\SubContract::PENDING== $subContract->status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::PENDING}}">Pending</option>
                                            <option @if (\App\Models\SubContract::APPROVED == $subContract->status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::APPROVED}}">Approved</option>
                                            <option @if (\App\Models\SubContract::CANCELED== $subContract->status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::CANCELED}}">Canceled</option>
                                        </select>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Working Status</span>
                                    @if($subContract->status==\App\Models\SubContract::APPROVED)
                                            @if ($subContract->work_status==\App\Models\SubContract::CUTTING)
                                            <span class="badge badge-info"> Cutting </span>
                                            @elseif($subContract->work_status==\App\Models\SubContract::SEWING)
                                            <span class="badge badge-info"> Sewing </span>
                                            @elseif($subContract->work_status==\App\Models\SubContract::WASHING) 
                                            <span class="badge badge-info"> Washing </span>
                                            @elseif($subContract->work_status==\App\Models\SubContract::CTN) 
                                            <span class="badge badge-info"> In CTN </span>
                                            @else 
                                            <span class="badge badge-success"> Delivered </span>
                                            @endif
                                        @else 
                                            <span> N/A </span>
                                    @endif
                                    <span>
                                        <select name="work_status" id="" class="form-control">
                                            <option 
                                                @if (\App\Models\SubContract::CUTTING== $subContract->work_status)
                                                    selected
                                                @endif value="{{\App\Models\SubContract::CUTTING}}">Cutting
                                            </option>
                                            <option @if (\App\Models\SubContract::SEWING == $subContract->work_status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::SEWING}}">Sewing</option>
                                            <option @if (\App\Models\SubContract::WASHING== $subContract->work_status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::WASHING}}">In Wash</option>
                                            <option @if (\App\Models\SubContract::PACKING== $subContract->work_status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::PACKING}}">Packing</option>
                                            <option @if (\App\Models\SubContract::CTN== $subContract->work_status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::CTN}}">In CTN</option>
                                            <option @if (\App\Models\SubContract::DELIVERED== $subContract->work_status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::DELIVERED}}">DELIVERED</option>
                                        </select>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Payment Status</span>
                                    @if ($subContract->status==\App\Models\SubContract::APPROVED)                                                                            
                                        @if (\App\Models\SubContract::UNPAID == $subContract->payment_status)
                                            <span class="badge badge-danger">UNPAID</span>                                    
                                        @else
                                            <span class="badge badge-success">PAID</span> 
                                        @endif
                                    @else 
                                        N/A
                                    @endif
                                    <span>
                                        <select name="payment_status" id="" class="form-control">
                                            <option @if (\App\Models\SubContract::UNPAID== $subContract->payment_status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::UNPAID}}">Unpaid</option>
                                            <option @if (\App\Models\SubContract::PAID == $subContract->payment_status)
                                                selected
                                            @endif value="{{\App\Models\SubContract::PAID}}">Paid</option>                                            
                                        </select>
                                    </span>
                                </li>                               
                              </ul>
                        </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">{{__('Update')}}</button>
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
