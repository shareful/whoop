@extends('front.layouts.master')

@section('title', 'Verify Methods')

@section('content')
	<div class="clearfix"></div>
	<section id="demos2" class="bg_color unlock-to-join-wapper fixed_section">

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="getting_ready_icon">
						<span class="vtitle"> Your home's Whoop! Button </span>
						<img src="{{ asset('front_assets/images/getting_ready_btn_2.png') }}">
						<div class="title_gt_icon"> 15, Charles St, London, W2 4EB.</div>
						<a href="{{ route('user-verify-now') }}" class="unlock_btn"> Verify Now </a>
						<a href="{{ route('user-verify-code') }}" class="unlock_btn entc"> Enter Code </a>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="middle-ct">
						<div class="unlock-content">If you have your home’s Whoop! code tap Enter Code to add yourself.
							If not, unlock your home's button by tapping Unlock Now
						</div>
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
					<div class="model-content">
						<h3 class="modal-title" id="myModalLabel">Verify or Join</h3>
					</div>
				</div>
				<div class="modal-body">
					<div class="model-content">
						To finish unlocking your home's Whoop! Button we need to verify your address. Tap Unlock Now. if
						someone you live with has given your home's tap Enter Code.
					</div>
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
@endsection

@section('scripts')
	<script type="text/javascript">
        $(window).on('load', function () {
            $('#myModal').modal('show');
        });
	</script>
@endsection