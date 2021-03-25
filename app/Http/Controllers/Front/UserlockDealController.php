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

class UserlockDealController extends Controller
{
    public function category_list_with_deal_locked_count(Request $request) 
    {   
    	return view("front.lock_deal.category_list_with_deal_locked_count",array('title'=>'Category List With Deal locked Count'));
    }

    public function category_deals_locked_list($category_id) {
    	return view("front.lock_deal.category_deals_locked_list",array('title'=>'Category Deal locked list','category_id'=>$category_id));
    }
    
}
