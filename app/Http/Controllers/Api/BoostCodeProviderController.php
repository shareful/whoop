<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Deal;
use App\Models\Admin\User;
use App\Models\Admin\BoostCodeProvider;
use App\Http\Resources\BoostCodeProviderResource;
use App\Http\Resources\BoostCodeProviderResourceCollection;
use App\Http\Resources\UserBoostCodesResourceCollection;
use App\Models\Admin\UserBoostCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class BoostCodeProviderController extends Controller
{

    /**
     * Search someone's whoop buttons/boost code providers by name or ID
     * GET - api/someones_whoop_button/search?id={id}&q={name}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            $uniqueId = $request->query('id', false);
            $keyword = $request->query('q', false);

            if (!$keyword AND !$uniqueId) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Provide at least one search term.'
                ], 500);
            }

            $where = [];

            if ($keyword) {
                $where[] = ['name', 'like', '%' . $keyword . '%'];
            }

            if ($uniqueId) {
                //Fixme : Don't think Unique ID should be checked with `like`
                $where[] = ['unique_id', 'like', '%' . $uniqueId . '%'];
            }

            // get only with status active
            $where[] = ['status', '=', BoostCodeProvider::STATUS_ACTIVE];

            // get only which are not city whoop button
            $where[] = ['is_city', '!=', 1];


            $providers = BoostCodeProvider::where($where)->get();

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'count' => $providers->count(),
                    'whoop_buttons' => new BoostCodeProviderResourceCollection($providers),
                ]
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
     * Return detail of a boost code provider
     * GET - api/someones_whoop_button/{provider}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(int $id, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            $provider = BoostCodeProvider::where('is_city', '!=', 1)
                ->where('id', $id)
                ->where('status', BoostCodeProvider::STATUS_ACTIVE)
                ->first();

            if (!$provider instanceof BoostCodeProvider) {
                //Provider not found
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Whoop button not found.'
                ], 404);
            }

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => new BoostCodeProviderResource($provider)
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
     * Return list of city buttons (code provider)
     * GET - api/city/list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityList(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            // $user = Auth::guard('api')->user();

            $where = [];

            // get only with status active
            $where[] = ['status', '=', BoostCodeProvider::STATUS_ACTIVE];

            // get only which are city whoop button
            $where[] = ['is_city', '=', 1];


            $cities = BoostCodeProvider::where($where)->get();

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'count' => $cities->count(),
                    'cities' => new BoostCodeProviderResourceCollection($cities),
                ]
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
     * Return detail of a city button
     * GET - api/city/{name}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityDetail(string $name, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            $provider = BoostCodeProvider::where('is_city', '=', 1)
                ->where('name', $name)
                ->where('status', BoostCodeProvider::STATUS_ACTIVE)
                ->first();

            if (!$provider instanceof BoostCodeProvider) {
                //Provider not found
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Whoop button not found.'
                ], 404);
            }

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => new BoostCodeProviderResource($provider)
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
     * Tap someone's whoop button or city whoop button to add code
     * POST - api/tap_whoop_button
     * PARAM - id
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function tapWhoopButton(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            $this->validate($request, [
                'id' => 'required|integer',
            ]);

            //Get the current user
            $user = Auth::guard('api')->user();

            $provider = BoostCodeProvider::where('id', '=', $request->input('id'))
                ->where('status', BoostCodeProvider::STATUS_ACTIVE)
                ->first();

            if (!$provider instanceof BoostCodeProvider) {
                //Provider not found
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Whoop button not found.'
                ], 404);
            }

            // check is it city button 
            if ($provider->is_city == 1) {
                // check city button is in user's city, if user's city is different then return error
                if ($provider->name != $user->city) {
                    //City is different
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'You are not living in this city. You can\'t tap this city button.'
                    ], 500);
                }
            }

            if ($provider->alreadyTapped($user)) {
                // Already tapped
                return response()->json([
                    'status' => 'Error',
                    'message' => 'You already tapped this whoop button. You can\'t tap this button again this month.'
                ], 500);
            }

            if ($provider->creditLeft() == 0) {
                //exceded credit limit
                return response()->json([
                    'status' => 'Error',
                    'message' => 'This whoop button exceeds it\'s credit limit.'
                ], 500);
            }

            if ($provider->tapButton($user)) {
                return response()->json([
                    'status' => 'Success',
                    'message' => 'You have successfully tapped the button. Boost code added to your account.'
                ], 200);
            } else {
                //failed
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Can\'t tapped the whoop button.'
                ], 500);
            }

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }

    /**
     * Get User's Saved Boost codes
     * GET - api/user/boost_codes
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserCodes(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            $codes = $user->boost_codes->map(function ($code) {
                return $code->provider;
            });

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'codes' => new UserBoostCodesResourceCollection($codes),
                ]
            ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }

    public function useBoostCode(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            $this->validate($request, [
                'boost_code' => 'required|string|max:8|exists:boost_code_providers',
                'deal_id' => 'required|integer|exists:sub_categories,id'
            ]);

            //Get the current user
            $user = Auth::guard('api')->user();

            //Deal on which the boost code is applied
            /** @var Deal $useOnDeal */
            $useOnDeal = Deal::find($request->input('deal_id'));

            //Check if Deal have any used Boost Codes
            $usedBoostCodes = $useOnDeal->boost_codes()
                ->where('user_id', '=', $user->id)->get();
            if (count($usedBoostCodes) <= 0) {
                //Get Boost code Provider
                /** @var BoostCodeProvider $boostCodeProvider */
                $boostCodeProvider = BoostCodeProvider::
                where('boost_code', $request->input('boost_code'))
                    ->first();

                $userBoostCode = $boostCodeProvider->code_used()
                    ->where('status', '=', UserBoostCode::STATUS_UNUSED)
                    ->where('user_id', '=', $user->id)
                    ->first();
                if ($userBoostCode instanceof UserBoostCode) {
                    $userBoostCode->useOnDeal($useOnDeal);
                    return response()->json([
                        'status' => 'Success',
                        'message' => 'Used Boost Code on Deal Successfully'
                    ], 200);
                } else {
                    //Boost code Already used or not allocated
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'Boost Code Already Used or Never Obtained'
                    ], 401);
                }
            } else {
                //Deal Already boosted
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Deal already boosted.'
                ], 401);
            }
        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }


}
