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
                                <th>Category</th>
                                <th>Status</th>
                                <th>Chỉnh sửa</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($product_type as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class="td-name">{{$value->name}}</td>
                                <td class="td-slug">{{$value->slug}}</td>
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
                        {{$product_type->links()}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa Loại sản phẩm: <span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin:5px">
                        <div class="col-lg-12">
                            <form role="form">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control name" placeholder="Nhập loại sản phẩm" name="name">
                                    <span class="error" style="color:red;font-size:1rem"></span>
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
                                    <label>Status</label>
                                    <select class="form-control status" name="status">
                                        <option value="1" class="ht">Hiển thị</option>
                                        <option value="0" class="kht">Không hiển thị</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success update">Save</button>
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
    <script src="assets/admin/js/ajaxProductType.js"></script>
@endsection