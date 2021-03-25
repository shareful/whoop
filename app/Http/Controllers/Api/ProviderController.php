<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\User;
use App\Models\Admin\Deal;
use App\Models\Admin\ServiceProvider;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ProviderResourceCollection;
use App\Http\Resources\DealResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ProviderController extends Controller
{

    /**
     * Return list of service providers with details for a deal
     * GET - api/deal/{deal}/brand/list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListByDeal(Deal $deal, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            $brands = $deal->providers;


            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'deal' => new DealResource($deal),
                    'brands' => new ProviderResourceCollection($brands),
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
     * Search service providers for a deal
     * GET - api/brand/search?id={id}&q={name}
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

            $keyword = $request->query('q', false);

            if (!$keyword) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Provide at least one search term.'
                ], 500);
            }

            $where = [];
            $where[] = ['brand_name', 'like', '%' . $keyword . '%'];

            $brands = ServiceProvider::where($where)->get();

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'count' => $brands->count(),
                    'brands' => new ProviderResourceCollection($brands),
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
     * Return detail of a service provider
     * GET - api/brand/{provider}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(int $id, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            $provider = ServiceProvider::find($id);

            if (!$provider instanceof ServiceProvider) {
                //ServiceProvider not found
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Brand not found.'
                ], 404);
            }

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => new ProviderResource($provider)
            ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }

    // get service provider api using id
    public function getDetail(Request $request, $providerId)
    {
        $status = 'Error';
        $message = 'Unauthenticated User.';
        $data = array();
        $code = 401;
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();
            $code = 200;
            $provider = ServiceProvider::find($providerId);
            if ($provider instanceof ServiceProvider) {
                $status = 'Success';
                $message = 'Service Provider found successfully.';
                $data = new ProviderResource($provider);
            } else {
                $message = 'Service Provider not found.';
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => (object)$data
        ], $code);
    }

    public function getAvailableServiceProviders()
    {
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            $whereCondition = "CONCAT(',',RTRIM(available_for_zipcodes),',') LIKE '%,"
                . $user->zipcode . ",%'";

            $service_providers = ServiceProvider::
            whereRaw($whereCondition)
                ->get()->toArray();

            return response()->json([
                'status' => 'Success',
                'data' => $service_providers
            ], 401);

        } else {
            //Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }
}
