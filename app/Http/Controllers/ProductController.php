<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use Barryvdh\Debugbar\Facade;
use File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(5);
        return view('admin.pages.product.list',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status',1)->get();
        $productType  = ProductType::where('status',1)->get();
        return view('admin.pages.product.add',compact('category','productType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {   
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file -> getClientOriginalName();
            $fileType = $file -> getMimeType();
            $fileSize = $file -> getSize();
            if($fileType == 'image/png' || $fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/gif'){
                if($fileSize <= 1048576){
                    $fileName = idate("U")."-".Str::slug($fileName); 
                    $file->move('img/upload/product',$fileName);
                    $data = $request->all();
                    $data['slug'] = Str::slug($request->name);
                    $data['image'] = $fileName;
                    Product::create($data);
                    return redirect()->route('product.index')->with('thongbao',"Thêm thành công");
                }
                else {
                    return back()->with('error','Bạn không thể upload ảnh quá 1MB');
                }
            }
            else {
                return back()->with('error','File bạn chọn không phải là hình ảnh');
            }
        }
        else 
        {
            return back()->with('error','Bạn chưa thêm ảnh minh họa cho sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = Category::where('status',1)->get();
        $productType  = ProductType::where('status',1)->get();
        return response()->json(['category'=>$category,'productType'=>$productType,'product'=>$product],200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|min:2|max:255',
                'description' => 'required|min:2',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
                'promotional' => 'nullable|numeric',
                'image' => 'image',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute phải từ 2-255 ký tự',
                'max' => ':attribute phải từ 2-255 ký tự',
                'integer' => ':attribute phải là số nguyên',
                'numeric' => ':attribute phải là số thực',
                'image' => ':attribute phải là hình ảnh',
            ],
            [
                'name' => 'Tên sản phẩm',
                'description' => 'Mô tả sản phẩm',
                'quantity' => 'Số lượng sản phẩm',
                'price' => 'Đơn giá sản phẩm',
                'promotional' => 'Giá khuyến mại',
                'image' => 'Ảnh minh họa',
            ]
        );
        if($validator->fails()){
            return response()->json(['error' => 'true','message' => $validator->errors()],200);
        }
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = $file -> getClientOriginalName();
            $fileType = $file -> getMimeType();
            $fileSize = $file -> getSize();
            if($fileType == 'image/png' || $fileType == 'image/jpg' || $fileType == 'image/jpeg' || $fileType == 'image/gif'){
                if($fileSize <= 1048576){
                    $fileName = idate("U")."-".Str::slug($fileName); 
                    $file->move('img/upload/product',$fileName);
                    $data['image'] = $fileName;
                    if(File::exists('img/upload/product/'.$product->image)){
                        unlink('img/upload/product/'.$product->image);
                    }
                }
                else {
                    return back()->with('error','Bạn không thể upload ảnh quá 1MB');
                }
            }
            else {
                return back()->with('error','File bạn chọn không phải là hình ảnh');
            }
        }
        else{
            $data['image'] = $product->image;

        }
        $product->update($data);
        return response()->json(['result'=>'Đã sửa thành công'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(File::exists('img/upload/product/'.$product->image)){
            unlink('img/upload/product/'.$product->image);
        }
        $product->delete();
        return response()->json(['success'=>'Xóa thành công'],200);
    }
}
