@extends('admin.layouts.baselayout')
@section('title', 'Edit Global Messages')
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
                                                <form action="{{route('global_messages.store')}}"
                                                      method="post" enctype="multipart/form-data"
                                                      class="form-horizontal">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <h3 class="">
                                                                <i class="fa fa-check"></i>
                                                                Edit Hello Message
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="hello_title">Title</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="hello_title"
                                                                   name="hello_title"
                                                                   value="{{$helloMessage['title']}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="hello_message">Message</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="hello_message" class="form-control"
                                                                      id="hello_message" rows="5">{{
                                                                      $helloMessage['message']
                                                                      }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="hello_icon">Icon</label>
                                                        <div class="col-sm-10">
                                                            <img src="{{getImageUrl(
                                                                basename($helloMessage['icon']),
                                                                \App\Http\Controllers\Admin\Message\GlobalMessageController::ICON_PATH)}}"
                                                                 width="50px">
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="hello_icon"
                                                                       id="hello_icon">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <h3 class="">
                                                                <i class="fa fa-check"></i>
                                                                Edit Service Providers Message
                                                            </h3>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="provider_title">Title</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="provider_title"
                                                                   name="provider_title"
                                                                   value="{{$providerMessage['title']}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="provider_message">Message</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="provider_message" class="form-control"
                                                                      id="provider_message" rows="5">{{
                                                                      $providerMessage['message']
                                                                      }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="provider_icon">Icon</label>
                                                        <div class="col-sm-10">
                                                            <img src="{{getImageUrl(
                                                                basename($providerMessage['icon']),
                                                                \App\Http\Controllers\Admin\Message\GlobalMessageController::ICON_PATH)}}"
                                                                 width="50px">
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="provider_icon"
                                                                       id="provider_icon">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submitWelcomeMessage"
                                                                    id="submitWelcomeMessage"
                                                                    class="btn btn-primary">
                                                                Update
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