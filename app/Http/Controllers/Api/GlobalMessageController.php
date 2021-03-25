<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Response, Config;

class GlobalMessageController extends Controller
{
    public function getHelloMessage()
    {
        $status = 'Success';
        $message = "Hello message found successfully.";
        $response = Config::get('messageConfig.HELLO');
        return response()->json(['status' => $status, 'message' => $message, 'data' => (object)$response], 200);
    }

    public function getServiceProviderMessage()
    {
        $status = 'Success';
        $message = "Service Provider message found successfully.";
        $response = Config::get('messageConfig.PROVIDER');
        return response()->json(['status' => $status, 'message' => $message, 'data' => (object)$response], 200);
    }
}
