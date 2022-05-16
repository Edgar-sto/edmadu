<?php
 include_once '../../class/PixelEm.php';

$pixel = $_POST['tamaniopixel'];

$conversionPixEm = new PixelEm($pixel);
//$conversionPixEm -> convertirPixelEm($pixel);

echo '<div class="alert alert-success">Tamaño en EM: <strong>'.$conversionPixEm -> convertirPixelEm($pixel).'</strong></div>';





// PHP program to convert pixel to rem and em
                                // Function to convert pixel to rem and em
                                // function Conversion($a)
                                // {
                                //     $em=0;
                                //     //$rem = 0.0625 * $pixel;
                                //     $em =  0.0625 * $a;
                                    
                                //     //echo("The value in em is " . $em . "\n");
                                //     //echo("The value in rem is " . $rem . "\n");
                                //     return $em;
                                    
                                // }                                // Driver Code
                                // if (isset($_POST['submitPixel'])) {
                                //     $pixel = (int)$_POST['tamaniopixel'];   
                                //     echo '<div class="alert alert-success">Tamaño en EM: <strong>'.Conversion($pixel).'</strong></div>';
                                // }
                                //$pixel = 45;
                                //Conversion($pixel);
?>