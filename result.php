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
			h2 {
				margin-bottom: 0px;
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
			div#other {
				margin-left: 120px;
			}
			div#other a:link, div#other a:visited {
				color: #555;
				font-size: 8pt;
				text-decoration: none;
			}
			span.error {
				background-color: #F77;
			}
		</style>
    </head>
    <body>
	<pre><?= var_dump($output)?></pre>
	<div class="header">
		<img src="MUM-logo.png" alt="MUM logo" />
		<h1><img src="jshint.png" alt="JS Hint logo" height="50"/>&nbsp;Result:</h1>
		<h2><?= $src ?></h2>
		<div id="other"><a href="http://mumstudents.org/jshint/">Validate a different page?</a></div>
	</div>
	<div class="container">
	<?php foreach($output as $file => $out): ?>
		<div class="file">
			<div class="name"><?= $file ?></div>
			<?php if ($out['js']): ?>
				<div class="js">
				<?php for ($i = 0; $i < count($out['js']); $i++): ?>
					<?php $line = $out['js'][$i]; ?>
						<?php if (!isset($out['lines'][$i + 1])) : ?>
							<div class="line"><?= $i+1 ?></div>
							<div><?= htmlspecialchars($line) ?>&nbsp;</div>
						<?php else : ?>
							<div class="line"><?= $i+1 ?></div>
							<div class="warn"><?php for ($col = 0; $col < strlen($line); $col++): ?><?php if ($col != $out['lines'][$i +1] - 1): ?><?= htmlspecialchars($line[$col]) ?><?php else: ?><span class="error"><?= htmlspecialchars($line[$col]) ?></span><?php endif; ?><?php endfor; ?></div>
						<?php endif ?>
				<?php endfor ?>
				</div>
			<?php endif ?>
			<?php if ($out['result']): ?>
				<div class="result bad"><?= htmlspecialchars($out['result']) ?></div>
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
