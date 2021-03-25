@extends('admin.layouts.baselayout')
@section('title', 'Category List')
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
                               <span class="widget-caption"><a href="{{url('/admin/category/add')}}" class="btn btn-default btn-xs shiny icon-only blue addnewbtn"><i class="fa fa-plus"></i></a>&nbsp; Category List</span>
                            </div>
                            
                            <div class="widget-body">
                                @if(Session::has('success'))
                                    <div class="alert alert-success fade in">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger fade in">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <table class="table table-striped table-hover table-bordered" id="usertable">
                                    <thead>
                                    <tr role="row">
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                           Name
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @if(isset($categories))
                                         @foreach($categories as $category)
                                            <tr role="row">
                                                <td>
                                                    @if($category['image'] != "" && file_exists(public_path('upload/category/'.$category['image'])))
                                                    <img src="{{asset('upload/category/'.$category['image'])}}" width="120">
                                                    @else
                                                    <img src="{{asset('/assets/img/no-image.png')}}" width="120">
                                                    @endif
                                                </td>
                                                <td>{{$category['name']}}</td>
                                                <td>{{$category['description']}}</td>
                                                <td>
                                                    <a href="{{url('/admin/category/edit/'.$category['id'])}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs deletecategory" data-id="{{$category['id']}}" data-url="{{url('/admin/category/'.$category['id'])}}"><i class="fa fa-trash-o"></i> Delete</a>
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