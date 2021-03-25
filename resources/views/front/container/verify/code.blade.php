@extends('front.layouts.master')

@section('title', 'Verify by Unique Code')

@section('content')
	<div class="clearfix"></div>
	<section id="demos2" class="bg_color enter-code-wapper fixed_section"><br>
		<div class="container">
			<div class="row">
				<div class="large-12 columns">
					<div class="getting_ready_icon">
						<img src="{{ asset('front_assets/images/getting_ready_btn_2.png') }}">
						<div class="title_gt_icon"> 15, Charles St, London, W2 4EB. - change </div>
						<div class="title_gt_icon"> </div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="postcode-address">
				You're about to add yourself to your home's button.
				<br> Just enter the unique code
			</div>

			<form class="enter_code" id="verifyCode">
				<input type="hidden" name="api_token" value="{{ $user->api_token }}">
				<input type="text" name="code" placeholder="123456" class="textfield">
				<input type="submit" value="Go" class="submit_btn">
			</form>
		</div>
	</section>

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
	<link href="{{ asset('front_assets/css/bootstrap.css') }}" rel="stylesheet">
@endsection

@section('scripts')
	<script>
		$(document).on('submit', '#verifyCode', function (e) {
			e.preventDefault();

            $.ajax({
                url: '{{ url('/api/user/code/verify') }}',
                method: 'POST',
                data: $(this).serialize(),
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
        })
	</script>

@endsection