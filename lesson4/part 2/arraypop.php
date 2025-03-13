<?php 

$sports = ["futboll","basketball","voleyball"];
array_pop($sports);

array_push($sports,"hello");


for($i=0; $i<3; $i++){
    echo $sports[$i];
    echo '<br>';
}

?>