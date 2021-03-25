<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller {
	public function getVerify() {
		return view( 'front.container.verify.join' );
	}

	public function getVerifyNow() {
		return view( 'front.container.verify.now.list' );
	}

	public function getVerifyNowPost() {
		$user = Auth::user();

		return view( 'front.container.verify.now.post', [ 'user' => $user ] );
	}

	public function getVerifyCode() {
		$user = Auth::user();

		return view( 'front.container.verify.code', [ 'user' => $user ] );
	}
}
