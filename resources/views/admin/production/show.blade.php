@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> {{$production->stock}} <sup style="font-size: 20px">{{__('Pcs')}}</sup></h3>
                <p>{{__('Total Pants From This Production')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3> {{$production->ex_p_cost*$production->stock}} <sup style="font-size: 20px">{{__($setting->currency??"BDT")}}</sup></h3>
                <p>{{__('Total Production Cost')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3> {{$production->ex_sale*$production->stock}} <sup style="font-size: 20px">{{__($setting->currency??"BDT")}}</sup></h3>
                <p>{{__('Total Expected Sale')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>
                    @if ($production->status!=\App\Models\Production::COMPLETED)
                        <span>{{__('RUNNING')}}</span>
                        @else
                        <span>{{__('COMPLETED')}}</span>
                    @endif
                </h3>
                <p>{{__('Production Status')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
        </div>
    </div>
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">
                    {{__($production->code)}} - {{__($production->pattern_name)}} - {{__($production->model_name)}}
                </h3>
                <div class="col-12">
                  <img src="{{asset('img/production/'.$production->image)}}" class="product-image" alt="Product Image">
                </div>
                {{-- <div class="col-12 product-image-thumbs">
                  <div class="product-image-thumb active"><img src="../../dist/img/prod-1.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb" ><img src="../../dist/img/prod-2.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb" ><img src="../../dist/img/prod-3.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb" ><img src="../../dist/img/prod-4.jpg" alt="Product Image"></div>
                  <div class="product-image-thumb" ><img src="../../dist/img/prod-5.jpg" alt="Product Image"></div>
                </div> --}}
              </div>
              <div class="col-12 col-sm-6">
                <h3 class="my-3">{{__($production->code)}} - {{__($production->pattern_name)}} - {{__($production->model_name)}}</h3>
                <hr>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between ">
                        <span>
                            <b>
                                {{__('Fabric Name')}}
                            </b>
                        </span>
                        <span>
                            <b>
                                {{$production->fabric->name??""}}
                            </b>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between ">
                        <span>
                            <b>
                                {{__('Fabric Quantity')}}
                            </b>
                        </span>
                        <span>
                            <b>
                                {{number_format($production->fabric->yards,2)??""}} ({{__('yds')}})
                            </b>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between ">
                        <span>
                            <b>
                                {{__('Fabric Costing')}}
                            </b>
                        </span>
                        <span>
                            <b>
                                {{number_format($production->fabric->amount,2)??""}} {{__($setting->currency??"BDT")}}
                            </b>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between ">
                        <span>
                            <b>
                                {{__('Accessories')}}
                            </b>
                        </span>
                        <span>
                                @foreach (collect($production->accesories_count) as $key=>$value)
                                    <b>{{$key}} = {{$value}} ({{__('Pcs')}}) </b><br>
                                @endforeach
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between ">
                        <span>
                            <b>
                                {{__('Sizes')}}
                            </b>
                        </span>
                        <span>
                                @foreach (collect($production->sizes) as $key=>$value)
                                    <b>{{$value}}  </b><br>
                                @endforeach
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between ">
                        <span>
                            <b>
                                {{__('Expected Pant From This Fabric')}}
                            </b>
                        </span>
                        <span>
                            <b>
                                {{$production->fabric->expected_pant??""}} ({{__("Pcs")}})
                            </b>
                        </span>
                    </li>
                  </ul>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
</div>
@endsection