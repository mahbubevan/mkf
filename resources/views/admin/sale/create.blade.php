@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="card-title">{{__('Sale Information')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.sale.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="stock">{{__('Available stocks')}}</label>
                            <select class="form-control select2bs4" name="stock" id="stock">
                                <option>{{__('Choose')}}</option>
                                @forelse ($stocks as $item)
                                    <option value="{{$item->id}}" data-amount="{{number_format($item->amount,2)}}">
                                        <span class="d-block">{{'Production Code: '}} {{$item->production?->code}}</span>
                                        <label for=""><span>&nbsp;&nbsp;&nbsp;</span></label>
                                        <span>{{__('Stocks: ')}} {{$item->remaining}} ({{__('Pcs')}})</span>
                                    </option>
                                @empty
                                    <option> {{__('No Data')}} </option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">{{__('Amount')}} ({{__($setting->currency??"BDT")}}/{{__('Pcs')}})</label>
                            <input type="number" step="any" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="quantity">{{__('Quantity')}} ({{__('Pcs')}})</label>
                            <input type="number" name="quantity" id="quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="total_price">{{__('Total Price')}} ({{__($setting->currency??"BDT")}})</label>
                            <input readonly step="any" type="number" name="total_price" id="total_price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remarks">{{__('Details')}} </label>
                            <textarea rows="5" name="remarks" id="remarks" class="form-control"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-lg btn-block btn-success" type="submit">{{__('SALE')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(function(){
            $(document).on('change','#stock',function(){
                $('#amount').val($(this).find(':selected').data('amount'))
            })

            $(document).on('keyup','#quantity',function(){
                var qty = $(this).val()
                var amount = $("#amount").val()
                var total = parseFloat(qty*amount).toFixed(2)
                $("#total_price").val(total)
            })

            $(document).on('keyup','#amount',function(){
                var amount = $(this).val()
                var qty = $("#quantity").val()
                var total = parseFloat(qty*amount).toFixed(2)
                $("#total_price").val(total)
            })


        })
    </script>
@endpush
