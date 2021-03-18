<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use \app\Http\Controllers\Controller as common;

class ProductController extends Controller
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
        $data       = common::CallRaw('spc_product',[0])[0];
        $category   = common::CallRaw('spc_category',[0]);
        //
        return view('/admin/product.index',compact('data','category'));
    }
    /**
     * Left content - admin
     *
     * @param
     * @return view
     */
    protected function leftContent()
    {
        $data = common::CallRaw('spc_product',[0])[0];
        //
        $html       = view('/admin/product.leftcontent',compact('data'))->render();
        return response()->json(array('response'=>true,'html'=>$html));
    }
    /**
     * detail product - admin
     *
     * @param
     * @return data
     */
    public function detail()
    {
        try{
            $id = Input::get('id');
            $data = common::CallRaw('spc_product',[$id]);
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
     * save product - admin
     *
     * @param
     * @return data
     */
    public function save()
    {
        try{
            $id = Input::get('id');
            $category = Input::get('category');
            $name = Input::get('name');
            $price = Input::get('price');
            $image = Input::get('image');
            $content = Input::get('content');
            //
            $data       = common::CallRaw('spc_product_save',[$id,$category,$name,$price,$image,$content]);
            return array(
                'res' => true,
                'id' => $data[0]['id']
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
    /**
     * delete product - admin
     *
     * @param
     * @return data
     */
    public function delete()
    {
        $id = Input::get('id');
        $data       = common::CallRaw('spc_product_delete',[$id]);
        return array(
            'res' => true,
        );
    }
    //Page
    /**
     * Page product
     *
     * @param
     * @return view
     */
    protected function indexPage()
    {
        $category   = common::CallRaw('spc_category',[0]);
        //
        $name      = Input::get('name');
        $name      = $name==NULL?'':$name;
        $data       = common::CallRaw('spc_product_category',[0,$name]);
        //
        return view('/page/product.index',compact('category','data'));
    }
    /**
     * Page product by category
     *
     * @param
     * @return view
     */
    protected function indexCategory($ctg_id)
    {
        $category   = common::CallRaw('spc_category',[0]);
        $data       = common::CallRaw('spc_product_category',[$ctg_id,'']);
        //
        return view('/page/product.index',compact('category','data'));
    }
    /**
     * Detail - page
     *
     * @param
     * @return view
     */
    protected function detailPage($id)
    {
        $data = common::CallRaw('spc_product',[$id]);
        //
        return view('/page/product.detail',compact('data'));
    }
    //Admin
    /**
     * Index - admin
     *
     * @param
     * @return view
     */
    protected function indexOrder()
    {
        if(session()->get('user_id')==null){
            return redirect('/');
        }
        //
        $data       = common::CallRaw('spc_product_order',[0]);
        //
        return view('/admin/product.indexOrder',compact('data','category'));
    }
    /**
     * save order product
     *
     * @param
     * @return data
     */
    public function saveOrder()
    {
        try{
            $product_id = Input::get('product_id');
            $name       = Input::get('name');
            $tel        = Input::get('tel');
            $mail       = Input::get('mail');
            $address    = Input::get('address');
            $number     = Input::get('number');
            //
            $data       = common::CallRaw('spc_product_order',[$product_id,$name,$tel,$mail,$address,$number]);
            return array(
                'res' => true,
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
}
