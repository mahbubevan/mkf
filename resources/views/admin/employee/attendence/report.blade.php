@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            @forelse($reports as $key=>$records)        
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">{{__('Record Of Date - ')}} {{$key}} </h3>              
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th> {{__('Name')}} </th>
                            <th>{{__('Entry Time')}}</th>
                        <th>{{__('Exit Time')}}</th>
                        <th>{{__('Entry Remarks')}}</th>
                        <th>{{__('Exit Remarks')}}</th>
                        <th>{{__('Leave Cause')}}</th>
                        <th>{{__('Attendance')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $item)
                            <tr>
                            <td>
                                {{$item->employee->name}}
                            </td>

                            <td>
                                @if($item->entry)
                                    {{\Carbon\Carbon::parse($item->entry)->format('H:i a')}}
                                    @else 
                                    <span> Not Recorded </span>
                                @endif
                            </td>
                            <td>
                                @if($item->exit)
                                        {{\Carbon\Carbon::parse($item->exit)->format('H:i a')}}
                                        @else 
                                        <span> Not Recorded </span>
                                @endif                          
                            </td>
                            <td>
                                {{$item->entry_remarks}}
                            </td>
                            <td>
                                {{$item->exit_remarks}}
                            </td>
                            <td>
                                @if($item->absent_remarks)
                                {{$item->absent_remarks}} 
                                @else 
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($item->attendance==\App\Models\Attendance::PRESENT)
                                    <span class="badge badge-primary">{{__('Present')}}</span>
                                @else
                                    <span class="badge badge-danger">{{__('Absent')}}</span>
                            @endif
                            </td>                   
                            </tr>
                            @empty
                            <tr>
                                <td> {{__('No Data')}} </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->            
                </div>         
                </div>        
            </div>
            @empty 
                <div class='row'>
                    <div class="col-md-12">
                        <p> No Data </p>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="col-4">
                <div class="card">
                <div class="card-header">
                <h3 class="card-title">{{__('Select Month And Year')}} </h3>              
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="form-group">
                            <label for="year">{{__('Select Year')}}</label>
                            <select id="year" class="form-control" name="year">
                                <option value="0">{{__('Choose')}}</option>                            
                                    @foreach ($years as $y)
                                        <option value="{{$y}}"> {{$y}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="month">{{__('Select Month')}}</label>
                            <select id="month" class="form-control" name="month">
                                <option value="1">{{__('January')}}</option>                                    
                                <option value="2">{{__('February')}}</option>                                    
                                <option value="3">{{__('March')}}</option>                                    
                                <option value="4">{{__('April')}}</option>                                    
                                <option value="5">{{__('May')}}</option>                                    
                                <option value="6">{{__('June')}}</option>                                    
                                <option value="7">{{__('July')}}</option>                                    
                                <option value="8">{{__('August')}}</option>                                    
                                <option value="9">{{__('September')}}</option>                                    
                                <option value="10">{{__('October')}}</option>                                    
                                <option value="11">{{__('November')}}</option>                                    
                                <option value="12">{{__('December')}}</option>                                    
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">Search</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->            
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endpush

@push('script')    
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
    </script>
@endpush