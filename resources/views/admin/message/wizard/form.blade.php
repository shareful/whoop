<?php use \App\Models\Admin\Messages\WizardMessage; ?>
@extends('admin.layouts.baselayout')
@if(isset($wizardMessage))
    @section('title', 'Edit Wizard Message')
@else
    @section('title', 'Add New Wizard Message')
@endif
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
                                            @if(isset($wizardMessage))
                                                Edit Wizard Message
                                            @else
                                                Add New Wizard Message
                                            @endif
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
                                                <?php
                                                if (isset($wizardMessage)) {
                                                    $action = route('wizard_messages.update',
                                                        $wizardMessage['id']);
                                                } else {
                                                    $action = route('wizard_messages.store');
                                                }
                                                ?>
                                                <form class="form" action="{{$action}}"
                                                      method="post" enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    @if(isset($wizardMessage))
                                                        <input type="hidden" name="_method" value="PUT">
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="title">Title</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="title"
                                                                   name="title" value="{{
                                                                   isset($wizardMessage)
                                                                      ?$wizardMessage['title']:''}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="message">Message</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="message" class="form-control"
                                                                      id="message" rows="5">{{
                                                                      isset($wizardMessage)
                                                                      ?$wizardMessage['message']:''
                                                                      }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="icon">Icon</label>
                                                        <div class="col-sm-10">
                                                            @if(isset($wizardMessage))
                                                                <img src="{{getImageUrl(
                                                                basename($wizardMessage['icon']),
                                                                WizardMessage::ICON_PATH)}}"
                                                                     width="50px">
                                                            @endif
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="icon" id="icon">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submitWizardMessage"
                                                                    id="submitWizardMessage"
                                                                    class="btn btn-primary">
                                                                {{isset($wizardMessage)?'Update':'Add'}}
                                                            </button>
                                                            <button type="reset" name="btnCancelAdd"
                                                                    id="btnCancelAdd" class="btn">Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
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