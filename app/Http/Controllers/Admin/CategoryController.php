<?php
/**
 * Created by PhpStorm.
 * User: liuxinghao
 * Date: 2019-1-17
 * Time: 11:47
 */


namespace App\Http\Controllers\Admin;


use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //get  admin/category   分类列表
    public function index()
    {
        $data = (new Category)->tree();
        return view('admin.category.index')->with('data', $data);
    }

    /*
     * 修改分类排序
     */
    public function changeOrder()
    {
        $input = Input::all();
        if (!$input)
        {
            $return_data['status'] = -1;
            $return_data['msg'] = '传输参数缺失！';
            return $return_data;
        }
        $cate = (new Category)->find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        if ($re)
        {
            $return_data['status'] = 1;
            $return_data['msg'] = '修改成功！';
            return $return_data;
        }
        else
        {
            $return_data['status'] = -1;
            $return_data['msg'] = '修改失败！';
            return $return_data;
        }
    }

    //get  admin/category/create  添加分类
    public function create()
    {
        $where_sql['cate_pid'] = 0;
        $data = (new Category)->where($where_sql)->orderBy('cate_id','desc')->get();
        return view('admin/category/add',compact('data'));
    }

    //post  admin/category
    public function store()
    {
        if ($input = Input::except('_token'))
        {
            $rules = [
                'cate_name'=>'required',
            ];

            $message = [
                'cate_name.required' => '分类名称不能为空！',
            ];
            $validator = Validator::make($input, $rules, $message);

            if ($validator->passes())
            {
                $str = Category::create($input);
                if ($str)
                {
                    return redirect('admin/category');
                }
                else
                {
                    return back()->with('errors','创建错误！');
                }
            }
            else
            {
                return back()->withErrors($validator);
            }
        }
        else
        {
            return view('admin/category/create');
        }
    }

    //get  admin/category/{category}/edit
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $where_sql['cate_pid'] = 0;
        $data = (new Category)->where($where_sql)->orderBy('cate_id','desc')->get();
        return view('admin.category.edit',compact('field','data'));
    }
    //PUT  admin/category/{category}
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        $str = Category::where('cate_id',$cate_id)->update($input);
        if ($str)
        {
            return redirect('admin/category');
        }
        else
        {
            return back()->with('errors','修改失败！');
        }
    }
    //get  admin/category/{category}
    public function show()
    {

    }
    //DELETE  admin/category/{category}
    public function destroy($cate_id)
    {
        $str = Category::where('cate_id',$cate_id)->delete();
        if ($str)
        {
            Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
            $data = [
                'status' => 1,
                'msg' => '删除成功'
            ];
        }
        else
        {
            $data = [
                'status' => -1,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }
}