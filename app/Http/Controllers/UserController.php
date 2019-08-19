<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function redirectProvider($social)
    {
        return Socialite::driver($social)->redirect();
    
    }

    public function handleProviderCallback($social)
    {
        $user = Socialite::driver($social)->user();
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser);
        return redirect("/");
    }
    private function findOrCreateUser($user)   
    {
        $authUser = User::where('social_id',$user->id)->first();
        if($authUser){
            return $authUser;
        }
        else{
            return User::Create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => '',
                'ruler' => 0,
                'status' => 0,
                'avatar' => $user->avatar,
                'social_id' => $user->id,
            ]);
        }
    }

    public function logout()
    {
        if(Auth::check()){
            Auth::logout();
            return redirect("/");
        }
    }

    public function updatePassClient(Request $request)
    {    
        $this->validate($request,
            [
                'password' => 'required|min:6|max:255',
                're_password' => 'required|same:password',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute phải từ 6-255 ký tự',
                'max' => ':attribute phải từ 6-255 ký tự',
                'same' => ':attribute không khớp',
            ],
            [
                'password' => 'Mật khẩu',
                're_password' => 'Mật khẩu nhập lại',
            ]
        );
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('thongbao','Đã cập nhật thành công mật khẩu');
    }

    public function loginClient(Request $request) 
    {
        $data = $request->only('email','password');
        if (Auth::attempt($data,$request->has('remember'))) {
            return back()->with('thongbao','Đăng nhập thành công');
        } else {
            return back()->with('error','Đăng nhập thất bại. Xin vui lòng kiểm tra lại tài khoản');
        }
        
    }

    public function registerClient(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:6|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:255',
                're_password' => 'required|same:password',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute phải từ 6-255 ký tự',
                'max' => ':attribute phải từ 6-255 ký tự',
                'same' => ':attribute không khớp',
                'unique' => ':attribute đã tồn tại',
                'email' => ':attribute đã nhập không đúng định dạng'
            ],
            [
                'name' => 'Họ tên',
                'email' => 'Địa chỉ email',
                'password' => 'Mật khẩu',
                're_password' => 'Mật khẩu nhập lại',
            ]
        );

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        Auth::login($user);
        return back()->with('thongbao','Đăng ký thành công');
    }
}
