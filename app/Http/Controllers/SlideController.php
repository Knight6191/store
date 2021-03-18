<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class SlideController extends Controller
{
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
        $Object = DB::select("call spc_slide('0')");
        $data = json_decode(json_encode($Object),true);
        //
    	return view('/admin/slide.index',compact('data'));
    }
    /**
     * Left content
     *
     * @param
     * @return view
     */
    protected function leftContent()
    {
        $Object = DB::select("call spc_slide('0')");
        $data = json_decode(json_encode($Object),true);
        //
        $html = view('/admin/slide.leftcontent',compact('data'))->render();
        return response()->json(array('response'=>true,'html'=>$html));
    }
    /**
     * detail slide
     *
     * @param
     * @return data
     */
    public function detail()
    {
        try{
            $id = Input::get('id');
            $Object = DB::select("call spc_slide('$id')");
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
     * save slide
     *
     * @param
     * @return data
     */
    public function save()
    {
        try{
            $id = Input::get('id');
            $name = Input::get('name');
            $link = Input::get('link');
            $content = Input::get('content');
            $image = Input::get('image');
            //
            $Object = DB::select("call spc_slide_save('$id','$name','$link','$content','$image')");
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
     * delete slide
     *
     * @param
     * @return data
     */
    public function delete()
    {
        $id = Input::get('id');
        //
        $Object = DB::select("call spc_slide_delete('$id')");
        $data = json_decode(json_encode($Object),true);
        return array(
            'res' => true,
        );
    }
}
