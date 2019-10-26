<?php

function renderData ($our){
    echo '<pre>';
    print_r($our);
    echo '</pre>';
}

$fruits=array('apple', 'banana', 'peach', 'pear');

foreach ($fruits as $key=> $value ){
    if($value=="apple"){
        $our=$value;
        renderData($our);
    }
}
