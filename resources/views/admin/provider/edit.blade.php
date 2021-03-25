@extends('admin.layouts.baselayout')
@section('title', 'Edit Service Provider')
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
                                            Edit Service Provider
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

                                                {!! Form::open(['name' => 'frmEditProvider', 'id' => 'frmEditProvider', 'files' => true, 'class' => 'form-horizontal', 'method' => 'post', 'enctype' => 'multipart/form-data', 'route' => array('provider.update', $provider['id'])])!!}
                                                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Select Category</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="category" id="category">
                                                            @if(isset($categories))
                                                                @foreach($categories as $category)
                                                                <option value="{{$category['id']}}"

                                                                @if($category['id'] == $provider['category_id'])
                                                                selected="selected" 
                                                                @endif
                                                                >
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
                                                            <input class="form-control" id="brand_name" name="brand_name" type="text" value="{{$provider['brand_name']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Strap Line</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="strap_line" name="strap_line" type="text" value="{{$provider['strap_line']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Title</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="title" name="title" type="text" value="{{$provider['title']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Message</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="message" id="message" class="form-control">{{$provider['message']}}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="description" id="description" class="form-control">{{$provider['description']}}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">First Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="firstname" name="firstname" type="text" value="{{$provider['firstname']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Last Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="lastname" name="lastname" type="text" value="{{$provider['lastname']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Email</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="email" name="email" type="text" value="{{$provider['email']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Mobile No.</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="mobile" name="mobile" type="text"
                                                            value="{{$provider['mobile']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Street</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="street" name="street" type="text"
                                                            value="{{$provider['street']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">City</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="city" name="city" type="text" value="{{$provider['city']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Zip Code</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="zipcode" name="zipcode" type="text" value="{{$provider['zipcode']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">State</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="state" name="state" type="text" value="{{$provider['state']}}">
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
                                                           <input name="available_for_zipcodes" id="available_for_zipcodes" type="text" data-role="tagsinput" placeholder="Add Zipcodes" value="{{$provider['available_for_zipcodes']}}"> 
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Web URL</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="web_url" name="web_url" type="text" value="{{$provider['web_url']}}">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Logo</label>
                                                        <div class="col-sm-10">
                                                            <input id="logo" name="logo" type="file" value="{{$provider['logo']}}">
                                                            <input type="hidden" name="hdn_provider_id" id="hdn_provider_id" value="{{$provider['id']}}">
                                                            <input type="hidden" name="delete_file" id="delete_file" value="{{$provider['logo']}}">
                                                            @if(isset($provider['logo']) && $provider['logo']!='')
                                                                {{getImage($provider['logo'], "provider")}}
                                                            @endif
                                                            Supported File Formats: (jpeg,png,jpg,gif,svg)
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Select Color</label>
                                                        <div class="col-sm-10">
                                                            <div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
                                                                <input data-control="hue" class="form-control colorpicker minicolors-input" id="color" name="color" type="text" value="{{$provider['color']}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Commission Rate</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="commission_rate" name="commission_rate" type="text" value="{{$provider['commission_rate']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Discount Rate</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="commission_rate" name="discount_rate" type="number" value="{{$provider['discount_rate']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Unverified Commission Rate</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="unverified_commission_rate" name="unverified_commission_rate" type="text" value="{{$provider['unverified_commission_rate']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Whoop!Me Credit</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="whoop_credit" name="whoop_credit" type="text" value="{{$provider['whoop_credit']}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Upload Video</label>
                                                        <div class="col-sm-10">
                                                            <input id="video" name="video" type="file" value="{{$provider['video']}}">
                                                            <input type="hidden" name="hdn_provider_id" id="hdn_provider_id" value="{{$provider['id']}}">
                                                            <input type="hidden" name="delete_video_file" id="delete_video_file" value="{{$provider['video']}}">
                                                            @if($provider['video']!="")
                                                                {{getVideo($provider['video'], "provider")}}
                                                            @endif
                                                            Supported Video Formats: (mp4,ogg,webm)
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="btnEditProvider" id="btnEditProvider" class="btn btn-primary">Update</button>
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