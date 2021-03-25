@extends('admin.layouts.baselayout')
@section('title', 'Add New User')
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
                        @is_admin
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="well invoice-container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="">
                                            <i class="fa fa-check"></i>
                                            Add New User
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

                                                {!! Form::open(['name' => 'frmAddUser', 'id' => 'frmAddUser', 'files' => true, 'class' => 'form-horizontal', 'method' => 'post', 'route' => 'user.add']) !!}
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
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Username</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="username" name="username" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Email</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="email" name="email" type="email">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Password</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="password" name="password" type="password">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Confirm Password</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="cpassword" name="cpassword" type="password">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">Mobile No.</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="mobile" name="mobile" type="text">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="inputEmail3">User Role</label>
                                                        <div class="col-sm-10">
                                                            <select name="user_role" id="user_role">
                                                                @foreach ($roles as $role)
                                                                    <option value="{{$role['id']}}">{{strtoupper($role['name'])}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="btnAddUser" id="btnAddUser" class="btn btn-primary">Add</button>
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
                        @else
                        <h1 align="center">You don't have permission to access this page.</h1>
                        @endis_admin
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