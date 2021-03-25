<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Category;
use Response;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $categoryData = $category->get()->toArray();
        return view("admin.category.list")->with('categories', $categoryData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.category.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $rules = array(
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'description' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/category/add')->withErrors($validator);
        } else {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/category'), $imageName);

            $name = $request->name;
            $description = $request->description;
            $is_national = isset($request->is_national)?'1':'0';

            $category->name = $name;
            $category->image = $imageName;
            $category->description = $description;
            $category->is_national = $is_national;

            try {
                $category->save();
                return redirect('admin/category/add')->with('success', "Category Saved Successfully!");
            } catch(Exception $e) {
                return redirect('admin/category/add')->with('error', "Error! Data couldn't Save!");
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
    public function edit($id)
    {
        $category = Category::where('id', $id)->first()->toArray();
        return view('admin.category.edit', compact('category'));
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
            'name'       => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1024',
            'description'       => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/category/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $category = Category::find($id);

            $category->name       = $request->name;
            $category->description      = $request->description;
            $category->is_national = isset($request->is_national)?'1':'0';

        
            $main_image = Input::file('image');
            if (Input::hasFile('image')) {
                $imageTempName = $main_image->getPathname();
                $timestamp = date('YmdHis');
                $imageName =  $timestamp. '-' .$main_image->getClientOriginalName();
                $category->image = $imageName;
                $folderpath = base_path() . '/public/upload/category/';

                if (!file_exists($folderpath)) {
                    File::makeDirectory($folderpath, 0777, true, true);
                }
                $main_image->move($folderpath, $imageName);
            }

            try {
                $category->save();
                return redirect('admin/category/edit/'.$id)->with('success', "Category updated Successfully!");
            } catch (Exception $e) {
                return redirect('admin/category/edit/'.$id)->with('error', "Error! Data couldn't Save!");
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
        $categoryData = Category::where('id', $id)->first()->toArray();
        $imagePath = public_path().'/upload/category/'.$categoryData['image'];
        if (file_exists($imagePath)) {
            \File::delete($imagePath);
        }
            
        $deleteCategory = Category::find($id);
        //Delete associated deals
        $deleteCategory->deal()->delete();
        $deleteCategory->delete();

        if ($deleteCategory) {
            return Redirect::to('admin/category/list')->with('success', 'Category deleted successfully');
        } else {
            return Redirect::to('admin/category/list')->with('error', "Error! Data couldn't Deleted!");
        }
    }

    public function deleteImage(Request $request, Category $category)
    {
        $error=0;
        $imageName = $request->image;
        $categoryId = $request->id;
        $main_image = Input::file('image');
        $imagepath = public_path() . '/upload/category/'.$imageName;
        
        if(File::exists($imagepath)){
            if(unlink($imagepath)){
                $category->where('id', $categoryId)->update(array('image'=>''));
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
