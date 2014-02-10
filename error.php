<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/png" href="JS-logo.png" />
		<link rel="stylesheet" type="text/css" href="style.css" />
        <title>Hint</title>
		<style>
			div.container {
				text-align: center;
				width: 500px;
				margin-top: 100px;
				margin-left: auto;
				margin-right: auto;
			}
			div.unhappy {
				-moz-transform: rotate(90deg);
				-webkit-transform: rotate(90deg);
				-o-transform: rotate(90deg);
				-ms-transform: rotate(90deg);
				transform: rotate(90deg);
				font-size: 50pt;
				width: 100px;
				height: 100px;
				margin-left: 190px;
				margin-top: 50px;
			}
			div.validate {
				position: absolute;
				bottom: 20px;
				right: 20px;
			}
		</style>
    </head>
    <body>
		<div class="header">
			<img src="MUM-logo.png" alt="MUM logo" />
			<h1><img src="jshint.png" alt="JS Hint logo" height="50"/>&nbsp;Result:</h1>
			<h2><?= $src ?></h2>
			<div id="other"><a href="http://mumstudents.org/jshint/">Validate a different page?</a></div>
		</div>
		<div class="container">
			<div class="error"><?= $error ?></div>
			<div class="unhappy">8(</div>
		</div> <!-- closing container -->
		<div class="validate">
			<a href="http://validator.w3.org/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-html.png" alt="html validator"/></a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-css.png" alt="css validator"/></a>
			<a href="http://mumstudents.org/jshint/referer.php"><img src="http://mumstudents.org/jshint/jshint-small.png" alt="js validator"/></a>
		</div>
    </body>
</html>

