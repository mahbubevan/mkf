@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{__('User List')}}</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th> {{__('Name')}} </th>
                    <th> {{__('Username')}} </th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Mobile')}}</th>
                    <th>{{__('Balance')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Online')}}</th>
                    <th>{{__('Last Login')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            {{$item->username}}
                        </td>
                        <td>
                            {{$item->email}}
                        </td>
                        <td>
                            {{$item->mobile}}
                        </td>
                        <td>
                            {{number_format($item->balance,2)}}
                        </td>
                        <td>
                            {{$item->status}}
                        </td>
                        <td><span class="tag tag-success">Approved</span></td>
                        <td>
                            {{$item->updated_at->diffforhumans()}}
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
            <div class="card-footer">
                {{$users->links()}}
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
</div>
@endsection
