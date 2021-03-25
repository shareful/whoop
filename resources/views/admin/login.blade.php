@extends('admin.layouts.baselayout')
@section('title', 'Login')
@section('content')
<div class="login-container animated fadeInDown">
    <div class="loginbox bg-white">
        <div class="loginbox-title">SIGN IN</div><br>
            @if (session('message'))
             <div class="alert alert-danger">
               {{ session('message') }}
             </div>
            @endif 
           {!! Form::open(['name' => 'frmAdminLogin', 'id' => 'frmAdminLogin', 'method' => 'post', 'route' => 'admin']) !!}
                <div class="loginbox-textbox">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                </div>
                <div class="loginbox-textbox">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                </div>
                <div class="loginbox-forgot">
                    <a href="{{url('password/reset')}}">Forgot Password?</a>
                </div>
                <div class="loginbox-submit">
                    <input type="submit" name="btnAdminLogin" id="btnAdminLogin" class="btn btn-primary btn-block" value="Login">
                </div>
            {!! Form::close() !!}
    </div>
</div>
@stop