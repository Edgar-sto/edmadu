<?php

class PixelEm {
    
    public function __construct($p)
    {
        $this->pixel    =    $p;
        $this->valorEm   =    "0.0625";
        
    }

    public function convertirPixelEm() {
        $conversion    =    $this->pixel * $this->valorEm;
        return $conversion;
    }

}