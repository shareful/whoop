<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Category;
use App\Models\Admin\ServiceProvider;
use App\Models\Admin\Deal;
use Response;
use File;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceProvider $provider)
    {
        $dataProviders = $provider->get()->toArray();
        return view("admin.provider.list")->with('providers', $dataProviders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $categoryData = $category->get()->toArray();
        return view("admin.provider.add")->with('categories', $categoryData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ServiceProvider $provider)
    {
        $rules = array(
            'deals' => 'required',
            'brand_name' => 'required',
            'strap_line' => 'required',
            'description' => 'required',
            'title' => 'required',
            'message' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'commission_rate' => 'required',
            'discount_rate' => 'required',
            'whoop_credit' => 'required',
            'video' => 'mimes:mp4,ogg,webm|max:5120',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/service-provider/add')->withErrors($validator);
        } else {
            $logoName = time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('/upload/provider'), $logoName);

            if (isset($request->video)) {
                $videoName = time() . '.' . $request->video->getClientOriginalExtension();
                $request->video->move(public_path('/upload/provider'), $videoName);
                $provider->video = $videoName;
            }
            $category = $request->category;
            $deals = $request->deals;
            $brand_name = $request->brand_name;
            $strap_line = $request->strap_line;
            $description = $request->description;
            $title = $request->title;
            $message = $request->message;
            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = $request->email;
            $mobile = $request->mobile;
            $street = $request->street;
            $city = $request->city;
            $zipcode = $request->zipcode;
            $state = $request->state;
            $country = $request->country;
            $available_for_zipcodes = $request->available_for_zipcodes;
            $web_url = $request->web_url;
            $color = $request->color;
            $commission_rate = $request->commission_rate;
            $discount_rate = $request->discount_rate;
            $unverified_commission_rate = $request->unverified_commission_rate;
            $whoop_credit = $request->whoop_credit;

            $provider->category_id = $category;
            $provider->sub_category_id = $deals;
            $provider->brand_name = $brand_name;
            $provider->strap_line = $strap_line;
            $provider->description = $description;
            $provider->title = $title;
            $provider->message = $message;
            $provider->firstname = $firstname;
            $provider->lastname = $lastname;
            $provider->email = $email;
            $provider->mobile = $mobile;
            $provider->street = $street;
            $provider->city = $city;
            $provider->zipcode = $zipcode;
            $provider->state = $state;
            $provider->country = $country;
            $provider->available_for_zipcodes = $available_for_zipcodes;
            $provider->web_url = $web_url;
            $provider->logo = $logoName;
            $provider->color = $color;
            $provider->commission_rate = $commission_rate;
            $provider->discount_rate = $discount_rate;
            $provider->unverified_commission_rate = $unverified_commission_rate;
            $provider->whoop_credit = $whoop_credit;

            try {
                $provider->save();
                return redirect('admin/service-provider/add')->with('success', "Service ServiceProvider Saved Successfully!");
            } catch (Exception $e) {
                return redirect('admin/service-provider/add')->with('error', "Error! Data couldn't Save!");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category, Deal $deal)
    {
        $categoryData = $category->get()->toArray();
        $dealData = $deal->get()->toArray();

        $provider = ServiceProvider::where('id', $id)->first()->toArray();
        return view('admin.provider.edit', compact('provider'))->with('providers', $provider)->with('categories', $categoryData)->with('deals', $dealData);
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
            'deals' => 'required',
            'brand_name' => 'required',
            'strap_line' => 'required',
            'description' => 'required',
            'title' => 'required',
            'message' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'commission_rate' => 'required',
            'discount_rate' => 'required',
            'whoop_credit' => 'required',
            'video' => 'mimes:mp4,ogg,webm|max:5120',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/service-provider/add')->withErrors($validator);
        } else {
            $provider = ServiceProvider::find($id);

            if (isset($request->logo)) {
                $logoName = time() . '.' . $request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('/upload/provider'), $logoName);
                $provider->logo = $logoName;
            }

            if (isset($request->video)) {
                $videoName = time() . '.' . $request->video->getClientOriginalExtension();
                $request->video->move(public_path('/upload/provider'), $videoName);
                $provider->video = $videoName;
            }

            $category = $request->category;
            $deals = $request->deals;
            $brand_name = $request->brand_name;
            $strap_line = $request->strap_line;
            $description = $request->description;
            $title = $request->title;
            $message = $request->message;
            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = $request->email;
            $mobile = $request->mobile;
            $street = $request->street;
            $city = $request->city;
            $zipcode = $request->zipcode;
            $state = $request->state;
            $country = $request->country;
            $available_for_zipcodes = $request->available_for_zipcodes;
            $web_url = $request->web_url;
            $color = $request->color;
            $commission_rate = $request->commission_rate;
            $discount_rate = $request->discount_rate;
            $unverified_commission_rate = $request->unverified_commission_rate;
            $whoop_credit = $request->whoop_credit;

            $provider->category_id = $category;
            $provider->sub_category_id = $deals;
            $provider->brand_name = $brand_name;
            $provider->strap_line = $strap_line;
            $provider->description = $description;
            $provider->title = $title;
            $provider->message = $message;
            $provider->firstname = $firstname;
            $provider->lastname = $lastname;
            $provider->email = $email;
            $provider->mobile = $mobile;
            $provider->street = $street;
            $provider->city = $city;
            $provider->zipcode = $zipcode;
            $provider->state = $state;
            $provider->country = $country;
            $provider->available_for_zipcodes = $available_for_zipcodes;
            $provider->web_url = $web_url;
            $provider->color = $color;
            $provider->commission_rate = $commission_rate;
            $provider->discount_rate = $discount_rate;
            $provider->unverified_commission_rate = $unverified_commission_rate;
            $provider->whoop_credit = $whoop_credit;

            try {
                $provider->save();
                return redirect('admin/service-provider/edit/' . $id)->with('success', "Service Provider updated Successfully!");
            } catch (Exception $e) {
                return redirect('admin/service-provider/edit/' . $id)->with('error', "Error! Data couldn't Save!");
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
        $providerData = ServiceProvider::where('id', $id)->first()->toArray();
        $imagePath = public_path() . '/upload/provider/' . $providerData['logo'];
        if (file_exists($imagePath)) {
            \File::delete($imagePath);
        }

        $videoPath = public_path() . '/upload/provider/' . $providerData['video'];
        if (file_exists($videoPath)) {
            \File::delete($videoPath);
        }

        $deleteProvider = ServiceProvider::find($id)->delete();
        if ($deleteProvider) {
            return Redirect::to('admin/service-provider/list')->with('success', 'Deal deleted successfully');
        } else {
            return Redirect::to('admin/service-provider/list')->with('error', "Error! Data couldn't Deleted!");
        }
    }

    public function getDeals(Request $request, ServiceProvider $provider)
    {
        $getCatgoryId = $request->cat_id;
        $dealsData = Category::find($getCatgoryId)->deal()->get()->toArray();

        $optionData = '';
        if (!empty($dealsData)) {
            $optionData = '<select class="form-control" name="deals" id="deals">';
            foreach ($dealsData as $key => $value) {
                if ($value['id'] == $provider['sub_category_id']) {
                    $optionData .= '<option value="' . $value['id'] . '" selected="selected">' . $value['name'] . '</option>';
                } else {
                    $optionData .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                }
            }
            $optionData .= '</select>';

            return Response::json(array(
                'success' => true,
                'data' => $optionData
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'data' => "<span>No deals found!</span>"
            ));
        }
        exit;
    }

    public function deleteImage(Request $request, ServiceProvider $provider)
    {
        $error = 0;
        $imageName = $request->image;
        $providerId = $request->id;
        $main_image = Input::file('logo');
        $imagepath = public_path() . '/upload/provider/' . $imageName;

        if (File::exists($imagepath)) {
            if (unlink($imagepath)) {
                $provider->where('id', $providerId)->update(array('logo' => ''));
                $error = 0;
            } else {
                $error = 1;
            }
        }

        if ($error == 0) {
            return Response::json(array(
                'success' => true,
                'message' => "Image removed successfully!"
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'message' => "Error! Image couldn't deleted!"
            ));
        }
    }

    public function deleteVideo(Request $request, ServiceProvider $provider)
    {
        $error = 0;
        $videoName = $request->video;
        $providerId = $request->id;
        $main_image = Input::file('video');
        $videopath = public_path() . '/upload/provider/' . $videoName;

        if (File::exists($videopath)) {
            if (unlink($videopath)) {
                $provider->where('id', $providerId)->update(array('video' => ''));
                $error = 0;
            } else {
                $error = 1;
            }
        }

        if ($error == 0) {
            return Response::json(array(
                'success' => true,
                'message' => "Video removed successfully!"
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'message' => "Error! Video couldn't deleted!"
            ));
        }
    }
}
