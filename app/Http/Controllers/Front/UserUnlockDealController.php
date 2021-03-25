<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin\Address;
use App\Models\Admin\Project;
use App\Models\Admin\Bank;
use Illuminate\Support\Facades\Validator;
use Auth,Session,URL;

class UserUnlockDealController extends Controller
{
    public function category_list_with_deal_unlocked_count(Request $request) 
    {   
    	return view("front.unlock_deal.category_list_with_deal_unlocked_count",array('title'=>'Category List With Deal Unlocked Count'));
    }

    public function category_deals_unlocked_list($category_id) {
    	return view("front.unlock_deal.category_deals_unlocked_list",array('title'=>'Category Deal unlocked list','category_id'=>$category_id));
    }
    
    
}
