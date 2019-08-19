<div class="agile-main-top">
    <div class="container-fluid">
        <div class="row main-top-w3l py-2">
            <div class="col-lg-4 header-most-top">
                <p class="text-white text-lg-left text-center">Offer Zone Top Deals & Discounts
                    <i class="fas fa-shopping-cart ml-1"></i>
                </p>
            </div>
            <div class="col-lg-8 header-right mt-lg-0 mt-2">
                <!-- header lists -->
                <ul>
                    <li class="text-center border-right text-white">
                        <a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
                            <i class="fas fa-map-marker mr-2"></i>Select Location</a>
                    </li>
                    <li class="text-center border-right text-white">
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
                            <i class="fas fa-truck mr-2"></i>Track Order</a>
                    </li>
                    <li class="text-center border-right text-white">
                        <i class="fas fa-phone mr-2"></i> 001 234 5678
                    </li>
                    @if (Auth::check())
                        <li class="text-center border-right text-white">
                            <img src="{{Auth::user()->avatar}}" alt="" width="20" height="20"> 
                            {{Auth::user()->name}}
                        </li>
                        
                        @if (Auth::user()->password =='')
                            <div class="modal fade updatePass" id="updatePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center">Cập nhật mật khẩu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="updatepass" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="col-form-label">Mật khẩu</label>
                                                    <input type="text" class="form-control" placeholder="Nhập mật khẩu mới" name="password">
                                                </div>
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger">
                                                        {{$errors->first('password')}}
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label class="col-form-label">Nhập lại mật khẩu</label>
                                                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="re_password">
                                                </div>
                                                @if ($errors->has('re_password'))
                                                <div class="alert alert-danger">
                                                    {{$errors->first('re_password')}}
                                                </div>
                                                @endif
                                                <div class="right-w3l">
                                                    <input type="submit" class="form-control" value="Cập nhật">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                        <li class="text-center border-right text-white">
                            <a href="#" data-toggle="modal" data-target="#updatePasswordModal" class="text-white">
                                <i class="fas fa-edit mr-2"></i> Đổi mật khẩu</a>
                        </li>
                        @endif
                        <li class="text-center border-right text-white">
                            <a href="logout" class="text-white">
                                <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất </a>
                        </li>
                    @else
                        <li class="text-center border-right text-white">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
                                <i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
                        </li>
                        <li class="text-center text-white">
                            <a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">
                                <i class="fas fa-user-plus mr-2"></i>Đăng ký</a>
                        </li>
                    @endif
                </ul>
                <!-- //header lists -->
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal(select-location) -->
<div id="small-dialog1" class="mfp-hide">
    <div class="select-city">
        <h3>
            <i class="fas fa-map-marker"></i> Please Select Your Location</h3>
        <select class="list_of_cities">
            <optgroup label="Popular Cities">
                <option selected style="display:none;color:#eee;">Select City</option>
                <option>Birmingham</option>
                <option>Anchorage</option>
                <option>Phoenix</option>
                <option>Little Rock</option>
                <option>Los Angeles</option>
                <option>Denver</option>
                <option>Bridgeport</option>
                <option>Wilmington</option>
                <option>Jacksonville</option>
                <option>Atlanta</option>
                <option>Honolulu</option>
                <option>Boise</option>
                <option>Chicago</option>
                <option>Indianapolis</option>
            </optgroup>
        </select>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //shop locator (popup) -->

<!-- modals -->
<!-- log in -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="login" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Địa chỉ email</label>
                        <input type="text" class="form-control" placeholder="Nhập địa chỉ email" name="email" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password" required="">
                    </div>
                    <div class="sub-w3l">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember">
                                <label class="custom-control-label" for="customControlAutosizing">Nhớ mật khẩu</label>
                            </div>
                        </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="Đăng nhập">
                    </div>
                    <div class="right-w3l">
                        <a href="login/facebook" class="btn btn-primary">Đăng nhập bằng facebook</a>
                    </div>
                    
                    <p class="text-center dont-do mt-3">Nếu bạn chưa có tài khoản
                        <a href="#" data-toggle="modal" data-target="#exampleModal2">
                            Đăng ký ngay</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- register -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng ký</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="register" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Họ và tên</label>
                        <input type="text" class="form-control name" placeholder="Nhập họ và tên" name="name" >
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Địa chỉ Email</label>
                        <input type="email" class="form-control" placeholder="Nhập địa chỉ email" name="email" >
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password" id="password" >
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">
                                {{$errors->first('password')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" placeholder=" " name="re_password" id="passwordAgain" >
                        @if ($errors->has('re_password'))
                            <div class="alert alert-danger">
                                {{$errors->first('re_password')}}
                            </div>
                        @endif
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="Đăng ký">
                    </div>
                    <div class="sub-w3l">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input dieukhoan" id="customControlAutosizing2">
                            <label class="custom-control-label" for="customControlAutosizing2">Đồng ý với <a href="">điều khoản</a> của chúng tôi </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- //modal -->