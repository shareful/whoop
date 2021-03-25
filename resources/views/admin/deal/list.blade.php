@extends('admin.layouts.baselayout')
@section('title', 'Deal List')
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
                               <span class="widget-caption"><a href="{{url('/admin/deal/add')}}" class="btn btn-default btn-xs shiny icon-only blue addnewbtn"><i class="fa fa-plus"></i></a>&nbsp; Deal List</span>
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
                                            Image
                                        </th>
                                        <th>
                                           Category
                                        </th>
                                        <th>
                                           Name
                                        </th>
                                        <th>
                                            End Date
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($deals))
                                         @foreach($deals as $deal)
                                            <tr role="row">
                                                <td>
                                                    @if(isset($deal['image']) && file_exists(public_path('upload/deal/'.$deal['image'])))
                                                    <img src="{{asset('upload/deal/'.$deal['image'])}}" width="120">
                                                    @else
                                                    <img src="{{asset('/assets/img/no-image.png')}}" width="120">
                                                    @endif
                                                </td>
                                                <td>{{$deal['categories']['name']}}</td>
                                                <td>{{$deal['name']}}</td>
                                                <td>{{$deal['end_date']}}</td>
                                                <td>
                                                    <a href="{{url('/admin/deal/edit/'.$deal['id'])}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs deletedeal" data-id="{{$deal['id']}}" data-url="{{url('/admin/deal/'.$deal['id'])}}"><i class="fa fa-trash-o"></i> Delete</a>
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