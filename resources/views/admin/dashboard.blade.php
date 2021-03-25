@extends('admin.layouts.baselayout')
@section('title', 'Dashboard')
@section('content')
<div class="loading-container">
        <div class="loader"></div>
    </div>
    <!--  /Loading Container -->
    <!-- Navbar -->
    @include('admin.includes.navigation')
    <div class="main-container container-fluid">
        <div class="page-container">
            @include('admin.includes.sidebar');
            <div class="page-content">
                <div class="page-body">
                   <h1>DASHBOARD</h1>
                </div>
            </div>
        </div>
    </div>
@stop