<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    //ADMIN
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
        $Object = DB::select("call spc_news('0')");
        $data = json_decode(json_encode($Object),true);
        //
    	return view('/admin/news/index',compact('data'));
    }
    /**
     * Left content
     *
     * @param
     * @return view
     */
    protected function leftContent()
    {
        $Object = DB::select("call spc_news('0')");
        $data = json_decode(json_encode($Object),true);
        //
        $html           = view('/admin/news.leftcontent',compact('data'))->render();
        return response()->json(array('response'=>true,'html'=>$html));
    }
    /**
     * detail news
     *
     * @param
     * @return data
     */
    public function detail()
    {
        try{
            $id = Input::get('id');
            $Object = DB::select("call spc_news('$id')");
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
     * save news
     *
     * @param
     * @return data
     */
    public function save()
    {
        try{
            $id = Input::get('id');
            $name = Input::get('name');
            $des = Input::get('des');
            $content = Input::get('content');
            $image = Input::get('image');
            //
            $Object = DB::select("call spc_news_save('$id','$name','$des','$content','$image')");
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
     * delete news
     *
     * @param
     * @return data
     */
    public function delete()
    {
        $id = Input::get('id');
        //
        $Object = DB::select("call spc_news_delete('$id')");
        $data = json_decode(json_encode($Object),true);
        return array(
            'res' => true,
        );
    }
    //PAGE
    /**
     * Index - page
     *
     * @param
     * @return view
     */
    protected function indexPage()
    {
        $Object = DB::select("call spc_news('0')");
        $data = json_decode(json_encode($Object),true);
        //
        return view('/page/news.index',compact('data'));
    }
    /**
     * Detail - page
     *
     * @param
     * @return view
     */
    protected function detailPage($id)
    {
        $Object = DB::select("call spc_news('$id')");
        $data = json_decode(json_encode($Object),true);
        //
        return view('/page/news.detail',compact('data'));
    }
}
