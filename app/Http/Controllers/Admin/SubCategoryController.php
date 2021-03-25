<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Category;
use App\Models\Admin\Deal;
use Response;
use File;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Deal $deal)
    {
        $dataDeals = Deal::with('categories')->get()->toArray();
        return view("admin.deal.list")->with('deals', $dataDeals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $categoryData = $category->get()->toArray();
        return view("admin.deal.add")->with('categories', $categoryData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Deal $deal)
    {
        $rules = array(
            'category' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'description' => 'required',
            'end_date' => 'required|date'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/deal/add')->withErrors($validator);
        } else {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/deal'), $imageName);

            $name = $request->name;
            $category = $request->category;
            $description = $request->description;
            $end_date = $request->end_date;
            
            $deal->name = $name;
            $deal->image = $imageName;
            $deal->description = $description;
            $deal->category_id = $category;
            $deal->end_date = $end_date;

            try {
                $deal->save();
                return redirect('admin/deal/add')->with('success', "Deal Saved Successfully!");
            } catch(Exception $e) {
                return redirect('admin/deal/add')->with('error', "Error! Data couldn't Save!");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {
        $deal = Deal::where('id', $id)->first()->toArray();
        $categoryData = $category->get()->toArray();
        return view('admin.deal.edit', compact('deal'))->with('categories', $categoryData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
            'end_date' => 'required|date'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/deal/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $deal = Deal::find($id);

            $main_image = Input::file('image');
            if (Input::has('image')) {
                $imageTempName = $main_image->getPathname();
                $timestamp = date('YmdHis');
                $imageName =  $timestamp. '-' .$main_image->getClientOriginalName();
                $deal->image = $imageName;
                $folderpath = base_path() . '/public/upload/deal/';

                if (!file_exists($folderpath)) {
                    File::makeDirectory($folderpath, 0777, true, true);
                }
                $main_image->move($folderpath, $imageName);
                $deal->image = $imageName;
            }

            $name = $request->name;
            $category = $request->category;
            $description = $request->description;
            $end_date = $request->end_date;
            
            $deal->name = $name;
            $deal->description = $description;
            $deal->category_id = $category;
            $deal->end_date = $end_date;

            try {
                $deal->save();
                return redirect('admin/deal/edit/'.$id)->with('success', "Deal updated Successfully!");
            } catch (Exception $e) {
                return redirect('admin/deal/edit/'.$id)->with('error', "Error! Data couldn't Save!");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealData = Deal::where('id', $id)->first()->toArray();
        $imagePath = public_path().'/upload/deal/'.$dealData['image'];
        if (file_exists($imagePath)) {
            \File::delete($imagePath);
        }
    
        $deleteDeal = Deal::find($id)->delete();
        if ($deleteDeal) {
            return Redirect::to('admin/deal/list')->with('success', 'Deal deleted successfully');
        } else {
            return Redirect::to('admin/deal/list')->with('error', "Error! Data couldn't Deleted!");
        }
    }

    public function deleteImage(Request $request, Deal $deal)
    {
        $error=0;
        $imageName = $request->image;
        $dealId = $request->id;
        $main_image = Input::file('image');
        $imagepath = public_path() . '/upload/deal/'.$imageName;
        
        if(File::exists($imagepath)){
            if(unlink($imagepath)){
                $deal->where('id', $dealId)->update(array('image'=>''));
                $error=0;
            } else {
                $error=1;
            }
        }

        if($error==0){
            return Response::json(array(
                'success' => true,
                'message'   => "Image removed successfully!"
            ));
        } else {
            return Response::json(array(
                'success' => false,
                'message'   => "Error! Image couldn't deleted!"
            ));
        }
    }
}
