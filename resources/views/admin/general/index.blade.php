@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <form action="{{route('admin.setting.update')}}" method="post">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="name">{{__('Site Name')}} <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$gs->name??""}}" placeholder="{{__('Enter Site Name')}}">
                            </div>
                            <div class="form-group col">
                                <label for="email">{{__('Email Address')}}</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{$gs->email??""}}" placeholder="{{__('Enter email')}}">
                            </div>
                            <div class="form-group col">
                                <label for="currency">{{__('Currency')}}</label>
                                <input type="text" class="form-control" name="currency" value="{{$gs->currency??""}}" id="currency" placeholder="{{__('Enter currency')}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <button type="submit" class="btn btn-block btn-success">{{__('Update')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
