<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\User;
use App\Models\Admin\Cities;
use App\Models\Admin\Messages\EventMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    const UPLOAD_PATH = 'user';

    protected $apiActions = ['add_photo', 'update_email', 'update_password'];
    /** @var User $user */
    protected $user;
    /** @var  Request $request */
    protected $request;

    /**
     * Execute different function according to the action provided,
     * essentially one function for multiple operations
     *
     * @param $action
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile($action, Request $request)
    {
        //Api Authentication
        if (Auth::guard('api')->check()) {
            //Get current user
            /** @var User $user */
            $this->user = Auth::guard('api')->user();
            $this->request = $request;
            switch ($action) {
                case 'photo':
                    return $this->addPhoto();
                    break;
                case 'email':
                    return $this->updateEmail();
                    break;
                case 'password':
                    return $this->updatePassword();
                    break;
            }
            return response()->json([
                'status' => 'Error',
                'message' => 'Invalid action ' . $request->input('action')
            ], 500);
        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Api Authentication Failed.'
            ], 401);
        }
    }

    // get event list of current user
    public function getEventList(Request $request) {
        if (Auth::guard('api')->check()) {
            $this->user = Auth::guard('api')->user();
            $this->request = $request;
            $status = "Error";
            $message = "Event Not Found";
            $response = array();

            //print_r($this->user->toArray());exit;
            $event_list = EventMessage::getEventsOfUser($this->user);

            if(count($event_list)>0) {
                $status = 'Success';
                $message = "Event list Found successfully.";
                $response = $event_list;
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data'=>$event_list
            ], 200);

        } else {
            //Api Authentication Failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Api Authentication Failed.'
            ], 401);
        }
    }

    /**
     * Save the uploaded photo as the current user's Photo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPhoto()
    {
        //Image Validation
        $this->validate($this->request, [
            'image' => 'required|image'
        ]);

        //Remember Old file to delete after success
        $old_photo = $this->user->photo;

        //Get Image from request and Store in public
        $file = $this->request->file('image')->store(
            self::UPLOAD_PATH, 'upload'
        );
        //Get URL of the Uploaded Image
        $file_url = Storage::disk('upload')->url($file);

        //Save Photo URL
        $this->user->photo = $file_url;

        if ($this->user->save()) {
            //Delete Old Photo
            if (Storage::disk('upload')->exists('/' . self::UPLOAD_PATH . '/' . basename($old_photo))
                && $old_photo != '') {
                Storage::disk('upload')->delete('/' . self::UPLOAD_PATH . '/' . basename($old_photo));
            }

            //Photo Uploaded and Saved Successfully
            return response()->json([
                'status' => 'Success',
                'message' => 'Added Photo Successfully.'
            ], 200);
        } else {
            //Saving changes failed
            return response()->json([
                'status' => 'Error',
                'message' => 'Photo Upload Failed.'
            ], 500);
        }
    }

    /**
     * Change Email of the current user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEmail()
    {
        //Email Validation
        $this->validate($this->request, [
            'email' => 'required|email|max:255'
        ]);
        $this->user->email = $this->request->input('email');
        if ($this->user->save()) {
            //Email Updated successfully
            return response()->json([
                'status' => 'Success',
                'message' => 'Email Updated Successfully.'
            ], 200);
        } else {
            //Saving changes failed.
            return response()->json([
                'status' => 'Error',
                'message' => 'Email Update Failed.'
            ], 500);
        }
    }

    /**
     * Change Password of the current user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword()
    {
        //Password Validation
        $this->validate($this->request, [
            'password' => 'required|confirmed|min:8'
        ]);
        $this->user->password = Hash::make($this->request->input('password'));
        if ($this->user->save()) {
            //Password Updated successfully
            return response()->json([
                'status' => 'Success',
                'message' => 'Password Updated Successfully.'
            ], 200);
        } else {
            //Saving changes failed.
            return response()->json([
                'status' => 'Error',
                'message' => 'Password Update Failed.'
            ], 500);
        }
    }

    /**
     * Get list of cities.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCityList(Request $request, Cities $cities)
    {
        if (Auth::guard('api')->check()) {
            $this->user = Auth::guard('api')->user();
            $this->request = $request;
            $getCities = $cities->get()->toArray();

            if(count($getCities)>0) {

                $status = 'Success';
                $message = "City list Found successfully.";
                $response = $getCities;
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data'=>$response
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
