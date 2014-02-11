<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Hint</title>
		<link rel="shortcut icon" type="image/png" href="JS-logo.png" />
		<link rel="stylesheet" type="text/css" href="style.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="index.js"></script>
		<style>
			div.container {
				margin: 0em 1em;
			}
			div#other {
				line-height: 10px;
			}
			h2 {
				margin-left: 1em;
				margin-bottom: 0px;
				margin-top: 2em;
			}
			div.num {
				border: 1px solid black;
				border-right: none;
				float: left;
				width: 100px;
				height: 100px;
				font-size: 32pt;
				background-color: #FCDC5C;
				text-align: center;
				line-height: 100px;
				margin-bottom: 20px;
			}
			div.way {
				border: 1px solid black;
				min-height: 60px;
				padding: 20px;
				margin-left: 100px;
				margin-bottom: 20px;
				position: relative;
			}
			code {
				font-weight: bold;
			}
			input#uri {
				width: 100%;
			}
			textarea {
				width: 100%;
				height: 250px;
			}
			div#result {
				color: red;
				padding-top: 20px;;
			}
		</style>
    </head>
    <body>
	<div class="header">
		<img src="MUM-logo.png" alt="MUM logo" />
		<h1>MUMStudents.org</h1>
		<div id="other"><a href="http://jshint.com/about/"><img src="jshint.png" alt="JS Hint logo" height="50"/><br />more about jshint</a></div>
	</div>

	<h2>3 Ways to Validate: </h2>
	<div class="container">
		<div class="num">1</div>
		<div class="way">
			Include this link on your page:<br />
			<code><?= htmlspecialchars('<a href="http://mumstudents.org/jshint/referer.php"><img src="http://mumstudents.org/jshint/jshint-small.png" alt="js validator"/></a>')?></code>
		</div>

		<div class="num">2</div>
		<div class="way">
			<form action="check.php">
			<input placeholder="Paste a URL" id="uri" type="text" name="uri" />
			<input type="submit" value="Validate" />
			</form>
		</div>
		<div class="num">3</div>
        <div class="way">
            <textarea id="jsText" placeholder="Paste JavaScript"></textarea>
            <button id="check">Validate</button>
            <div id="result"></div>
        </div>        
	</div> <!-- closing container -->
	<div class="validate">
		<a href="http://validator.w3.org/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-html.png" alt="html validator"/></a>
		<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-css.png" alt="css validator"/></a>
		<a href="http://mumstudents.org/jshint/referer.php"><img src="http://mumstudents.org/jshint/jshint-small.png" alt="js validator"/></a>
	</div>
    </body>
</html>
