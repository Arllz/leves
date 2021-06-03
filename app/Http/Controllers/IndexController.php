<?php

namespace App\Http\Controllers;

use App\Models\b2bOrder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    public function index()
    {
       //$ret = app('es')->info();
       //dd($ret);
	    $ret = app('es')->get(['index'=>"people","type"=>"_doc","id"=>1]);
	    dd($ret);
    }
}
