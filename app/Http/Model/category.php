<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;

    public function tree()
    {
        $data = $this->orderBy('cate_order', 'asc')->get();
        return $this->getTree($data,'cate_name','cate_id','cate_pid');
    }

    public function getTree($data, $field_name, $field_id = 'id', $field_pid = 'pid', $pid = 0)
    {
        $arr = [];
        foreach ($data as $k=>$v)
        {
            if ($v->$field_pid == $pid)
            {
                $v['_'.$field_name] = $v[$field_name];
                $arr[] = $v;
                foreach ($data as $ks=>$vs)
                {
                    if ($vs->$field_pid == $v->$field_id)
                    {
                        $vs['_'.$field_name] = '　'.$vs[$field_name];
                        $arr[] = $vs;
                    }
                }
            }
        }
        return $arr;
    }
}
