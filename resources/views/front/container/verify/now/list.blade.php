@extends('front.layouts.master')

@section('title', 'Verify Now')

@section('content')
	<div class="clearfix"></div>
	<section id="demos2" class="bg_color unlock-to-join-wapper fixed_section">

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="getting_ready_icon text-left">

						<p class="vtitle"> <img src="{{ asset('front_assets/images/face-transparent.png') }}" class="face_img_v"/> Verify Your Address </p>

						<p class="vdescription">The deals we’ve added to your home's Whoop!
							Button are so good we need to verify your
							address before you use them. After all, it's your
							button so we wouldn't want someone else to use
							them.
						</p>

						<p class="vdescription">It's easy to verify your address. Choose from:</p>

						<div class="form form_with_icon">
							<div class="btn_with_icon">
								<a href="!#">
									<img src="{{ asset('front_assets/images/phone_circle_icon.png') }}" class="form_icon"/>
									<span>Mobile Phone Number</span>
									<i class="fa fa-angle-right pull-right"></i>
								</a>
							</div>
							<div class="btn_with_icon">
								<a href="!#">
									<img src="{{ asset('front_assets/images/credit_debit_card_icon.png') }}"  class="form_icon"/>
									<span>Debit or Credit Card</span>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
							<div class="btn_with_icon">
								<a href="{{ route('user-verify-now-post') }}">
									<img src="{{ asset('front_assets/images/speed_post_icon.png') }}"  class="form_icon"/>
									<span>Unique Code in the Post</span>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</section>
@endsection


@section('styles')
	<link href="{{ asset('front_assets/css/bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
	<script type="text/javascript">
        $(window).on('load', function () {
            $('#myModal').modal('show');
        });
	</script>
@endsection