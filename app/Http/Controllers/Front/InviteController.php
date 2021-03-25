<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller {
	public function getInvite() {
		$user = Auth::user();
		return view( 'front.container.invite.join', [ 'user' => $user ] );
	}
}
