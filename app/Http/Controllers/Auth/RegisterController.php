<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Admin\User;
use App\Models\Admin\HomeButton;
use App\Models\Admin\Messages\EventMessage;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'zipcode' => isset($data['zipcode']) ? $data['zipcode'] : '',
            'address' => isset($data['address']) ? $data['address'] : '',
            'country' => isset($data['country']) ? $data['country'] : '',
            'city' => isset($data['city']) ? $data['city'] : '',
            'mobile' => isset($data['mobile']) ? $data['mobile'] : '',
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => base64_encode($data['email'].str_random(8)),
            'is_verified' => 0,
            'token_id' => str_random(10),
            'user_type' => User::TYPE_TRIAL, // start as Trial User
            'trial_start_date' => Carbon::now(),
            'trial_end_date' => Carbon::now()->addDays(30),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    public function registered(Request $request, $user)
    {
        return response()->json(['data' => new UserResource($user)], 201);
    }

    /**
     * Handle a registration request for the application.
     * POST - api/user/register
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerWithApi(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        $user->generateToken();

        // email is dispatched into the queue
        dispatch(new SendVerificationEmail($user));

        // Create home button if user have address information
        $user->createHomeButton();

        // Trigger User Joined Event
        EventMessage::addUserJoinedEvent($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
    * Handle a email verification request for the application.
    *
    * @param $token
    * @return \Illuminate\Http\Response
    */
    public function verify($token)
    {        
        $user = User::where('email_token',$token)->first();
        if ($user === null) {
            abort(404);
        }

        $user->email_verified = 1;

        if($user->save()){
            return view('emailconfirm',['user'=>$user]);
        }
    }
}
