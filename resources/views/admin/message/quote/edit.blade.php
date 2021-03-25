@extends('admin.layouts.baselayout')
@section('content')
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
                                            Edit Quote Message
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
                                                {!! Form::open(['name' => 'frmEditQuoteMessage', 'id' => 'frmEditQuoteMessage', 'files' => true, 'class' => 'form-horizontal', 'method' => 'post', 'enctype' => 'multipart/form-data', 'route' => array('quote-messages.update', $quoteMessage['id'])]) !!}
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="title">Select User</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" name="user" id="user">
                                                            @if(isset($users))
                                                                @foreach($users as $user)
                                                                <option value="{{$user['id']}}">
                                                                    {{$user['firstname']}}
                                                                </option>
                                                                @endforeach
                                                            @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        $decodeQuoteData = json_decode($quoteMessage['event_data']);
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="title">Title</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="title" name="title" value="{{$decodeQuoteData->title}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="title">Sub Heading</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="sub_heading" name="sub_heading" value="{{$decodeQuoteData->sub_heading}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="title">Job Title</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="job_title" name="job_title" value="{{$decodeQuoteData->job_title}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right" for="message">Message</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="message" class="form-control" id="message" rows="5">{{$decodeQuoteData->message}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="icon">Icon</label>
                                                        <div class="col-sm-10">
                                                           
                                                            <img src="{{getImageUrl(
                                                                basename($decodeQuoteData->icon),\App\Models\Admin\Messages\EventMessage::ICON_PATH)}}"
                                                                     width="50px">
                                                            <input type="hidden" id="old_img" name="old_img" value="{{getImageUrl(
                                                                basename($decodeQuoteData->icon),\App\Models\Admin\Messages\EventMessage::ICON_PATH)}}">       
                                                            <span class="file-input btn btn-azure btn-file">
                                                                <input type="file" name="icon" id="icon">
                                                                Supported File Formats: (jpeg,png,jpg,gif,svg)
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="title">Normal Price</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="normal_price" name="normal_price" value="{{$decodeQuoteData->normal_price}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label no-padding-right"
                                                               for="title">Whoop! Me Happy Price</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="whoop_price" name="whoop_price" value="{{$decodeQuoteData->whoop_price}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submitQuoteMessage" id="submitQuoteMessage" class="btn btn-primary">Add</button>
                                                            <button type="reset" name="btnCancelAdd"
                                                                    id="btnCancelAdd" class="btn">Cancel
                                                            </button>
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