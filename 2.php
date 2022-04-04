<?php
function Url($url){
   $output=substr($url, strrpos($url, '/' )+1);
return $output;

}

echo Url('www.example.com/5478631');
?>



