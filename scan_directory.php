<?php

ini_set('max_execution_time', 0);

ini_set('memory_limit', '-1');

//Defiening the function
function RetriveDirectoryFiles($directory, $recursive) {
    $array_items = array();
    if ($handle = opendir($directory)) {
        while (false !== ($file = readdir($handle) )) {
            if ($file != "." && $file != "..") {
                if (is_dir($directory . "/" . $file)) {
                    if ($recursive) {
                        $array_items = array_merge($array_items, RetriveDirectoryFiles($directory . "/" . $file, $recursive));//calling function again if directory found
                    }
                    $file = $directory . "/" . $file;
                } else {
                    $file = $directory . "/" . $file;
                    $file = str_replace("../", "", $file);
                    $array_items[] = $file;//pushing the file in the array
                    chmod($file, 0777);
                }
            }
        }
        closedir($handle);
    }
    return $array_items;
}
//specify the path
$path = 'D:\TEST FILES';
//calling the function with the path
$files = RetriveDirectoryFiles($path, true);

print_r($files);
?>
