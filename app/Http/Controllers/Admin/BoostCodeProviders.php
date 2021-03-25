<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\BoostCodeProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Response;
use File;

class BoostCodeProviders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = BoostCodeProvider::where('is_city', 1)->get();
        $Others = BoostCodeProvider::where('is_city', 0)->get();
        return view('admin.boost_code_providers.list')
            ->with('cities', $cities)
            ->with('others', $Others);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.boost_code_providers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BoostCodeProvider $boostCodeProvider)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'country' => 'required',
            'credits' => 'required',
            'commission_rate' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/boost_code_providers/create')->withErrors($validator);
        } else {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/boost_code_providers'), $imageName);

            $is_city = isset($request->is_city) ? "1" : "0";
            $name = $request->name;
            $description = $request->description;
            $address = $request->address;
            $city = $request->city;
            $country = $request->country;
            $zipcode = $request->zipcode;
            $credits = $request->credits;
            $commission_rate = $request->commission_rate;
        
            $boostCodeProvider->boost_code = strtoupper(str_random(8));
            $boostCodeProvider->unique_id = strtoupper(str_random(8));
            $boostCodeProvider->name = $name;
            $boostCodeProvider->description = $description;
            $boostCodeProvider->address = $address;
            $boostCodeProvider->is_city = $is_city;
            $boostCodeProvider->city = $city;
            $boostCodeProvider->country = $country;
            $boostCodeProvider->zipcode = $zipcode;
            $boostCodeProvider->credits_total = $credits;
            $boostCodeProvider->commission_rate = $commission_rate;
            $boostCodeProvider->image = $imageName;
            
            try {
                $boostCodeProvider->save();
                return redirect('admin/boost_code_providers/create')->with('success', "Boost Code Provider Saved Successfully!");
            } catch(Exception $e) {
                return redirect('admin/boost_code_providers/create')->with('error', "Error! Data couldn't Save!");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boostCodeProvider = BoostCodeProvider::find($id);
        return view('admin.boost_code_providers.add')
            ->with('boostCodeProvider', $boostCodeProvider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boostCodeProvider = BoostCodeProvider::where('id', $id)->first()->toArray();
        return view('admin.boost_code_providers.edit')
            ->with('boostCodeProvider', $boostCodeProvider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'country' => 'required',
            'credits' => 'required',
            'commission_rate' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/boost_code_providers/create')->withErrors($validator);
        } else {
            $boostCodeProvider = BoostCodeProvider::find($id);

            if (isset($request->image)) {
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('/upload/boost_code_providers'), $imageName);
                $boostCodeProvider->image = $imageName;
            }
            
            $is_city = $request->is_city=="on" ? "1" : "0";

            $name = $request->name;
            $description = $request->description;
            $address = $request->address;
            $city = $request->city;
            $country = $request->country;
            $zipcode = $request->zipcode;
            $credits = $request->credits;
            $commission_rate = $request->commission_rate;
        
            $boostCodeProvider->name = $name;
            $boostCodeProvider->description = $description;
            $boostCodeProvider->address = $address;
            $boostCodeProvider->is_city = $is_city;
            $boostCodeProvider->city = $city;
            $boostCodeProvider->country = $country;
            $boostCodeProvider->zipcode = $zipcode;
            $boostCodeProvider->credits_total = $credits;
            $boostCodeProvider->commission_rate = $commission_rate;

            try {
                $boostCodeProvider->save();
                return redirect('admin/boost_code_providers/edit/'.$id)->with('success', "Boost Code Provider updated Successfully!");
            } catch (Exception $e) {
                return redirect('admin/boost_code_providers/edit/'.$id)->with('error', "Error! Data couldn't Save!");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BoostCodeProvider::destroy($id);
        return back()->withSuccess('Deleted Boost Code Provider Successfully.');
    }
}
