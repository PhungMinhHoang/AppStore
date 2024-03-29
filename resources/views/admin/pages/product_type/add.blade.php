@extends('admin.layouts.master')

@section('title')
    Thêm mới loại sản phẩm
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Loại sản phẩm</h6>
    </div>
    <div class="row" style="margin:5px">
        <div class="col-lg-12">
            <form role="form" action="{{route('product_type.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" placeholder="Nhập loại sản phẩm" name="name">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="idCategory">
                            @foreach ($category as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
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