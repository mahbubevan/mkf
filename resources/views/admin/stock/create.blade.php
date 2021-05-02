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
                <form role="form" method="POST" action="{{route('admin.stock.store')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                        <label for="quantity">{{__('Quantity')}}</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="{{__('Enter quantity (pcs)')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="amount">{{__('Amount')}} ({{__('BDT')}}/{{__('Pcs')}}) </label>
                        <input type="number" step="any" class="form-control" id="amount" name="amount" placeholder="{{__('Enter amount')}}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="profileImage">{{_('Sample Images')}}</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    {{__('Browse…')}} <input required type="file" name="image" id="imgInp">
                                </span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mt-2">
                            <img id='img-upload' class="img-fluid img-thumbnail"/>
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
@endpush
