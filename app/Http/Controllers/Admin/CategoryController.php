<?php

namespace App\Http\Controllers\Admin;

use App\Models\AttributeGroup;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->paginate(10);
        return view('Admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        return view('Admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);
        try{
            $category=new Category();
            $category->name=$request->input('title');
            $category->parent_id=$request->input('category_parent');
            $category->meta_title=$request->input('meta_title');
            $category->meta_desc=$request->input('meta_desc');
            $category->meta_keywords=$request->input('meta_keywords');
            $category->save();
            Session::flash('category_success','دسته بندی با موفقیت ایجاد شد');
            return redirect('/admins/categories');}
        catch (\Exception $m){
            Session::flash('category_error','خطایی در ثبت به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/categories');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $category=Category::findorfail($id);
        return view('Admin.categories.edit',compact('categories',$category));
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
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);
        try{
            $category=Category::findorfail($id);
            $category->name=$request->input('title');
            $category->parent_id=$request->input('category_parent');
            $category->meta_title=$request->input('meta_title');
            $category->meta_desc=$request->input('meta_desc');
            $category->meta_keywords=$request->input('meta_keywords');
            $category->save();
            Session::flash('category_success','ویرایش با موفقیت انجام شده است');
            return redirect('/admins/categories');}
        catch (\Exception $m){
            Session::flash('category_error','خطایی در ثبت به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/categories');
        }
    }
    public function delete($id){
        try{
            $category=Category::with('childrenRecursive')->where('id', $id)->first();
            if (count($category->childrenRecursive)>0) {
                Session::flash('error_category', 'دسته بندی '.$category->name.' دارای زیر دسته میباشد بنابراین حذف آن امکان پذیر نیست');
                return redirect('/admins/categories');
            }
            $category->delete();
            Session::flash('category_success', 'حذف با موفقیت انجام شد');
            return redirect('/admins/categories');}
        catch (\Exception $m) {
            Session::flash('category_error', 'خطایی در حذف به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/categories');
        }
    }
    public function indexSetting($id){
        $category=Category::findorfail($id);
        $attributeGroups=AttributeGroup::all();
        return view('Admin.categories.index-settings',compact(['category','attributeGroups']));
    }
    public function saveSetting(Request $request,$id){
        try{
            $category=Category::findorfail($id);
            $category->attributeGroups()->sync($request->attributeGroups);
            $category->save();
            Session::flash('category_success','عملیات با موفقیت انجام شد');
            return redirect()->to('admins/categories');}
        catch (\Exception $m){
            Session::flash('category_error','خطایی در ثبت به وجود آمده لطفا مجددا تلاش کنید');
            return redirect('/admins/categories');
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

    }

    public function apiIndex()
    {
        $categories=Category::with('childrenRecursive')
            ->where('parent_id',null)
            ->get();
        $response=[
            'categories'=>$categories
        ];
        return response()->json($response,200);

    }
    public function apiIndexAttribute(Request $request)
    {
        $categories=$request->all();
        $attributeGroup=AttributeGroup::with('attributeValue','categories')
            ->whereHas('categories',function ($q) use ($categories){
                $q->whereIn('categories.id',$categories);
            })->get();
        $response=[
            'attributes'=>$attributeGroup
        ];
        return response()->json($response,200);

    }

}
