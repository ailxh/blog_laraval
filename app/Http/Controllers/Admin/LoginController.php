<?php
/**
 * Created by PhpStorm.
 * User: liuxinghao
 * Date: 2019-1-14
 * Time: 15:38
 */


namespace App\Http\Controllers\Admin;

require_once 'resources/org/code/Code.class.php';

//use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class LoginController extends CommonController
{
    //登录
    public function login()
    {
        if ($input = Input::all())
        {
            $codeModel = new \Code();
            $code = $codeModel->get();
            if (strtolower($code) != strtolower($input['code']))
            {
                return back()->with('msg','验证码错误');
            }
            $userModel = new \App\Http\Model\user();
            $user_data = $userModel::first();

            if ($user_data->user_name != $input['user_name'] || Crypt::decrypt($user_data->user_pass) != $input['user_pass'])
            {
                return back()->with('msg','用户名或密码不对');
            }
            session(['user'=>$user_data]);
            return redirect('admin/index');
        }
        else
        {
            return view('admin/login');
        }
    }

    //验证码
    public function code()
    {
        $code = new \Code();
        $code->make();
    }

    //退出
    public function outLogin()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
}