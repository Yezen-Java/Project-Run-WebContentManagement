<?php
function getExtension($str) 
{
         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP","txt","mp4","mp3","m4v","avi","mpeg");

$imageFormates = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF");

?>