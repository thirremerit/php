<?php 
$x = 4;//global variable

function localvariable(){
    global $x;
    $y =10;
    echo $y;
    echo $x;
}

localvariable();
echo"\n , $x";

?>
