<?php

namespace Hcode;

use Rain\Tpl;

class Page {

    private $tpl;
    private $options = [];
    private $default = [

        "header" => true,
        "footer" => true,
        "data" => []

    ];

    public function __construct($opts = array()){

        $this->options = array_merge($this->default, $opts);

        $config = array(
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/2020/views/",
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/2020/views/views-cache/",
            "debug"         => false // set to false to improve the speed
        );

        Tpl::configure( $config );
        
        $this->tpl = new Tpl;
        $this->setData($this->options["data"]);
        if($this->options["header"] === true) {$this->tpl->draw("header");}

    }

    public function setTpl($name, $data = array(), $returnHTML = false){

        $this->setData($data);
        return $this->tpl->draw($name, $returnHTML);

    }

    private function setData($data = array()){

        foreach ($data as $key => $value){
            $this->tpl->assign($key, $value);
        }

    }


    public function __destruct(){

        if($this->options["footer"] === true){ $this->tpl->draw("footer");}

    }


}