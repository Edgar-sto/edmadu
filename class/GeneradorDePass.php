<?php

class GeneradorDePass {

    public function __construct($tamanio_pass)
    {
        $this->tamanio    =    $tamanio_pass;        
    }

    public function generatePasswordLevelSeven()
    {
        $key = "";
	$pattern = "qpbd";
        //$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        //$pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ.-_*/=[]{}#@|~¬&()?¿";
        $max = strlen($pattern)-1;
        for($i = 0; $i < $this->tamanio; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        return $key;
    }
}