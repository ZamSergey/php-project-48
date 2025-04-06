<?php

namespace GenDiff\FileParser;

function parseFile($fileSrc)
{

    $fileContent = file_get_contents($fileSrc, FILE_USE_INCLUDE_PATH);
    $data = json_decode($fileContent);
    $keys = (get_object_vars($data));
    print_r($keys);
}