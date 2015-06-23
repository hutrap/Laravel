<?php

namespace App\Http\Controllers;
use App\Model\Test;
use App\Http\Controllers\Controller;

class TestController extends Controller{

    public function getXML(){
        $test_model = new Test();
        return $test_model->getXML();;
    }


    public function getJson(){
         $test_model = new Test();
         $data =  $test_model->getTransformedData();
         return \Response::json($data);
    }
}
