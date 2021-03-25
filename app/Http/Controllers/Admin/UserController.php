<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Input;
use App\Models\Admin\User;

class UserController extends Controller
{
	public function index(User $user)
	{
		$getUsers = $user->orderBy('created_at', 'desc')->with('home_button')
            ->get()->toArray();
		return view('admin.user.list')->with('users',$getUsers);
	}

    public function getLogin(){
    	return view('admin.login');
    }

    public function postLogin(Request $request){

    	$rules = array(
		    'email'    => 'required|email',
		    'password' => 'required|min:3'
		);

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin')
		        ->withErrors($validator)
		        ->withInput($request->except('password'));
		} else {

			$userdata = array(
		        'email'     => $request->get('email'),
		        'password'  => $request->get('password')
		    );

		    if (Auth::attempt($userdata)) {
		        return Redirect::to('admin/dashboard');
		    } else {
		        return redirect()->back()->withInput()->with('message', 'Username Or Password incorrect.');
		    }
		}
    }

    public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/admin');
	}
}
