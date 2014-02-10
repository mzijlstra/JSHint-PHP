<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/png" href="JS-logo.png" />
		<link rel="stylesheet" type="text/css" href="style.css" />
        <title>Hint</title>
		<style>
			h1 {
				font-family: "Arial";
			}
			h1 > img {
				position: relative;
				top: 3px;
			}
			div.container {
				padding: 0em 1em;
			}
			div.name {
				float: left;
				border-bottom: none
			}
			div.js, div.result {
				clear: left;
			}
			div.js {
				border-bottom: none;
			}
		</style>
    </head>
    <body>

	<div class="header">
		<img src="MUM-logo.png" alt="MUM logo" />
		<h1><img src="jshint.png" alt="JS Hint logo" height="50"/>&nbsp;Result:</h1>
		<h2><?= $src ?></h2>
	</div>
	<div class="container">
	<?php foreach($output as $file => $out): ?>
		<div class="file">
			<div class="name"><?= $file ?></div>
			<?php if ($out['js']): ?>
				<div class="js">
				<?php for ($i = 0; $i < count($out['js']); $i++): ?>
					<?php $line = $out['js'][$i]; ?>
					<div class="line"><?= $i+1 ?></div>
					<div <?= in_array($i + 1, $out['lines']) ? 'class="warn"' : ''?>><?= $line ?>&nbsp;</div>
				<?php endfor ?>
				</div>
			<?php endif ?>
			<?php if ($out['result']): ?>
				<div class="result bad"><?=$out['result'] ?></div>
			<?php else: ?>
				<div class="result good">No errors found!</div>
			<?php endif ?>
		</div> <!-- closing file -->
	<?php endforeach ?>
	</div> <!-- closing container -->
	<div class="validate">
		<a href="http://validator.w3.org/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-html.png" alt="html validator"/></a>
		<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://mumstudents.org/cs472/2013-09/images/w3c-css.png" alt="css validator"/></a>
		<a href="http://mumstudents.org/jshint/referer.php"><img src="http://mumstudents.org/jshint/jshint-small.png" alt="js validator"/></a>
	</div>
    </body>
</html>
