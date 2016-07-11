<?php

include 'Models/image.php';
include 'Models/cache.php';

$picPath = 'Big_Bear_Valley_California.jpg';
$width = 400;
$height = 400;

$image = new image();
$image->showImage($picPath,$width,$height);

?>