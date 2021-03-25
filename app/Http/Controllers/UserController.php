<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Input;
use App\Models\Admin\HomeButton;
use App\Models\Admin\User;
use App\Models\Admin\Deal;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $getUsers = $user->orderBy('created_at', 'desc')->with('home_button')
            ->get()->toArray();
        return view("user.list")->with('users', $getUsers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get the current user
        $user = User::find($id);

        //Check if current user already have Home Button
        $unlockedDealstotal = 0;
        $total_to_unlock = 0;
        if ($user->home_button instanceof HomeButton) {
            $unlockedDealstotal = $user->home_button->unlocked_deals->count();

            //Deals Left
            $deals_unlocked_count = $user->home_button->unlocked_deals->count();
            $deals_count = Deal::all()->count();
            $total_to_unlock = $deals_count - $deals_unlocked_count;
        }


        $getUser = User::find($id)->first()->toArray();
        return view("user.view")->with('user', $getUser)->with('unlocked_deals', $unlockedDealstotal)->with('deals_left', $total_to_unlock);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Update logged in user address in storage.
     * PUT - api/user/addresss
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(Request $request)
    {
        if (Auth::guard('api')->check()) {
            // Validation
            $this->validate($request, [
                'address' => 'required|string|max:255',
                'zipcode' => 'required|string|max:8',
                'city' => 'required|string|max:100',
                'country' => 'required|string|max:100',
            ]);

            $user = Auth::guard('api')->user();

            $haveChanges = false;

            if ($user->address != $request->input('address') OR
                $user->zipcode != $request->input('zipcode') OR
                $user->city != $request->input('city') OR
                $user->country != $request->input('country')
            ) {
                $haveChanges = true;
            }

            $user->address = $request->input('address');
            $user->zipcode = $request->input('zipcode');
            $user->city = $request->input('city');
            $user->country = $request->input('country');

            // TODO mark user as unverified when a verified user chnaged his address
            if ($haveChanges) {
                // user have chnaged address . so reset home button.
                $user->home_button_id = 0;
                $user->home_button_status = HomeButton::STATUS_LOCKED;

                // mark as unverified again since address has changed
                $user->is_verified = 0;
            }


            if ($user->save()) {
                if ($haveChanges) {
                    // Create home button for user new address 
                    $user->createHomeButton();
                }

                return response()->json([
                    'data' => $user->toArray(),
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Address couldn\'t be saved'
                ], 500);
            }

        } else {
            return response()->json([
                'error' => 'Unauthenticated'
            ], 401);
        }

    }

    /**
     * Return total number of deals user unlocked
     * GET - api/user/home_button/deals/unlocked/count
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeButtonTotalDealUnlocked(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            $total = 0;

            //Check current user have Home Button
            if ($user->home_button instanceof HomeButton) {
                $total = $user->home_button->unlocked_deals->count();
            }

            //Return on success
            return response()->json([
                'status' => 'Success',
                'total' => $total
            ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }

    /**
     * Return logged in user information
     * GET - api/user/info
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function information(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => new UserResource($user)
            ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }
}
