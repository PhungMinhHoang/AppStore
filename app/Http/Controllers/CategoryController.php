<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Str;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::paginate(5);
        return view('admin.pages.category.list',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'status'=> $request->status,
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        dd($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response()->json($category,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if($request->name == $category->name){
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|min:2|max:255'
                ],
                [
                    'required' => 'Tên danh mục sản phẩm không được để trống',
                    'min' => 'Tên danh mục sản phẩm phải từ 2-255 ký tự',
                    'max' => 'Tên danh mục sản phẩm phải từ 2-255 ký tự',
                ]
            );
        }
        else{
            $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:2|max:255|unique:categories'
            ],
            [
                'required' => 'Tên danh mục sản phẩm không được để trống',
                'min' => 'Tên danh mục sản phẩm phải từ 2-255 ký tự',
                'max' => 'Tên danh mục sản phẩm phải từ 2-255 ký tự',
                'unique' => 'Tên category đã tồn tại',
            ]
        );
        }
        if($validator->fails()){
            return response()->json(['error'=> 'true','message'=>$validator->errors()],200);
        }
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'status'=> $request->status,
        ]);
        return response()->json(['success'=>'Sửa thành công','data' =>$category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message'=>'Xóa thành công']);

    }
}
