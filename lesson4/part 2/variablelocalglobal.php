<?php 
$x = 4;//global variable

function localvariable(){
    $y = 10;
    echo $y;

}

localvariable();
echo"\n , $x";

?>