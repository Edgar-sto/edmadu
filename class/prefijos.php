<?php
const all_prefijos      =   array(
    'Marcatel'    =>  "15','777",
    'MCM'         =>  "11','999",
    'Ipcom'       =>  "28','444",
    'Haz'         =>  "14','555"
);

/** Marcatel */
const carrier_mtel      =  "marcatel";
const prefijos_marcatel =  "15','777";
const prefijo_mtel_ind  =  array("15", "777");

/** MCM */
const carrier_mcm      =  "mcm";
const prefijos_mcm     =  "11','999";
const prefijo_mcm_div  =  array("11", "999");

/**IPCOM */
const carrier_ipcom      =  "ipcom";
const prefijos_ipcom     =  "28','444";
const prefijo_ipcom_div  =  array("28", "444");

/**HAZ */
const carrier_haz       =  "haz";
const prefijos_haz      =   "14','555";
const prefijo_haz_div   =  array("14", "555");

/**ALL */
const prefijos_individuales = array("15", "777", "11", "999", "28", "444", "14", "555");
const prefijos_individuales_por_carrier = array("15','777", "11','999", "28','444", "14','555");
const prefijos_juntos_minutos = array("15','777','11','999','28','444");
const prefijos_juntos_segundos = array("14','555");


?>
