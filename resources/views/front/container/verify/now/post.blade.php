@extends('front.layouts.master')

@section('title', 'Verify Now Post')

@section('content')
	<div class="clearfix"></div>
	<section id="demos2" class="bg_color unlock-to-join-wapper fixed_section">

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="getting_ready_icon text-left">
						<p class="vtitle">
							<img src="{{ asset('front_assets/images/face-transparent.png') }}" class="face_img_v"/>
							Verify by code in post
						</p>

						<p class="vdescription">
							We can post a verification code to your house. It
							may take up to 5 business days to arrive. When
							it does you'll need to enter the code, as
							instructed.
						</p>

						<p class="vdescription">
							If you don't receive mail at your home address,
							please choose another method to verify.
						</p>

						<a href="javascript:void(0);" onclick="verifyPost();" class="btn btn-default btn-lg white_bg fix_bottom"> Post Me My Code </a>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="model-content"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('styles')
	<link href="{{ asset('front_assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('front_assets/css/style_custom.css') }}" rel="stylesheet">
@endsection

@section('scripts')
	<script>
        function verifyPost() {
            $.ajax({
                url: '/api/user/home_button/request_code/by_post',
                method: 'POST',
                data: { api_token: "{{ $user->api_token ?? null }}"},
                dataType: "json",
                success: function (response) {
                    $('#myModal').find('.model-content').text(response.message);
                    $('#myModal').modal();
                },
                error: function (response) {
                    $('#myModal').find('.model-content').text(response.responseJSON.message);
                    $('#myModal').modal();
                }
            });
        }
	</script>
@endsection