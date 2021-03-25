<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Messages\WizardMessage;
use Response,Config;
class WizardMessageController extends Controller
{
    public function  getWizardMessageList() {
        $status = 'Error';
        $message = "Wizard messages not found.";
        $response = array();
        $messages_wizard_data = WizardMessage::orderBy('position','asc')->where('status','Active')->get(array('id','position','icon','title','message','status'));
        if(count($messages_wizard_data)>0) {
            $status = 'Success';
            $message = "Wizard messages found successfully.";
            $response = $messages_wizard_data;
        }
        return response()->json(['status' => $status,'message' => $message,'data' => (object)$response],200); 
    }
}
