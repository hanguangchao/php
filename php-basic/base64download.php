<?php 

$baseFromJavascript= file_get_contents(__DIR__ . '/base64img.txt'); 
$base_to_php = explode(',', $baseFromJavascript);
$data = base64_decode($base_to_php[1]);

header('Content-Disposition: attachment;filename="test.png"');
header('Content-Type: application/force-download'); 

file_put_contents('1.png', $data);

$im = imagecreatefromstring($data);
if ($im !== false) {
    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
}
