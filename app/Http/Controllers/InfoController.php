<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    /**
     * Index
     *
     * @param
     * @return view
     */
    protected function index()
    {
        if(session()->get('user_id')==null){
            return redirect('/');
        }
        $Object = DB::select("call spc_info()");
        $data = json_decode(json_encode($Object),true);
    	return view('/admin/info.info',compact('data'));
    }
    /**
     * save info
     *
     * @param
     * @return data
     */
    public function save()
    {
        $logo = Input::get('logo');
        $name = Input::get('name');
        $address1 = Input::get('address1');
        $address2 = Input::get('address2');
        $tel1 = Input::get('tel1');
        $tel2 = Input::get('tel2');
        $mail = Input::get('mail');
        //
        $Object = DB::select("call spc_info_save('$logo','$name','$address1','$address2','$tel1','$tel2','$mail')");
        $data = json_decode(json_encode($Object),true);
        return array('res' => true, );
    }
}
