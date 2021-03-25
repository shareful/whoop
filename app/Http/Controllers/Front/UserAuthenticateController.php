<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeButton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin\Address;
use App\Models\Admin\Project;
use App\Models\Admin\Bank;
use Illuminate\Support\Facades\Validator;
use Auth, Session;
use App\Models\Admin\RequestCodeByPost;

class UserAuthenticateController extends Controller {
	public function anyLogin() {
		return redirect()->to( 'sign_in' );
	}

	public function anySignup( Request $request ) {
		return view( "front.authentication.signup", array( 'title' => 'User Signup' ) );
	}

	public function anySignin( Request $request ) {
		if ( $request->all() ) {

			$rules = array(
				'email'    => 'required|email',
				'password' => 'required|min:3'
			);

			$validator = Validator::make( $request->all(), $rules );

			if ( $validator->fails() ) {
				return Redirect::to( 'admin' )
				               ->withErrors( $validator )
				               ->withInput( $request->except( 'password' ) );
			} else {

				$userdata = array(
					'email'    => $request->get( 'email' ),
					'password' => $request->get( 'password' )
				);

				if ( Auth::attempt( $userdata ) ) {
					return Redirect::to( 'user/dashboard' );
				} else {
					return redirect()->back()->withInput()->with( 'message', 'Username Or Password incorrect.' );
				}
			}

		}

		return view( "front.authentication.signin", array( 'title' => 'User Signin' ) );
	}

	public function anySignUpSuccess() {
		return view( "front.authentication.signup_success", array( 'title' => 'User Signup Success' ) );
	}

	public function anyDashboard() {
		$user = Auth::user();

		$userUnlocked = ( $user->home_button_status === HomeButton::STATUS_UNLOCKED ) ? true : false;
		$sentRequest = $user->requestCodeByPost instanceof RequestCodeByPost;

		if ( $userUnlocked ){
			return view( "front.container.dashboard.unlocked", array( 'title' => 'User Dashboard', 'user' => $user ) );
		} else if( $sentRequest ) {
			return view( "front.container.dashboard.request", array( 'title' => 'User Dashboard', 'user' => $user ) );
		} else {
			return view( "front.container.dashboard.locked", array( 'title' => 'User Dashboard', 'user' => $user ) );
		}
	}

	public function anyLogout() {
		Auth::logout();
		Session::flash( 'success_message', 'Logout successfully.' );

		return Redirect::to( '/sign_in' );
	}

}
