<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use \app\Http\Controllers\Controller as common;

class HomeController extends Controller
{
    /**
     * Index
     *
     * @param
     * @return view
     */
    protected function index()
    {
        //slide
        $slide = common::CallRaw('spc_slide',[0]);
        //news
        $news = common::CallRaw('spc_news',[-1]);
        //product
        $data = common::CallRaw('spc_product',[0])[0];
        //category
        $category = common::CallRaw('spc_category',[0]);
        //return view
        return view('/page/home.home',compact('slide','news','data','category'));
    }
}
