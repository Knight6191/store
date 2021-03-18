<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ReferController extends Controller
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
        $Object = DB::select("call spc_refer('0')");
        $data = json_decode(json_encode($Object),true);
        //
        return view('/admin/refer.index',compact('data'));
    }
    /**
     * Left content - admin
     *
     * @param
     * @return view
     */
    protected function leftContent()
    {
        $Object     = DB::select("call spc_refer('0')");
        $data       = json_decode(json_encode($Object),true);
        //
        $html       = view('/admin/refer.leftcontent',compact('data'))->render();
        return response()->json(array('response'=>true,'html'=>$html));
    }
    /**
     * detail refer - admin
     *
     * @param
     * @return data
     */
    public function detail()
    {
        try{
            $id = Input::get('id');
            $Object = DB::select("call spc_refer('$id')");
            $data = json_decode(json_encode($Object),true);
            //
            return array(
                'res' => true,
                'data' => $data[0]
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
    /**
     * save refer - admin
     *
     * @param
     * @return data
     */
    public function save()
    {
        try{
            $id = Input::get('id');
            $name = Input::get('name');
            $link = Input::get('link');;
            //
            $Object = DB::select("call spc_refer_save('$id','$name','$link')");
            $data = json_decode(json_encode($Object),true);
            return array(
                'res' => true,
                'id' => $data[0]['id']
            );
        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }
    /**
     * delete refer - admin
     *
     * @param
     * @return data
     */
    public function delete()
    {
        $id = Input::get('id');
        //
        $Object = DB::select("call spc_refer_delete('$id')");
        $data = json_decode(json_encode($Object),true);
        return array(
            'res' => true,
        );
    }
    //Page
    /**
     * Detail - page
     *
     * @param
     * @return view
     */
    protected function detailPage($id)
    {
        $Object = DB::select("call spc_refer('$id')");
        $data = json_decode(json_encode($Object),true);
        //
        $link = $data[0]['link'];
        $contains = str_contains($link, 'http');
        if(!$contains){
            $link = 'http://' . $link;
        }
        return redirect($link);
    }
}
