<?php
/**
 * Created by PhpStorm.
 * User: liuxinghao
 * Date: 2019-1-17
 * Time: 11:47
 */


namespace App\Http\Controllers\Admin;


use App\Http\Model\Category;

class CategoryController extends CommonController
{
    //get  admin/category
    public function index()
    {
        $categoty = Category::all();
        return view('admin.category.index');
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