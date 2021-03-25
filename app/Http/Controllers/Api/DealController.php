<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\HomeButton;
use App\Models\Admin\ServiceProvider;
use App\Models\Admin\User;
use App\Models\Admin\Deal;
use App\Models\Admin\Category;
use App\Models\Admin\Messages\EventMessage;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DealResource;
use App\Http\Resources\DealResourceCollection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
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
                'data' => [
                    'total' => $total
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
     * Return total number of deals available to unlock for user
     * GET - api/user/home_button/deals/to_unlock/count
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function homeButtonTotalDealsAvailableToUnlock(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            $deals_unlocked_count = 0;

            //Check current user have Home Button
            if ($user->home_button instanceof HomeButton) {
                $deals_unlocked_count = $user->home_button->unlocked_deals->count();
            }

            // Total deals count
            $deals_count = Deal::all()->count();

            $total_to_unlock = $deals_count - $deals_unlocked_count;

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'total' => $total_to_unlock
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
     * Return list of locked deals for user home button by category
     * GET - api/category/{category_id}/deals_locked/list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lockedDealListByCategory(Category $category, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            // @var Collection to contain list of ids of unlocked deals
            $unlockedDealIds = collect();

            //Check current user have Home Button
            if ($user->home_button instanceof HomeButton) {
                // Find Ids of deals unlocked by home button
                $unlockedDealIds = $user->home_button->unlocked_deals->map(function ($deal) {
                    return $deal->id;
                });
            }

            $lockedDeals = $category->deals->reject(function ($deal) use ($unlockedDealIds) {
                return in_array($deal->id, $unlockedDealIds->toArray());
            })->map(function ($deal) {
                // @var array to contain deal information
                return new DealResource($deal);
            });


            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'category' => new CategoryResource($category),
                    'locked_deals' => new DealResourceCollection($lockedDeals),
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
     * Return list of unlocked deals for user home button by category
     * GET - api/category/{category_id}/deals_unlocked/list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlockedDealListByCategory(Category $category, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            //Check if current user already have Home Button
            if (!$user->home_button instanceof HomeButton) {
                //User don't have a Home Button
                return response()->json([
                    'status' => 'Error',
                    'message' => 'User don\'t have a Home Button yet.'
                ], 500);

            }

            // @var Collection to contain list of ids of unlocked deals
            $unlockedDealIds = collect();

            //Check current user have Home Button
            if ($user->home_button instanceof HomeButton) {
                // Find Ids of deals unlocked by home button
                $unlockedDealIds = $user->home_button->unlocked_deals->map(function ($deal) {
                    return $deal->id;
                });
            }

            $unlockedDeals = $category->deals->reject(function ($deal) use ($unlockedDealIds) {
                return !in_array($deal->id, $unlockedDealIds->toArray());
            })->map(function ($deal) {
                // @var array to contain deal information
                return new DealResource($deal);
            });


            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'category' => new CategoryResource($category),
                    'unlocked_deals' => new DealResourceCollection($unlockedDeals),
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
     * Unlock a locked deals by user for home button
     * POST - api/deal/unlock
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlockDeal(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            //Check current user have Home Button
            if (!$user->home_button instanceof HomeButton) {
                //User don't have a Home Button
                return response()->json([
                    'status' => 'Error',
                    'message' => 'User don\'t have a Home Button yet.'
                ], 500);
            }

            //Validation
            $this->validate($request, [
                'deal_id' => 'required'
            ]);

            $deal = Deal::find($request->input('deal_id'));
            if (!$deal instanceof Deal) {
                //Deal Not found
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Deal not found.'
                ], 500);
            }

            // @var Collection to contain list of ids of unlocked deals
            $unlockedDealIds = collect();

            // Find Ids of deals unlocked by home button
            $unlockedDealIds = $user->home_button->unlocked_deals->map(function ($deal) {
                return $deal->id;
            });

            if (in_array($deal->id, $unlockedDealIds->toArray())) {
                //Already unlocked this deal
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Already unlocked this deal.'
                ], 500);
            }

            // Unlocked the deal now and Save 
            $user->home_button->unlocked_deals()->attach($request->input('deal_id'), ['unlocked_by' => $user->id]);

            // Trigger User Unlocked Deal Event
            EventMessage::addUserUnlockedDealEvent($user, $deal);

            //Return on success
            return response()->json([
                'status' => 'Success',
                'message' => 'The deal has been unlocked for user home button.'
            ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }

    public function getDealList()
    {
//        $status = 'Error';
//        $message = "Deal not found.";
//        $response = array();
//        $current_date = date('Y-m-d', strtotime("+ 8 days"));
//
//        $deal_list = Deal::whereDate('end_date', '<', $current_date)->with('category')->get();
//        if (count($deal_list) > 0) {
//            $status = 'Success';
//            $message = "Deal found successfully.";
//            $response = $deal_list;
//        }
//        return response()->json(['status' => $status, 'message' => $message, 'data' => (object)$response], 200);

        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            /** @var User $user */
            $user = Auth::guard('api')->user();

            //Get Used Deals to remove from list
            /** @var array $used_deal_ids */
            $used_deal_ids = $user->used_deals()->pluck('deal_id')->toArray();

            //Get unlocked deals of current user with end_date within 8 days
            /** @var array $deals_query */
            $deals_list = $user->home_button->unlocked_deals()
                ->whereDate('end_date', '>=', date('Y-m-d'))
                ->whereDate('end_date', '<', date('Y-m-d', strtotime('+ 8 days')))
                ->whereNotIn('sub_categories.id', $used_deal_ids)
                ->with('category')->get()->toArray();

            if (count($deals_list) > 0) {
                //Found Deals about to expire
                return response()->json([
                    'status' => 'Success',
                    'message' => 'Found deals about to expire.',
                    'data' => $deals_list
                ], 200);
            } else {
                //No deals are about to expire
                return response()->json([
                    'status' => 'None',
                    'message' => 'No deals are about to expire.'
                ], 200);
            }
        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthenticated User.'
            ], 401);
        }
    }

    public function useDeal($deal_id, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            $this->validate($request, [
                'service_provider_id' => 'required|integer|exists:service_providers,id'
            ]);

            //Get the current user
            $user = Auth::guard('api')->user();

            //Get the deal
            $deal = Deal::find($deal_id);
            if ($deal instanceof Deal) {
                //Check if user have this deal unlocked and user haven't used this deal
                if ($user->home_button->unlocked_deals->contains($deal->id) &&
                    !$deal->used_users->contains($user->id)) {
                    $deal->used_users()->attach($user->id, [
                        'service_provider_id' => $request->input('service_provider_id')
                    ]);
                    //Return on success
                    return response()->json([
                        'status' => 'Success',
                        'message' => 'Deal Used Successfully.'
                    ], 200);
                } else {
                    //Deal not available to user
                    return response()->json([
                        'status' => 'Error',
                        'message' => 'Deal Not Available to User.'
                    ], 401);
                }
            } else {
                //Invalid Deal ID
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Deal Not found.'
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

    public function listUsedDeals()
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            /** @var User $user */
            $user = Auth::guard('api')->user();

            /** @var array $usedDeals */
            $usedDeals = $user->used_deals->map(function ($deal) {
                $service_provider = ServiceProvider::find($deal->pivot->service_provider_id);
                if ($service_provider instanceof ServiceProvider) {
                    $service_provider = $service_provider->toArray();
                } else {
                    $service_provider = 'Not Found';
                }
                /** @var Deal $deal */
                return [
                    'deal' => $deal->toArray(),
                    'service_provider' => $service_provider
                ];
            })->toArray();

            return response()->json([
                'status' => 'Success',
                'message' => 'List of used deals.',
                'data' => $usedDeals
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
