@extends('admin.layouts.master')

@section('title')
    Danh sách loại sản phẩm
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Loại sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Thông tin</th>
                            <th>Loại sản phẩm</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Thông tin</th>
                            <th>Loại sản phẩm</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($product as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class="td-name">{{$value->name}}</td>
                                <td class="td-slug">{{$value->slug}}</td>
                                <td class="td-description">{!!$value->description!!}</td>
                                <td class="td-thongtin">
                                    <b>Số lượng:</b> {{$value->quantity}}
                                    <br>
                                    <b>Đơn giá: </b> {{$value->price}}
                                    <br>
                                    <b>Khuyến mãi:</b> {{$value->promotional}}
                                    <br>
                                    <b>Hình minh họa</b>
                                    <div></div><img src="img/upload/product/{{$value->image}}" width="100" height="100"></div>
                                </td>
                                <td class="td-category" data-productType={{$value->productType->id}}>{{$value->productType->name}}</td>
                                <td class="td-category" data-category={{$value->Category->id}}>{{$value->Category->name}}</td>
                                <td class="td-status" data-status={{$value->status}}>
                                    @if ($value->status == 1)
                                        {{'Hiển thị'}}
                                    @else
                                        {{'Không hiển thị'}}
                                    @endif    
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary edit" title="{{"Sửa ".$value->name}}" data-toggle="modal" data-target="#edit" data-id={{$value->id}}>
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger delete" title="{{"Xóa ".$value->name}}" data-toggle="modal" data-target="#delete" data-id={{$value->id}}>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                <!-- Pagination -->
                    <div class="pull-right">
                        {{$product->links()}}
                    </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
    
    <!-- Edit Modal-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa sản phẩm: <span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin:5px">
                        <div class="col-lg-12">
                            <form role="form" id="updateProduct" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input class="form-control name" placeholder="Nhập tên sản phẩm" name="name">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="number" class="form-control quantity" placeholder="Nhập số lượng" name="quantity">
                                    @if ($errors->has('quantity'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('quantity')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Đơn giá</label>
                                    <input type="text" class="form-control price" placeholder="Nhập đơn giá" name="price">
                                    @if ($errors->has('price'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('price')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Giá khuyển mại</label>
                                    <input type="text" class="form-control promotional" placeholder="Nhập giá khuyến mại nếu có" name="promotional" value='0'>
                                    @if ($errors->has('promotional'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('promotional')}}
                                        </div>
                                    @endif
                                </div>
                                <img class="img img-thumbnail imageThum" width="100" height="100" lign="center">
                                <div class="form-group">
                                    <label>Ảnh minh họa</label>
                                    <input type="file" class="form-control image" name="image">
                                    @if ($errors->has('image'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('image')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Mô tả sản phẩm</label>
                                    <textarea id="demo" class="form-control description" placeholder="Nhập mô tả" name="description" cols="5" rows="5" ></textarea>
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control category" name="idCategory">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Loại sản phẩm</label>
                                    <select class="form-control product-type" name="idProductType">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control status" name="status">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Không hiển thị</option>
                                    </select>
                                </div>
                
                                <input type="submit" class="btn btn-success update" value="Save">
                                <button type="reset" class="btn btn-primary">Reset</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- delete Modal-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 183px;">
                    <button type="button" class="btn btn-success del">Có</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
                <div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="assets/admin/js/ajaxProduct.js"></script>
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