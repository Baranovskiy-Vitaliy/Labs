<?php

function mySin($x){
    return sin($x);
}

function myCos($x){
    return cos($x);
}

function myTan($x){
    return tan($x);
}

function myPow($x, $y){
    return pow($x, $y);
}

function myFact($x){
    if($x > 0)
        return $x * myFact($x - 1);
    elseif($x == 0)
            return 1;
    elseif($x < 0)
         return $x * myFact($x + 1);
}

?>