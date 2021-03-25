<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\User;
use App\Models\Admin\Appointment;
use App\Models\Admin\Deal;
use App\Models\Admin\ServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{

	/**
     * Book Online a service provider api
     * POST api/book_online
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookOnline(Request $request)
    {
    	//Api Authentication
        if (Auth::guard('api')->check()) {
            //Request Validation
            $this->validate($request, [
                'brand_id' => 'required',
                'appointment_date' => 'required',
                'job_info' => 'required',
                'slot' => 'required|in:'.Appointment::SLOT_MORNING.','.Appointment::SLOT_AFTERNOON.','.Appointment::SLOT_EVENING,
            ]);

            //Get the current user
            $user = Auth::guard('api')->user();

            // @var day 1 of the month
            $from = new Carbon('first day of this month');
            // @var last day of the month
        	$to = new Carbon('last day of this month');


            // check service provider exist
            $provider = ServiceProvider::find($request->input('brand_id'));
            if (!$provider instanceof ServiceProvider) {
                //ServiceProvider not found
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Brand not found.'
                ], 404);
            }


            // check already an appointment is requested which is in bokked/new
            $appointment = $user->appointments()
            			->whereBetween('created_at', [$from->toDateString(), $to->toDateString()])
            			->where('status', '!=', Appointment::STATUS_COMPLETED)
            			->where('service_provider_id', $provider->id)
            			->first();
           	if($appointment instanceof Appointment) {
            	//Deal is already used by this users this month.
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Already requested for an appointment.'
                ], 500);
            }


            // check the deal is unlocked
            $deal = $user->home_button->unlocked_deals()->where('sub_category_id', $provider->sub_category_id)->first();

			if (!$deal instanceof Deal) {
				//Deal locked for this user's home button
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Please unlock the deal first.'
                ], 500);
			}         

			// check user already used this deal in this month			
        	$dealUsed = $user->used_deals()
        				->wherePivot('created_at', '>=', $from)
        				->wherePivot('created_at', '<=', $to)
        				->where('deal_id', $deal->id)->first();
            if($dealUsed instanceof Deal) {
            	//Deal is already used by this users this month.
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Deal is already used by this users this month.'
                ], 500);
            }


            // Going good. Create an appointment now
            Appointment::create([
	            'user_id' => $user->id,
	            'service_provider_id' => $provider->id,
	            'appointment_date' => $request->input('appointment_date'),
	            'job_info' => $request->input('job_info'),
	            'slot' => $request->input('slot'),
	            'status' => Appointment::STATUS_NEW, // start as Trial User
	        ]);            

            return response()->json([
                    'status' => 'Success',
                    'message' => 'Appointment Request successfully received.'
                ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Api Authentication Failed.'
            ], 401);
        }

    }
}	