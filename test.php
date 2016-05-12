<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="bootstrap-3.3.6/favicon.ico">

<title>Projects list</title>

<!-- Bootstrap core CSS -->
<link href="bootstrap-3.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="bootstrap-3.3.6/dist/css/bootstrap-theme.min.css"
    rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link
    href="bootstrap-3.3.6/docs/assets/css/ie10-viewport-bug-workaround.css"
    rel="stylesheet">

<!-- Custom styles for this template -->
<link href="bootstrap-3.3.6/docs/examples/theme/theme.css"
    rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="bootstrap-3.3.6/docs/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script
    src="bootstrap-3.3.6/docs/assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="bootstrap-3.3.6/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap-3.3.6/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.6/docs/assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap-3.3.6/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <style>
        @media (min-width: 979px) {
                ul.nav li.dropdown:hover > ul.dropdown-menu {
                display: block;
            }
        }
        
        .row-padded {
            padding-top: 5px;
            padding-right: 3px;
            padding-bottom: 5px;
            padding-left: 8px;
        }
    </style>
</head>

<body role="document">
<div class="container theme-showcase" role="main">
<?php
require_once('DV_ProjectView.php');
require_once('DV_SimpleHeadings.php');
require_once('DV_Panel.php');

echo '<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">Guttina Srinivas</div>
        </div>
        <div id="navbar" class="navbar-collapse collapse">';

$pview = new DV_SimpleHeadings('eg.json');

$use_theme = false;
if ($use_theme)
{
    $pview->prj_cntr_class = "panel panel-default";
    $pview->title_cntnr_class = "panel-heading";
    $pview->title_class = "panel-title";
    $pview->body_cntr_class = "panel-body";
    $pview->lbl_class = "text-default text-right col-sm-2";
    $pview->cntnt_class = "text-default col-sm-10";
}
else
{
    $pview->hdng_lvl = "h1";
    $pview->lbl_lvl = "b";
    $pview->body_lvl = "";
}

$req_cat = "";
if (array_key_exists("category", $_GET)) {
    $req_cat = $_GET["category"];
}

$pview->render($req_cat);

# Build menus
$cat = new DV_Panel();
$link = $_SERVER['REQUEST_SCHEME'];
$link .= "://" . $_SERVER['SERVER_NAME'];
$link .= $_SERVER['PHP_SELF'];
$link .= "?";
foreach($pview->categories as $ctg) {
    $params = array();
    $params["category"] = $ctg;
    $addr = $link . http_build_query($params);
    $cat->add_menu(ucwords($ctg), $addr);
}
echo $cat->render();

echo '</div></nav></div>
<div class="container theme-showcase" role="main">';
/*echo '<div class="row">';
echo '<div class="col-sm-12">';*/

$first = true;
foreach ($pview->render_strs as $proj_block) {
    echo $proj_block;
}

//echo '</div></div>';
//echo $pview->rndr_str . "\n";
?>
</div>
</body>
</html>
