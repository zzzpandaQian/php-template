<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Jiannei\Response\Laravel\Support\Facades\Response;

class TestController extends ApiController
{
    /**
     * 用户列表
     *
     * @return void
     */
    public function index(Request $request)
    {
        $var_name = 'wei,chen,chen';
        $first_name = '';
        $last_name = '';
        if (strpos($var_name, ',') !== false) {
            $explode_name = explode(',', $var_name);
            for($i = 0; $i < count($explode_name); $i++){
                if($i == 0){
                    $last_name = $explode_name[$i];
                }else{
                    $first_name = $first_name.$explode_name[$i];
                }
            }
        }else{
            $first_name = $var_name;
        }
        return 'Frist Name:'.$first_name.'  Last Name:'.$last_name;
    }
}
