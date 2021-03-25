@extends('admin.layouts.baselayout')
@section('title', 'Add New Category')
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
                                            Add New Category
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

                                                {!! Form::open(['name' => 'frmAddCategory', 'id' => 'frmAddCategory', 'files' => true, 'class' => 'form-horizontal', 'method' => 'post', 'enctype' => 'multipart/form-data', 'route' => 'category.add']) !!}
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="name" name="name" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Image</label>
                                                        <div class="col-sm-10">
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="image" id="image">
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" name="description" id="description"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3"></label>
                                                        <div class="col-sm-10">
                                                            <label>
                                                                <input checked="checked" name="is_national" id="is_national" type="checkbox">
                                                                <span class="text">Is National ?</span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="btnAddCategory" id="btnAddCategory" class="btn btn-primary">Add</button>
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