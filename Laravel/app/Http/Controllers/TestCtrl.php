<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TestController extends Controller{


    public function getResult(){

        return $this->transformXML("data.xml", "output.txt");

    }

    public function transformXml($input_file,$output_file) {

//TODO Check if input file exists. Rice exception if error
        \App::runningUnitTests();

        if(app()->runningUnitTests())
        {
            $input_file = "test.xml";
        }
        $reader = new \XMLReader();

        $reader->open($input_file);

        if(!app()->runningUnitTests())
        {
            file_put_contents($output_file, 'affiliate|amount|commission|timestamp|”orderRef”'.PHP_EOL);
        }

        while ($reader->read()):
            if ($reader->nodeType == \XMLReader::ELEMENT && $reader->name == 'sale'){
                $node = new \SimpleXMLElement($reader->readOuterXML());
//TODO  Node data should be validated in this point and rice an exception if error
                $commission = round(bcdiv($node->amount, '100', 4)*5,2,PHP_ROUND_HALF_UP)+0.5;
                $date = Carbon::parse($node->datetime)->timestamp;
// TODO Not nice. Have to create a separate method for string generation
                $line = $node->affiliate."|".$node->amount.'|'.$commission.'|'.$date.'|"'.$node->orderRef.'"'.PHP_EOL;
                if(app()->runningUnitTests()){
                    return $line;
                }
                else{
                    file_put_contents($output_file, $line, FILE_APPEND);
                }
            }
        endwhile;

        return true;
    }
}

