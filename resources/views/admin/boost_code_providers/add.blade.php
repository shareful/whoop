@extends('admin.layouts.baselayout')
@section('title', 'Add New Boost Code Provider')
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
                                            Add New Boost Code Provider
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
                                                {!! Form::open(['name' => 'frmAddBoostCodeProvider', 'id' => 'frmAddBoostCodeProvider', 'files' => true, 'class' => 'form-horizontal', 'method' => 'post', 'enctype' => 'multipart/form-data', 'route' => 'boost_code_providers.add']) !!}
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="is_city"></label>
                                                        <div class="col-sm-10">
                                                            <label>
                                                                <input name="is_city" id="is_city"
                                                                       type="checkbox">
                                                                <span class="text">Is City ?</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="name">Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="name" name="name"
                                                                   type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="inputEmail3">Description</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" name="description"
                                                                      id="description" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="nonCitySection">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label no-padding-right"
                                                            >Address</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="address" name="address" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label no-padding-right"
                                                                   for="city">City</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="city" name="city"
                                                                       type="text">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label no-padding-right"
                                                                   for="country">Country</label>
                                                            <div class="col-sm-10">
                                                                <select name="country" id="country"
                                                                        class="form-control">
                                                                    <option value="UK">UK</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label no-padding-right"
                                                                   for="zipcode">Zip Code</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="zipcode"
                                                                       name="zipcode" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="name">Credits</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="credits" name="credits"
                                                                   type="number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="name">Commission (In Percent)</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="commission_rate" name="commission_rate"
                                                                   type="number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="icon">Image</label>
                                                        <div class="col-sm-10">
                                                            @if(isset($boostCodeProvider))
                                                                <img src="{{getImageUrl(
                                                                basename($boostCodeProvider['image']),\App\Models\Admin\BoostCodeProvider::IMAGE_PATH)}}"
                                                                     width="50px">
                                                            @endif
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="image" id="image">
                                                                Supported File Formats: (jpeg,png,jpg,gif,svg)
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="btnAddBoostCodeProvider" id="btnAddBoostCodeProvider" class="btn btn-primary">Add</button>
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
@section('page-script')
    <script>
        $(document).ready(function () {
            $('#is_city').change(function () {
                var checked = $(this).prop('checked');
                if (checked) {
                    $('.nonCitySection').hide();
                } else {
                    $('.nonCitySection').show();
                }
            });
        });
    </script>
@stop