<?php

function renderData($our)
{
    echo '<pre>';
    print_r($our);
    echo '</pre>';
}

$fruits = array('apple', 'banana', 'peach', 'pear');

foreach ($fruits as $fruit) {
    if ($fruit == "apple") {
        $our = $fruit;
        renderData($our);
    }
}

$transportDescription = [
    'rocket' => 'Can fly. Super fast',
    'bicycle' => 'Cheap but slow',
    'car' => 'Average price. Need roads and other infrastructure',
    'ship' => 'I\'m a pirate! Yo-ho-ho!'
];


foreach ($transportDescription as $transport => $description) {
    if ($transport == "ship") {
        $our = $fruit;
    }
}

$kostyaArray = [
    [
        'name' => 'Ivan',
        'age'  => 29
    ],
    [
        'name' => 'Alyona',
        'age'  => 21
    ],
    [
        'name' => 'Kostya',
        'age'  => 22
    ],
];

$data["Ivan"] = array('name' => 'Ivan', 'age' => 29);
$data["Alona"] = array('name' => 'Alyona', 'age' => 21);
$data["Kostya"] = array('name' => 'Kostya', 'age' => 22);

foreach ($data as $key => $fruit) {
    if ($key == "Alona") {
        $our = $fruit['age'];
        renderData($our);
    }
}

renderData($data);
renderData($kostyaArray);
die();

