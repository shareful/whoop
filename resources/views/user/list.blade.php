@extends('admin.layouts.baselayout')
@section('title', 'User List')
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
                                    <span class="widget-caption">User List</span>
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
                                                Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                User Type
                                            </th>
                                            <th>
                                                Zip Code
                                            </th>
                                            <th>
                                                Mobile
                                            </th>
                                            <th>
                                                Trial Start Date
                                            </th>
                                            <th>
                                                No. Of Days Left for Trial
                                            </th>
                                            <th>
                                                Home Button Unique Code
                                            </th>
                                            <th>

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($users))
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user['firstname']}}</td>
                                                    <td>{{$user['email']}}</td>
                                                    <td>{{$user['user_type']}}</td>
                                                    <td>{{$user['zipcode']}}</td>
                                                    <td>{{$user['mobile']}}</td>
                                                    <td>{{date('d-m-Y',strtotime($user['created_at']))}}</td>
                                                    <td>
                                                        <?php
                                                        $today = date("Y-m-d", strtotime($user['created_at']));
                                                        $next_month = date("Y-m-d", strtotime("$today +1 month"));

                                                        $time = date("H:i:s", strtotime($user['created_at']));

                                                        $datediff = strtotime($next_month) - time();

                                                        $daysLeft = round($datediff / (60 * 60 * 24));
                                                        if ($daysLeft < 0) {
                                                            echo "Your 30 days trial expired.";
                                                        } else {
                                                            echo $daysLeft . " Days Left";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        {{$user['home_button']['unique_code']??
                                                        'Home Button Not Found'}}
                                                    </td>
                                                    <td>
                                                        <a href="{{url('/admin/user/view/'.$user['id'])}}"
                                                           class="btn btn-info btn-xs edit"><i class="fa fa-info"></i>
                                                            View</a>
                                                    <!-- <a href="{{url('/admin/appointment/add/')}}" class="btn btn-magenta btn-xs appointment"><i class="fa fa-edit"></i> Create an Appointment</a> -->
                                                        <a href="#" class="btn btn-danger btn-xs delete"
                                                           data-id="{{$user['id']}}"
                                                           data-url="{{url('/admin/user/'.$user['id'])}}"><i
                                                                    class="fa fa-trash-o"></i> Delete</a>
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