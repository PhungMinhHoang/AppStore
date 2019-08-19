@extends('admin.layouts.master')

@section('title')
    Thêm mới loại sản phẩm
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
    </div>
    <div class="row" style="margin:5px">
        <div class="col-lg-12">
            <form role="form" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input class="form-control" placeholder="Nhập tên sản phẩm" name="name">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" class="form-control" placeholder="Nhập số lượng" name="quantity">
                    @if ($errors->has('quantity'))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('quantity')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Đơn giá</label>
                    <input type="text" class="form-control" placeholder="Nhập đơn giá" name="price">
                    @if ($errors->has('price'))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('price')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Giá khuyển mại</label>
                    <input type="text" class="form-control" placeholder="Nhập giá khuyến mại nếu có" name="promotional" value='0'>
                    @if ($errors->has('promotional'))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('promotional')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Ảnh minh họa</label>
                    <input type="file" class="form-control" name="image">
                    @if ($errors->has('image'))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('image')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <textarea id="demo" class="form-control" placeholder="Nhập mô tả" name="description" cols="5" rows="5"></textarea>
                    @if ($errors->has('description'))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('description')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control category" name="idCategory">
                        @foreach ($category as $cate)
                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                        <label>Loại sản phẩm</label>
                        <select class="form-control product-type" name="idProductType">
                            @foreach ($productType as $pt)
                                @if ($pt->idCategory == $category[0]->id)
                                <option value="{{$pt->id}}" >{{$pt->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="1">Hiển thị</option>
                        <option value="0">Không hiển thị</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Thêm</button>
                <button type="reset" class="btn btn-primary">Nhập lại</button>  

            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
    
    <script>
        $('.category').change(function(){
            let idCategory = $(this).val();
            $.ajax({
                url: 'getProductType',
                data:{
                    idCategory: idCategory
                },
                dataType: 'json',
                type: 'get',
            })
            .done(function(result){
                let html = ''
                $.each(result,function(key,value){
                    html += `<option value = ${value['id']}>${value['name']}</option>`
                })
                $('.product-type').html(html)
            })
        })
    </script>
@endsection