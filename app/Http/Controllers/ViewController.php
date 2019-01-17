<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ViewController extends Controller
{
    //
    public function index()
    {
        $data = [
            'name'=>'刘兴浩',
            'age'=>12
        ];
        $title = 'title';
        return view('my/my_laravel',compact('data','title'));
    }
    //
    public function layouts()
    {
        $data = [
            'name'=>'刘兴浩',
            'age'=>12
        ];
        $title = 'title';
        return view('my/my_laravel',compact('data','title'));
    }
}
