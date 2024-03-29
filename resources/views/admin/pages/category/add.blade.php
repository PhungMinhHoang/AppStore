@extends('admin.layouts.master')

@section('title')
    Thêm mới danh mục sản phẩm
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Category</h6>
    </div>
    <div class="row" style="margin:5px">
        <div class="col-lg-12">
            <form role="form" action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" placeholder="Nhập category" name="name">
                </div>
                <span class="error" style="color:red;font-size:1rem"></span>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="1">Hiển thị</option>
                        <option value="0">Không hiển thị</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Add</button>
                <button type="reset" class="btn btn-primary">Reset</button>  

            </form>

        </div>
    </div>
</div>
@endsection