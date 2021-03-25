<meta charset="utf-8" />
<title>@yield('title')</title>

<meta name="description" content="login page" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="{!! URL::asset('assets/img/favicon.png') !!}" type="image/x-icon">

<!--Basic Styles-->
<link href="{!! URL::asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet" />
<link id="bootstrap-rtl-link" href="" rel="stylesheet" />
<link href="{!! URL::asset('assets/css/font-awesome.min.css') !!}" rel="stylesheet" />

<!-- Jquery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

<!--Fonts-->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

<!--Beyond styles-->
<link id="beyond-link-new" href="{!! URL::asset('assets/css/beyond.min.css') !!}" rel="stylesheet" />
<link href="{!! URL::asset('assets/css/demo.min.css') !!}" rel="stylesheet" />
<link href="{!! URL::asset('assets/css/animate.min.css') !!}" rel="stylesheet" />
<link id="skin-link" href="" rel="stylesheet" type="text/css" />


<link href="{!! URL::asset('assets/css/bootstrap-datetimepicker.min.css') !!}" rel="stylesheet" />
<link href="{!! URL::asset('assets/css/bootstrap-datetimepicker.css') !!}" rel="stylesheet" />

<link href="{!! URL::asset('assets/css/dataTables.bootstrap.css') !!}" rel="stylesheet" />

<!-- Select 2 Style -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<link href="{!! URL::asset('assets/css/style.css') !!}" rel="stylesheet" />

<!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
<script src="{!! URL::asset('assets/js/skins.min.js') !!}"></script>
<script type="text/javascript">var base_url="{{url('/')}}"</script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
