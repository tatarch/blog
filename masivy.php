<?php

function renderFruits (){
    echo '<pre>';
    print_r($our);
    '</pre>';
}

$fruits=array('apple', 'banana', 'peach', 'pear');

foreach ($fruits as $key=> $value ){
    if($key==3){
        $our=$value;
        renderFruits();
    }
}
