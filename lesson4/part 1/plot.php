<?php

function plot($n){
   if(($n % 2) ){
   return 'nuk eshte plot';
   }else{
    return ' eshte plot';
   }
}
print_r (plot(10));





?>