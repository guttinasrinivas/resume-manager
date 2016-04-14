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

<title>Project list entry</title>

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
    <!-- Plugins -->
    <script src="js/jquery.serialize-object.min.js"></script>
    
    <script>
    $(document).ready(function(){
        $('#btGo').click(function(event) {
            var form_data = JSON.parse($('#fmProjectEdit').serializeJSON());
            form_data.tools = $.map(form_data.tools.split(","), $.trim);
            form_data.platforms = $.map(form_data.platforms.split(","), $.trim);
            form_data.summary = form_data.summary.split("\r\n");
            form_data.contributions = form_data.contributions.split("\r\n");
            var form_json = { "data" : JSON.stringify(form_data) };
            $.post('update.php',
                    form_json,
                    function(data, status) {
                        $('#fmProjectEdit')[0].reset();
                        $('#dvResp').text("Data: " + data + "\nStatus: " + status);
                    });
        });
    });
    </script>
</head>

<body role="document">
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-10">
	<form id="fmProjectEdit" class="form-horizontal" role="form">
        <?php
            require_once('CV_ProjectEntry.php');
            $form_list = array();
            $form_list[] = new Views\Controls\CV_ProjectEntry("category", "text");
            $form_list[] = new Views\Controls\CV_ProjectEntry("title", "text");
            $form_list[] = new Views\Controls\CV_ProjectEntry("product", "text");
            $form_list[] = new Views\Controls\CV_ProjectEntry("tools", "text");
            $form_list[] = new Views\Controls\CV_ProjectEntry("platforms", "text");
            
            $fobj_summ = new Views\Controls\CV_ProjectEntry("summary", "textarea");
            $fobj_summ->height = 4;
            
            $fobj_cont = new Views\Controls\CV_ProjectEntry("contributions", "textarea");
            $fobj_cont->height = 5;
            
            $form_list[] = $fobj_summ;
            $form_list[] = $fobj_cont;
            
            foreach($form_list as $form_elmt)
            {
                $rndr_str = $form_elmt->render();
                echo $rndr_str;
            }
        ?>
		<div class="form-group">
            <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                    <input type="button" class="form-control btn-primary" id="btGo" value="Add Project"></input>
                </div>
                <div class="col-sm-5"></div>
            </div>
        </div>
        <div class="row">
            <div id="dvResp"></div>
        </div>
	</form>
</div>
<div class="col-sm-1"></div>
</body>
</html>