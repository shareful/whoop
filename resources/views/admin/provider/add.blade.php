@extends('admin.layouts.baselayout')
@section('title', 'Add New Service Provider')
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
                                            Add New Service Provider
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

                                                {!! Form::open(['name' => 'frmAddProvider', 'id' => 'frmAddProvider', 'files' => true, 'class' => 'form-horizontal', 'method' => 'post', 'enctype' => 'multipart/form-data', 'route' => 'provider.add']) !!}
                                                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Select Category</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="category" id="category">
                                                            @if(isset($categories))
                                                                @foreach($categories as $category)
                                                                <option value="{{$category['id']}}">
                                                                    {{$category['name']}}
                                                                </option>
                                                                @endforeach
                                                            @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Select Deal</label>
                                                        <div class="col-sm-10 deal-container">
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Brand Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="brand_name" name="brand_name" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="description" id="description" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Strap Line</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="strap_line" name="strap_line" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Title</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="title" name="title" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Message</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="message" id="message" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">First Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="firstname" name="firstname" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Last Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="lastname" name="lastname" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Email</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="email" name="email" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Mobile No.</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="mobile" name="mobile" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Street</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="street" name="street" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">City</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="city" name="city" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Zip Code</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="zipcode" name="zipcode" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">State</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="state" name="state" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Country</label>
                                                        <div class="col-sm-10">
                                                            <select name="country" id="country">
                                                                <option value="UK">UK</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Available for Zip Codes</label>
                                                        <div class="col-sm-10">
                                                           <input name="available_for_zipcodes" id="available_for_zipcodes" type="text" data-role="tagsinput" placeholder="Add Zipcodes"> 
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Web URL</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="web_url" name="web_url" type="text">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Logo</label>
                                                        <div class="col-sm-10">
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="logo" id="logo">
                                                            Supported File Formats: (jpeg,png,jpg,gif,svg)
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Select Color</label>
                                                        <div class="col-sm-10">
                                                            <div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
                                                                <input data-control="hue" class="form-control colorpicker minicolors-input" id="color" name="color" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Commission Rate</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="commission_rate" name="commission_rate" type="number">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Discount Rate</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="commission_rate" name="discount_rate" type="number">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Unverified Commission Rate</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="unverified_commission_rate" name="unverified_commission_rate" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Whoop!Me Credit</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="whoop_credit" name="whoop_credit" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Upload Video</label>
                                                        <div class="col-sm-10">
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="video" id="video">
                                                                Supported Video Formats: (mp4,ogg,webm)
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="btnAddProvider" id="btnAddProvider" class="btn btn-primary">Add</button>
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