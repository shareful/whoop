@extends('front.layouts.master')

@section('title', 'Verify by Unique Code')

@section('content')
<div id="mySidenav" class="sidenav">
	<ul class="sideul">
		<li class="navheader">
			<a href="#">
				<img src="{{ asset('front_assets/images/m-icon1.png') }}" class="img-menu"> Setting
				<span class="closenav" onclick="closeNav()">&times;</span>
			</a>
		</li>
		<li class="sideli">
			<a href="#" class="toggle-custom" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">
				<img src="{{ asset('front_assets/images/m-icon2.png') }}" class="img-menu"> Manage your button
				<span class="fa fa-chevron-down menu-arrow"></span>
			</a>
			<ul class="collapse submenu" id="submenu1" role="menu" aria-labelledby="btn-1">
				<li>
					<a href="home.html">
						<img src="{{ asset('front_assets/images/m-icon3.png') }}"> Your home's button</a>
				</li>
				<li>
					<a href="personal.html">
						<img src="{{ asset('front_assets/images/m-icon4.png') }}"> Your Personal button</a>
				</li>
			</ul>
		</li>
		<li class="sideli">
			<a href="web-deal-detail.html">
				<img src="{{ asset('front_assets/images/m-icon5.png') }}" class="img-menu"> Deals to unlock</a>
		</li>
		<li class="sideli">
			<a href="unlocked-deal.html">
				<img src="{{ asset('front_assets/images/m-icon6.png') }}" class="img-menu"> Unlocked deals</a>
		</li>
		<li class="sideli">
			<a href="add-deal.html">
				<img src="{{ asset('front_assets/images/boost-icon.png') }}" class="img-menu">Super Whoop! Deal</a>
		</li>
		<li class="sideli">
			<a href="#">
				<img src="{{ asset('front_assets/images/m-icon7.png') }}" class="img-menu"> Whoop! Me happy Codes</a>
		</li>
		<li class="sideli">
			<a href="profile_detail.html">
				<img src="{{ asset('front_assets/images/m-icon8.png') }}" class="img-menu"> Profile</a>
		</li>
	</ul>
</div>
<div id="main" class="main">
	<div class="container">
		<div class="col-xs-6">
			<div class="m-logo">
				<img src="{{ asset('front_assets/images/msg-logo.jpg') }}">
			</div>
		</div>
		<div class="col-xs-6">
			<div class="m-menu"><a href="javascript:void(0)" onclick="openNav()"><img src="{{ asset('front_assets/images/menu-icon.jpg') }}"></a></div>
		</div>
	</div>
	<div class="container invite">
		<div class="row">
			<div class="col-md-12 col-xs-12 col-12 text-center p-0">
				<form id="forminvite">
					<input type="hidden" name="api_token" value="{{ $user->api_token }}">
					<h3 class="text-header">Invite</h3>
					<div class="i-logo">
						<img src="{{ asset('front_assets/images/invite-t.png') }}" />
					</div>
					<p class="info1"> Now you've unlocked your Home's button you can</p>
					<p class="sub-header2"> Invite the people you live with by email</p>
					<div class="form-group">
						<input type="text" name="email" class="form-control txt-email" placeholder="Enter the emails one by one" />
					</div>
					<p class="info2"> Share your home's code now</p>
					<div class="form-group">
						<button type="submit" class="btn btn-default btngo">Go</button>
					</div>
					<p class="info3"> Remember you must only invite the people you live with</p>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="Modalinvite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Invite Sent
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</h3>
				</div>
				<div class="modal-body">
					<div class="model-content">
						<p class="sub-text">You've shared your home's code with people you live with.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('styles')
	<link href="{{ asset('front_assets/css/bootstrap.css') }}" rel="stylesheet">
@endsection

@section('body_attr', 'class=message-body')

@section('scripts')
	<script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
            if ($(window).width() > 767) {
                document.getElementById("main").style.marginRight = "250px";
            }
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            if ($(window).width() > 767) {
                document.getElementById("main").style.marginRight = "0";
            }
        }

        jQuery(document).ready(function($) {
            $('.toggle-custom').on('click', function (e) {
                if($(this).attr('aria-expanded') == "true"){
                    $(this).parent().removeClass('active');
                }else{
                    $(this).parent().addClass('active');
                }
            });

            $('#forminvite').submit(function( event ) {
                event.preventDefault();

                $.ajax({
                    url: '{{ url('/api/user/invitation') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        $('#Modalinvite').find('.model-content .sub-text').text(response.message);
                        $('#Modalinvite').modal();
                    },
                    error: function (response) {
                        $('#Modalinvite').find('.model-content .sub-text').text(response.responseJSON.message);
                        $('#Modalinvite').modal();
                    }
                });
            });
        });

	</script>
@endsection