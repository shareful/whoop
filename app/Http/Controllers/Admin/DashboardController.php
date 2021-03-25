<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin\Address;
use App\Models\Admin\Project;
use App\Models\Admin\Bank;

class DashboardController extends Controller
{
    public function index() 
    {   
         return view("admin.dashboard");
    }
}
