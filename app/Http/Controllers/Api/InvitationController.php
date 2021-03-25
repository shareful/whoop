<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SendInvitationMail;
use App\Models\Admin\HomeButton;
use App\Models\Admin\Invitation;
use App\Models\Admin\User;
use App\Models\Admin\RequestCodeByPost;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    /**
     * Send Invitation API - api/user/invitation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendInvitation(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            //Request Validation
            $this->validate($request, [
                'email' => 'required|email|max:255',
            ]);

            //Get the current user
            /** @var User $sender */
            $sender = Auth::guard('api')->user();

            //Get home button if Home button is unlocked and verified
            if ($home_button_unique_code = $sender->getHomeButtonUniqueCode()) {
                //Check Home Button User limit
                if ($sender->home_button->family->count() >= HomeButton::USER_LIMIT) {
                    //Home button User Limit reached
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'Home button user limit reached.'
                    ], 500);
                }

                //Check if existing user and Have a home button active.
                $receiver = User::where('email', $request->input('email'))->first();
                if ($receiver instanceof User) {
                    //User exists. Check Home Button Status
                    if ($receiver->home_button_status === HomeButton::STATUS_UNLOCKED) {
                        //User already has a Home Button
                        return response()->json([
                            'status' => 'Error',
                            'message' => 'User with email ' . $request->input('email')
                                . ' is registered and already have a Home Button active'
                        ], 500);
                    }
                }

                //Check if a pending Invitation exists for this email
                $invitations = Invitation::where([
                    ['to_email', '=', $request->input('email')],
                    ['status', '=', Invitation::STATUS_PENDING]
                ])->get();
                if (count($invitations) > 0) {
                    //One or more pending Invitations Exists
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'User with email ' . $request->input('email')
                            . ' is already Invited.'
                    ], 500);
                }

                //Send Mail.
                dispatch(new SendInvitationMail(
                    $sender,
                    $request->input('email'),
                    $home_button_unique_code
                ));

                //Save Invitation
                $invitation = new Invitation();
                $invitation->newInvitation($sender, $request->input('email'));
                $invitation->save();

                //Return on success
                return response()->json([
                    'status' => 'Success',
                    'message' => 'Invitation send to ' . $request->input('email')
                ], 200);
            } else {
                //Sender's Home button is not verified.
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Home Button is not verified.'
                ], 500);
            }
        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Api Authentication Failed.'
            ], 401);
        }
    }

    /**
     * Validate code entered by user to verify user address and unlock home butotn
     * OR, Validate code entered by user to accept invitation if user received code by invitaion email
     * GET - api/user/code/verify
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyAndAcceptInvitation(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            //Request Validation
            $this->validate($request, [
                'code' => 'required|string|max:8',
            ]);

            /** @var User $user */
            $user = Auth::guard('api')->user();

            //Check if current user already have Home Button
            if (!$user->home_button instanceof HomeButton) {
                // Create home button if user have address information
                if(!$user->createHomeButton()){
                    // user addresss information not avaialble to create home button
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'User don\'t have address details yet. Please update address.'
                    ], 500);
                }
            }

            //Check if current user received any invitation
            $invitation = $user->getInvitationToVerify();
            if ($invitation instanceof Invitation) {
                //Get Home Button
                $home_button = HomeButton::where('unique_code', $request->input('code'))->first();
                if ($home_button instanceof HomeButton) {
                    //Check Home Button User limit
                    if ($home_button->family->count() >= HomeButton::USER_LIMIT) {
                        //Home button User Limit reached
                        return response()->json([
                            'status' => 'Error',
                            'message' => 'Home button user limit reached.'
                        ], 500);
                    }

                    //Home button found, check if address matches
                    if ($user->matchesHomeButtonAddress($home_button)) {
                        //Address Matched Perfectly
                        $user = $invitation->acceptInvitation($user);

                        return response()->json([
                            'status' => 'Success',
                            'message' => 'Invitation Verified and Accepted Successfully.',
                            'data' => new UserResource($user)
                        ], 200);
                    } else {
                        //Address Mismatch
                        return response()->json([
                            'status' => 'Error',
                            'message' => 'User Address Doesn\'t Match with the Home Button Address.',
                            'data' => $home_button->getFullAddressData()
                        ], 500);
                    }
                } else {

                    //Invalid Code
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'Invalid Code Provided.'
                    ], 500);
                }
            } else if ($user->requestCodeByPost instanceof RequestCodeByPost) {
                // check if user already requested code by post
                if($user->requestCodeByPost->validateAndAcceptCode($request->input('code'), $user)){
                    return response()->json([
                        'status' => 'Success',
                        'message' => 'Entered Code Verified and Accepted Successfully. Your Home button is UNLOCKED now.',
                        'data' => new UserResource($user->requestCodeByPost->requested_by)
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'Code entered is inot Valid.'
                    ], 500);
                }                    
            } else {
                //No invitation exists for current user
                return response()->json([
                    'status' => 'Error',
                    'message' => 'User haven\'t Received any Invitation or Didn\'t. request for code.'
                ], 500);
            }            
        } else {
            //Api Authentication Failed
            return response()->json(['status' => 'Error',
                'message' => 'Unauthenticated User.'], 401);
        }
    }
}
