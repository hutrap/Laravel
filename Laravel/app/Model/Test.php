<?php

namespace App\Model;

class Test
{

    private $transformed_data = array();

    public function __construct(array $data=null){
        if(!$data){
            $this->transformData($this->test_data);
        }
        else{
            $this->transformData($data);
        }
    }

    public function getTransformedData()
    {
        return $this->transformed_data;
    }
    

    public function getXML(){

        $dom = new \DOMDocument();
        $children = $this->generate_xml_element( $dom, $this->transformed_data);
        if ( count($children) > 0 ){
            foreach($children as $child){
                $dom->appendChild( $child );
            }
        }
        $dom->formatOutput = true;
        $xml = $dom->saveXML();
        Header('Content-type: text/xml');
        print($xml);

    }

    private function generate_xml_element( $dom, $data ) {
        $elements = array();
        foreach($data as $data1) {
            foreach($data1 as $key => $data2) {
                if(isset($data2['data']) && !is_array($data2['data'])){
                    $element = $dom->createElement($key, $data2['data']);
                }
                else{
                    $element = $dom->createElement($key);
                }
                if(isset($data2['attr']) && count($data2['attr']>0)){
                    foreach($data2['attr'] as $key => $val){
                        $element->setAttribute( $key, $val );
                    }
                    if (is_array($data2['data'])) {
                        $children = $this->generate_xml_element($dom, $data2['data']);
                        if ( count($children) > 0 ){
                            foreach($children as $child){
                                $element->appendChild( $child );
                            }
                        }
                    }
                }
                $elements[] = $element;
            }
        }
        return $elements;
    }

    private function transformData($source)
    {
        $tmp = array();
        if(count($this->transformed_data) == 0)
        {
            $this->transformed_data[0][$source['name']]['attr'] = $source['attr'];
            if(count($source['children']) > 1)
            {
                $this->transformed_data[0][$source['name']]['data'] = $this->transformData($source['children']);
            }
        }
        else
        {
            foreach($source as $record)
            {
                $tmp1 = array();
                $tmp1[$record['name']]['attr'] = $record['attr'];
                if(isset($record['children'][0]['name']))
                {
                    $tmp1[$record['name']]['data'] = $this->transformData($record['children']);
                }
                else
                {
                    $tmp1[$record['name']]['data'] = $record['children'][0];
                }
                $tmp[] = $tmp1;
            }
            return $tmp;
        }
    }


    private $test_data =
        array('name' => 'account',
            'attr' => array('id' => 123456),
            'children' => array(
                array( 'name' => 'name',
                    'attr' => array(),
                    'children' => array('BBC')
                ),
                array('name' => 'monitors',
                    'attr' => array(),
                    'children' => array(array('name' => 'monitor',
                        'attr' => array('id' => 5235632),
                        'children' => array( array( 'name' => 'url',
                            'attr' => array(),
                            'children' => array('http://www.bbc.co.uk/')
                                        )
                        )
                    ),
                        array('name' => 'monitor',
                            'attr' => array('id' => 5235633),
                            'children' => array( array( 'name' => 'url',
                                'attr' => array(),
                                'children' => array('http://www.bbc.co.uk/news')
                                           )
                            )
                        )
                    )
                )
            )
        );
}
