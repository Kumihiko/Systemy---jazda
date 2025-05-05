<?php
session_start();

// Ustawienie kodu
$kod = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);
$_SESSION['captcha'] = $kod;

// Tworzenie obrazu
$img = imagecreatetruecolor(120, 40);
$bg = imagecolorallocate($img, 255, 255, 255);
$fg = imagecolorallocate($img, 0, 0, 0);
imagefilledrectangle($img, 0, 0, 120, 40, $bg);

// Dodanie kodu
$font_size = 5;
$x = 10;
$y = 12;
imagestring($img, $font_size, $x, $y, $kod, $fg);

// Nagłówki
header("Content-type: image/png");

// Wygenerowanie obrazka
imagepng($img);
imagedestroy($img);
