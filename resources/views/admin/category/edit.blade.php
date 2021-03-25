@extends('admin.layouts.baselayout')
@section('title', 'Edit Category')
@section('content')
@include('admin.includes.navigation')
<div class="main-container container-fluid addarticle">
        <!-- Page Container -->
        <div class="page-container">
            @include('admin.includes.sidebar');
            <!-- Page Content -->
            <div class="page-content">
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="well invoice-container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="">
                                            <i class="fa fa-check"></i>
                                            Edit Category
                                        </h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-xs-12">
                                        <div class="widget">
                                            <div class="">
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

                                                {!! Form::open(['name' => 'frmEditCategory', 'id' => 'frmEditCategory', 'files' => true, 'class' => 'form-horizontal', 'method' => 'post', 'route' => array('category.update', $category['id'])]) !!}
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="name" name="name" type="text" value="{{$category['name']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Image</label>
                                                        <div class="col-sm-10">
                                                            <input id="image" name="image" type="file" value="{{$category['image']}}">
                                                            <input type="hidden" name="hdn_category_id" id="hdn_category_id" value="{{$category['id']}}">
                                                            <input type="hidden" name="delete_file" id="delete_file" value="{{$category['image']}}">
                                                            @if(isset($category['image']) && $category['image']!='')
                                                                {{getImage($category['image'], "category")}}
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="description" id="description" class="form-control">{{$category['description']}}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3"></label>
                                                        <div class="col-sm-10">
                                                            <label>
                                                                <input
                                                                @if($category['is_national']=='1')
                                                                checked="checked"
                                                                @endif
                                                                 name="is_national" id="is_national" type="checkbox">
                                                                <span class="text">Is National ?</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="btnEditCategory" id="btnEditCategory" class="btn btn-primary">Update</button>
                                                            <button type="reset" name="btnCancelAdd" id="btnCancelAdd" class="btn">Cancel</button>
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->

    </div>
@stop