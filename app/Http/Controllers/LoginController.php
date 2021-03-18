<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
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
            return view('/admin/login.login');
        }
        return redirect('/admin/info');
    }
    /**
     * Login
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function login()
    {
    	try{
    		$user = Input::get('user');
	        $pass = Input::get('pass');
	        $Object = DB::select("call spc_login('$user','$pass')");
	        $select = json_decode(json_encode($Object),true);
	        if( isset($select[0]) && isset($select[0]['user_id']) ){
	        	session()->put('user_id', $select[0]['user_id']);
	        	session()->put('user_name', $select[0]['user_name']);
	        	return array('response' => true,);
	        }
	        session()->put('user_id', null);
        	session()->put('user_name', null);
	        return array('response' => false,);
    	}catch(\Exception $e){
    		return array('response' => false,);
    	}
    }
    /**
    * logout
    *
    * @param
    * @return view
    */
    protected function logout()
    {
        session()->forget('user_id');
        session()->forget('user_name');
        return redirect('/');
    }
}
