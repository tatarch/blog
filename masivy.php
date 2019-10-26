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

$transportDescription = [
    'rocket'  => 'Can fly. Super fast',
    'bicycle' => 'Cheap but slow',
    'car'     => 'Average price. Need roads and other infrastructure',
    'ship'    => 'I\'m a pirate! Yo-ho-ho!'
];

foreach ($transportDescription as $key=> $value ){
    if($key=="ship"){
        $our=$value;
        renderData($our);
    }
}

$data["Ivan"]=array('name' => 'Ivan', 'age'  => 29);
$data["Alona"]=array( 'name' => 'Alyona', 'age'  => 21);
$data["Kostya"]=array('name' => 'Kostya', 'age'  => 22);

foreach ($data as $key=> $value ){
    if($key=="Alona"){
        $our=$value['age'];
        renderData($our);
    }
}


