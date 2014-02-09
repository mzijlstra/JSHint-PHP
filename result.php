<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/png" href="JS-logo.png" />
		<link rel="stylesheet" type="text/css" href="style.css" />
        <title>Hint</title>
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
    </body>
</html>
