<?php

use \App\Models\Admin\Messages\WelcomeMessage;
use \App\Http\Controllers\Admin\Message\MessageController;

?>
@extends('admin.layouts.baselayout')
@section('title', 'Welcome Message List')
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
                                        <a href="{{route('welcome_messages.create')}}"
                                           class="btn btn-default btn-xs shiny icon-only blue addnewbtn">
                                            <i class="fa fa-plus"></i>
                                        </a>&nbsp;
                                        Welcome Message List
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
                                    @if(is_array($welcomeMessages) && count($welcomeMessages) > 0)
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Title</th>
                                                <th>Sub-title</th>
                                                <th>Message</th>
                                                <th>Status (Active/Disabled)</th>
                                                <th>Options</th>
                                                <th>Sort</th>
                                            </tr>
                                            </thead>
                                            <tbody id="sortable">
                                            @foreach($welcomeMessages as $welcomeMessage)
                                                <tr data-id="{{$welcomeMessage['id']}}">
                                                    <td width="60px">
                                                        <img src="{{getImageUrl(basename($welcomeMessage['icon']),WelcomeMessage::ICON_PATH)}}"
                                                             width="50px"></td>
                                                    <td>{{$welcomeMessage['title']}}</td>
                                                    <td>{{$welcomeMessage['sub_title']}}</td>
                                                    <td>{{$welcomeMessage['message']}}</td>
                                                    <td width="200px">
                                                        <label class="switch">
                                                            <input type="checkbox" id="messageStatusUpdate"
                                                                   data-id="{{$welcomeMessage['id']}}"
                                                                    {{$welcomeMessage['status'] === MessageController::STATUS_ACTIVE?'checked':''}}>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </td>
                                                    <td width="200px">
                                                        <a href="{{route('welcome_messages.edit',$welcomeMessage['id'])}}"
                                                           class="btn btn-info btn-xs edit">
                                                            <i class="fa fa-edit"></i> Edit</a>
                                                        {!!displayDeleteForm(route('welcome_messages.destroy',$welcomeMessage['id']))!!}
                                                    </td>
                                                    <td width="50px">
                                                        <span class="ui-icon ui-icon-arrowthick-2-n-s">
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <h2>No welcome messages to display</h2>
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
@section('page-script')
    <script>
        $(function () {
            $("#sortable").sortable({
                update: function (event, ui) {
                    var data = {};
                    $.each($(this).find('tr'), function (index, element) {
                        var messageID = $(element).data('id');
                        data[messageID] = index;
                    });

                    $.post('{{route('message_center.sort_update')}}', {
                        _token: "{{ csrf_token() }}",
                        _method: "PUT",
                        data: data,
                        model: 'WelcomeMessage'
                    }).done(function (response) {
                        response = JSON.parse(response);
                        if (response.status !== 'Success') {
                            alert('Sort Order Update Failed.');
                        }
                    }).fail(function (response) {
                        alert('Sort Order Update Failed.');
                    });
                }
            });
            $("#sortable").disableSelection();

            $('.switch .slider').click(function () {
                var checkBox = $(this).parents('.switch').find('input[type="checkbox"]');
                $.post('{{route('message_center.status_update')}}', {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                    status: checkBox.prop('checked'),
                    id: checkBox.data('id'),
                    model: 'WelcomeMessage'
                }).done(function (response) {
                    response = JSON.parse(response);
                    if (response.status !== 'Success') {
                        alert('Status Update Failed.');
                    }
                }).fail(function (response) {
                    alert('Status Update Failed.');
                });
            });
        });
    </script>
@stop