<?php

use \App\Models\Admin\Messages\EventMessage;
use \App\Http\Controllers\Admin\Message\MessageController;

?>
@extends('admin.layouts.baselayout')
@section('title', 'Quote Message List')
@section('content')
    <style>
        .ui-sortable-helper {
            display: table;
        }
    </style>
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
                                    <span class="widget-caption">
                                        <a href="{{url('admin/quote-messages/add')}}"
                                           class="btn btn-default btn-xs shiny icon-only blue addnewbtn">
                                            <i class="fa fa-plus"></i>
                                        </a>&nbsp;
                                        Quote Message List
                                    </span>
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
                                    @if(is_array($quoteMessages) && count($quoteMessages) > 0)
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>User Id</th>
                                                <th>Target Type</th>
                                                <th>Event Type</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody id="sortable">
                                            @foreach($quoteMessages as $quoteMessage)
                                                <tr data-id="{{$quoteMessage['id']}}">
                                                    <td>{{$quoteMessage['target_id']}}</td>
                                                    <td>{{$quoteMessage['target_type']}}</td>
                                                    <td>{{$quoteMessage['event_type']}}</td>
                                                    <td>
                                                        <a href="{{url('/admin/quote-messages/edit/'.$quoteMessage['id'])}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs deletequote" data-id="{{$quoteMessage['id']}}" data-url="{{url('/admin/quote-messages/'.$quoteMessage['id'])}}"><i class="fa fa-trash-o"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <h2>No quote messages to display</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop