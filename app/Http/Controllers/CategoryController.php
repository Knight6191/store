<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use \app\Http\Controllers\Controller as common;

class CategoryController extends Controller
{
    //Admin
    /**
     * Index - admin
     *
     * @param
     * @return view
     */
    protected function index()
    {
        if(session()->get('user_id')==null){
            return redirect('/');
        }
        //
       $data = common::CallRaw('spc_category',[0]);
        //
        return view('/admin/category.index',compact('data'));
    }
    /**
     * Left content - admin
     *
     * @param
     * @return view
     */
    protected function leftContent()
    {
        $data = common::CallRaw('spc_category',[0]);
        //
        $html       = view('/admin/category.leftcontent',compact('data'))->render();
        return response()->json(array('response'=>true,'html'=>$html));
    }
    /**
     * detail category - admin
     *
     * @param
     * @return data
     */
    public function detail()
    {
        try{
            $id = Input::get('id');
            $data = common::CallRaw('spc_category',[$id]);
            //
            return array(
                'res' => true,
                'data' => $data
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
    /**
     * save category - admin
     *
     * @param
     * @return data
     */
    public function save()
    {
        try{
            $id = Input::get('id');
            $home = Input::get('check');
            $name = Input::get('name');
            $image = Input::get('image');
            $content = Input::get('content');
            //
            $data = common::CallRaw('spc_category_save',[$id,$home,$name,$image,$content]);
            return array(
                'res' => true,
                'id' => $data[0]['ctg_id']
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
    /**
     * delete category - admin
     *
     * @param
     * @return data
     */
    public function delete()
    {
        $id = Input::get('id');
        $data = common::CallRaw('spc_category_delete',[$id]);
        return array(
            'res' => true,
        );
    }
}
