<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Check</title>
		<link rel="shortcut icon" type="image/png" href="JS-logo.png" />
		<link rel="stylesheet" type="text/css" href="style.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="index.js"></script>
		<style>
			div.container {
				margin: 0em 1em;
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
            #result {
                border: none;
            }
		</style>
    </head>
    <body>
	<div class="header">
		<img src="MUM-logo.png" alt="MUM logo" />
        <h1>
            <span>JS</span>Check 
            <select name="v">
                <option>jslint</option>
                <option <?= $validator === "jshint" ? "selected" : "" ?>>jshint</option>
            </select>
        </h1>
		<div class="other"><a href="http://www.jslint.com/lint.html">more about jslint</a></div>
		<div class="other"><a href="http://jshint.com/about/">more about jshint</a></div>
	</div>

	<h2>3 Ways to Validate: </h2>
	<div class="container">
		<div class="num">1</div>
		<div class="way">
			Include this link on your page:<br />
			<code><?= htmlspecialchars('<a href="http://mumstudents.org/jscheck/referer.php"><img src="http://mumstudents.org/jscheck/jscheck-small.png" alt="mumstudents JS check"/></a>')?></code>
		</div>

		<div class="num">2</div>
		<div class="way">
        <form action="check.php">
            <input type="hidden" name="v" value="jslint" id="validator" />
			<input placeholder="Paste a URL" id="uri" type="text" name="uri" />
			<input type="submit" value="Validate" />
        </form>
		</div>
		<div class="num">3</div>
        <div class="way">
            <textarea id="jsText" placeholder="Paste JavaScript"></textarea>
            <button id="check">Validate</button>
            <div class="result" id="result"></div>
        </div>        
	</div> <!-- closing container -->
	<div class="validate">
		<a href="http://validator.w3.org/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-html.png" alt="html validator"/></a>
		<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-css.png" alt="css validator"/></a>
		<a href="http://mumstudents.org/jscheck/referer.php"><img src="http://mumstudents.org/jscheck/jscheck-small.png" alt="mumstudents JS check"/></a>
	</div>
    </body>
</html>
