<?php

function gera_title($link)
{
    $url = $link;
   	$json = @file_get_contents($url);
    $decode = json_decode($json);
   if ($decode == false) {
    } else {
       $titulo = $decode->title;
       return $titulo;
    }
}