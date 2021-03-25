<?php

namespace App\Http\Controllers\Admin\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_DISABLED = 'Disabled';

    /**
     * Sort the message display order
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sortUpdate(Request $request)
    {
        if ($request->exists('data') && $request->exists('model')) {
            //Todo : Find a better alternative
            foreach ($request->input('data') as $id => $position) {
                $model = 'App\Models\Admin\Messages\\' . $request->input('model');
                $model::where('id', $id)->update(['position' => $position]);
            }
            return response()->json([
                'status' => 'Success',
                'message' => 'Sort Order Updated.'
            ], 200);
        } else {
            //Data not found
            return response()->json([
                'status' => 'Error',
                'message' => 'Sort Order Update Failed.'
            ], 500);
        }
    }

    /**
     * Set the status of the message
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusUpdate(Request $request)
    {
        if ($request->exists('status') && $request->exists('id') && $request->exists('model')) {
            $model = 'App\Models\Admin\Messages\\' . $request->input('model');
            $status = $request->input('status') ? self::STATUS_ACTIVE :
                self::STATUS_DISABLED;
            $model::where('id', $request->input('id'))->update(['status' => $status]);
            return response()->json([
                'status' => 'Success',
                'message' => 'Status Updated Successfully.'
            ], 200);
        } else {
            //Status not found
            return response()->json([
                'status' => 'Error',
                'message' => 'Missing Required Data.'
            ], 500);
        }
    }
}
