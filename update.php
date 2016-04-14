<?php
$json_fname = 'eg.json';
$json_fname_bak = 'eg.bak.json';

if (!array_key_exists('data',$_POST)) {
    die('');
}

$new_data = json_decode($_POST['data']);

// TODO: Convert strings in incoming JSON to arrays of strings

$json_data = json_decode(file_get_contents($json_fname));
$json_fh = fopen($json_fname_bak, 'w+') or die('Could not open JSON backup DB.');
fwrite($json_fh, json_encode($json_data));
fclose($json_fh);


$json_data[] = $new_data;
$json_fh = fopen($json_fname, 'w+') or die('Could not open JSON DB.');
fwrite($json_fh, json_encode($json_data, JSON_PRETTY_PRINT));
fclose($json_fh);
echo "Written the data to DB.";

?>