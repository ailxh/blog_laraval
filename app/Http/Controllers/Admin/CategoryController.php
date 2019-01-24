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

class CategoryController extends CommonController
{
    //get  admin/category
    public function index()
    {
        $data = (new Category)->tree();
        return view('admin.category.index')->with('data', $data);
    }

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
    //post  admin/category
    public function store()
    {
    }
    //get  admin/category/create
    public function create()
    {

    }
    //get  admin/category/{category}
    public function show()
    {

    }
    //PUT  admin/category/{category}
    public function update()
    {

    }
    //DELETE  admin/category/{category}
    public function destroy()
    {

    }
    //get  admin/category/{category}/edit
    public function edit()
    {

    }
}