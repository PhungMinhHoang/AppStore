<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Category;
use App\Http\Requests\StoreProductTypeRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Barryvdh\Debugbar\Facade;
use Illuminate\Validation\Rule;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_type = ProductType::orderBy('idCategory', 'asc')->paginate(5);
        $category = Category::all();
        return view('admin.pages.product_type.list',compact('product_type','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)->get();
        return view('admin.pages.product_type.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTypeRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name,'-');
        if(ProductType::create($data))
        {
            return redirect()->route('product_type.index')->with('thongbao','Thêm thành công');
        }
        else
        {
            return back()->with('thongbao','Có lỗi xảy ra');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {
        dd($productType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $productType)
    {
        $category = Category::where('status',1)->get();
        return response()->json(['product_type'=> $productType, 'category' => $category],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $productType)
    {
        //Facade::info($request);
        $validator = Validator::make($request->all(),
                [
                    'name' => ['required','min:2','max:255',Rule::unique('product_types')->ignore($productType->id)]
                ],
                [
                    'required' => 'Tên loại sản phẩm không được để trống',
                    'min' => 'Tên loại sản phẩm phải từ 2-255 ký tự',
                    'max' => 'Tên loại sản phẩm phải từ 2-255 ký tự',
                    'unique' => 'Loại sản phẩm đã tồn tại',
                ]
            );
        if($validator->fails()){
            return response()->json(['error'=> 'true','message'=>$validator->errors()],200);
        }
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->name,'-');
        $productType->update($data);
        $productType->Category;
        return response()->json(['message'=>'Sửa thành công','data' => $productType],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        return response()->json(['success'=>'Xóa thành công']);
    }
}
