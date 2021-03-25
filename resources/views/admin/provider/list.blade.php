@extends('admin.layouts.baselayout')
@section('title', 'Service Provider List')
@section('content')
@include('admin.includes.navigation')
<div class="main-container container-fluid">
    <div class="page-container">
        @include('admin.includes.sidebar')
        <div class="page-content">
            <div class="page-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="widget">
                            
                            <div class="widget-header ">
                               <span class="widget-caption"><a href="{{url('/admin/service-provider/add')}}" class="btn btn-default btn-xs shiny icon-only blue addnewbtn"><i class="fa fa-plus"></i></a>&nbsp; Service Provider List</span>
                            </div>
                            
                            <div class="widget-body">
                                @if(Session::has('success'))
                                    <div class="alert alert-success fade in">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <table class="table table-striped table-hover table-bordered" id="usertable">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            First Name
                                        </th>
                                        <th>
                                           Contact
                                        </th>
                                        <th>
                                            Available for Zip Codes
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($providers))
                                         @foreach($providers as $provider)
                                            <tr role="row">
                                                
                                                <td>{{$provider['firstname']}}</td>
                                                <td>{{$provider['mobile']}}</td>
                                                <td>{{$provider['available_for_zipcodes']}}</td>
                                                <td>
                                                    <a href="{{url('/admin/service-provider/edit/'.$provider['id'])}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs deleteprovider" data-id="{{$provider['id']}}" data-url="{{url('/admin/service-provider/'.$provider['id'])}}"><i class="fa fa-trash-o"></i> Delete</a>
                                                </td>
                                            </tr>
                                         @endforeach
                                      @endif
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop