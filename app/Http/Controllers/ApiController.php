<?php

namespace App\Http\Controllers;

use App\Models\CP;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCP($cp)
    {
        $resp = 0; 
        $codigo=CP::where("codigo","=",$cp)->first();   
        if($codigo){
            $resp =json_encode($codigo);
        }
        return $resp;
    }

}
