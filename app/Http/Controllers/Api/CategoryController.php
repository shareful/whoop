<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\HomeButton;
use App\Models\Admin\User;
use App\Models\Admin\Category;
use App\Models\Admin\Deal;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CategoryController extends Controller
{
    /**
     * Return list of categories with count of locked deals
     * GET - api/category/list/with/deals_locked/count
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listWithDealsLockedCount(Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {

            //Get the current user
            $user = Auth::guard('api')->user();

            // @var Collection to contain list of ids of unlocked deals
            $unlockedDealIds = collect();

            //Check if current user already have Home Button
            if ($user->home_button instanceof HomeButton) {
                // Find Ids of deals unlocked by home button
                $unlockedDealIds = $user->home_button->unlocked_deals->map(function ($deal) {
                    return $deal->id;
                });
            }

            // List of categories
            $categories = Category::where('is_national', 1)->orderBy('name', 'asc')->get();

            // create data to return as api response
            $data = $categories->map(function ($category) use ($unlockedDealIds, $request) {
                // @var array to contain category information
                $item = new CategoryResource($category);
                $item = $item->toArray($request);

                // check to see the deals is unlocked, if not then consider to count
                $item['locked_deals_count'] = $category->deals->reject(function ($deal) use ($unlockedDealIds) {
                    return in_array($deal->id, $unlockedDealIds->toArray());
                })->count();

                return (object)$item;
            });

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'total' => sizeof($data),
                    'categories' => new CategoryResourceCollection($data)
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
     * Return list of categories with count of locked deals
     * GET - api/category/list/with/deals_unlocked/count
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listWithDealsUnLockedCount(Request $request)
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

            // Find Ids of deals unlocked by home button
            $unlockedDealIds = $user->home_button->unlocked_deals->map(function ($deal) {
                return $deal->id;
            });

            // List of categories
            $categories = Category::where('is_national', 1)->orderBy('name', 'asc')->get();

            // create data to return as api response
            $data = $categories->map(function ($category) use ($unlockedDealIds, $request) {
                // @var array to contain category information
                $item = new CategoryResource($category);
                $item = $item->toArray($request);

                // check to see the deals is unlocked, if unlocked consider to count
                $item['unlocked_deals_count'] = $category->deals->reject(function ($deal) use ($unlockedDealIds) {
                    return !in_array($deal->id, $unlockedDealIds->toArray());
                })->count();

                return (object)$item;
            });

            //Return on success
            return response()->json([
                'status' => 'Success',
                'data' => [
                    'total' => sizeof($data),
                    'categories' => new CategoryResourceCollection($data)
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

            //Check if current user already have Home Button
            if ($user->home_button instanceof HomeButton) {
                $deals_unlocked_count = $user->home_button->unlocked_deals->count();
            }

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

    public function getCategoryList(Request $request)
    {
        if (Auth::guard('api')->check()) {
            $this->user = Auth::guard('api')->user();
            $this->request = $request;
            $status = "Error";
            $message = "Category Not Found";
            $response = array();
            $user = $this->user;

            $unlockedDealCategoryIds = $user->deals_unlocked->map(function ($deal) {
                return $deal->category_id;
            });

            $category = $this->getCategoryListUsingIds($unlockedDealCategoryIds);

            if (count($category) > 0) {

                $status = 'Success';
                $message = "Category list Found successfully.";
                $response = $category;
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $response
            ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Api Authentication Failed.'
            ], 401);
        }
    }

    private function getCategoryListUsingIds($categoryIds)
    {
        $category = Category::whereIn('id', $categoryIds)->get();

        if (count($category) > 0) {
            foreach ($category as $key => $value) {
                $no_of_deal = Deal::where('category_id', $value->id)->count();
                $category[$key]->no_of_deal = $no_of_deal;
            }
        }
        return $category;
    }

}
