<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Template
 *
 * @author we017321
 */
class Template {
    private $data;
    public function _construct() {
        $this->data = array();
    }
    
    public function assign($key, $value) {
        $this->data[$key] = $value;
    }
    
    public function display($text) {
        $stuff = file_get_contents($text);
        foreach($this->data as $key => $value)
        {
            $replace = '{$'.$key.'}';
            $stuff=str_replace($replace, $value, $stuff);
        }
        echo $stuff;
    }
    
}
