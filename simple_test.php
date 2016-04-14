<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Projects list</title>
<style>
table,tr {
    vertical-align: top;
}

td.label {
    width: 30%;
    vertical-align: top;
}

td.text {
    width: 70%;
    vertical-align: top;
}
</style>
</head>

<body>
<?php
require_once('DV_ProjectView.php');
require_once('DV_SimpleHeadings.php');
$pview = new Views\Display\DV_SimpleHeadings('eg.json');

/*
$pview->prj_cntr_class = "panel panel-default";
$pview->title_cntnr_class = "panel-heading";
$pview->title_class = "panel-title";
$pview->body_cntr_class = "panel-body";
$pview->lbl_class = "text-default text-right col-sm-2";
$pview->cntnt_class = "text-default col-sm-10";
*/
$pview->hdng_lvl = "h3";
$pview->lbl_lvl = "b";
$pview->body_lvl = "";

$pview->render();
$first = true;
foreach ($pview->render_strs as $proj_block) {
    echo $proj_block;
}
//echo $pview->rndr_str . "\n";
?>
</div>
</body>
</html>
