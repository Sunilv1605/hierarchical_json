<?php
/*
* include class 'services'
*/
require('./services/Services.php');
/********** get flattened-json data **********/
$file_path = "./flatten.json";
$file = fopen($file_path,"r");
$input_data = fread($file,filesize($file_path));
fclose($file);
$flatten_data = json_decode($input_data, true);
/********** get flattened-json data **********/

/* pass "flattened JSON" data & get output in the form of "hierarchical JSON" */
$managers = Services::nest($flatten_data, 'id', 'parent', 'child');

/********** save converted data **********/
$hierarchical_file = "./hierarchical.json";
$hierarchical = fopen($hierarchical_file, "w");
fwrite($hierarchical, json_encode($managers));
fclose($hierarchical);
/********** save converted data **********/
?>