<?php

$a = array(1,1.001,3,"4","51");

echo "<pre>";

var_export($a);

echo "<br>";

print_r($a);

echo "<br>";

var_dump($a);

echo "</pre>";

$b = $a[1]*1000;

echo "<pre>";

var_export($b);

echo "<br>";

print_r($b);

echo "<br>";

var_dump($b);

echo "</pre>";

?>