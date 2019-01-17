<?php
/**
 * Created by PhpStorm.
 * User: liuxinghao
 * Date: 2019-1-15
 * Time: 11:31
 */


namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin/index');
    }
    public function info()
    {
//        dd($_SERVER);
        return view('admin/info');
    }
    //更改密码
    public function changepass()
    {
        if ($input = Input::all())
        {
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];

            $message = [
                  'password.required' => '新密码不能为空！',
                  'password.between' => '新密码必须在6-20位！',
                  'password.confirmed' => '新密码与重复密码不一致！'
            ];
            $validator = Validator::make($input, $rules, $message);

            if ($validator->passes())
            {
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if ($_password == $input['password_o'])
                {
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->Update();
                    return redirect('admin/info');
                }
                else
                {
                    return back()->with('errors','原密码错误！');
                }
            }
            else
            {
                return back()->withErrors($validator);
            }
        }
        else
        {
            return view('admin/pass');
        }
    }
}