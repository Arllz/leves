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
        $orders = b2bOrder::where('id','<',10)->get();
        dd($orders);
    }
}
