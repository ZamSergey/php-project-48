<?php

namespace GenDiff\FileParser;

function genDiff($file1, $file2)
{
    $key1 = (parseFile($file1));
    $key2 = (parseFile($file2));

    $keys = array_merge($key1,$key2);
    ksort($keys);
   
    $result = '';
    
    foreach($keys as $key => $val) {
        $difString = '';
        if(array_key_exists($key,$key1) && array_key_exists($key,$key2) && $key1[$key] === $key2[$key]) {
            $difString = "  $key: $val \r\n";
        }
        elseif(array_key_exists($key,$key1) && array_key_exists($key,$key2) && $key1[$key] !== $key2[$key]) {
            $difString = "- $key: {$key1[$key]}\r\n";
            $difString .="    + $key: $key2[$key]\r\n";
        }
        elseif(array_key_exists($key,$key1) && !array_key_exists($key,$key2)) {
            $difString = "- $key: {$key1[$key]}\r\n";
        }
        elseif(!array_key_exists($key,$key1) && array_key_exists($key,$key2)) {
            $difString = "+ $key: {$key2[$key]}\r\n";
        }
        $result .= "    $difString";
    }

    echo "{\r\n$result}\r\n";
   
}

function parseFile(String $fileSrc) : Array
{
    $fileContent = file_get_contents($fileSrc, FILE_USE_INCLUDE_PATH);
    $data = json_decode($fileContent);
    
    $keys = get_object_vars($data);    
    return $keys;
}