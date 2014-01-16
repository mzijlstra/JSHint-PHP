<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MUM Students JSHint</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="index.js"></script>
    </head>
    <body>
        <h1>MUM Students JSHint</h1>
        <p>Checks your javascript for problems / errors. The backend for this system uses <a href="">JSHint</a></p>
        <p>Preferred way to use:
            <ol>
                <li>Place a link to http://mumstudents.org/jshint/referer.php on your web page</li>
            </ol>
        </p>
        <p>
            You can also copy / paste javascript into the textbox below, and use the check button
        </p>
        <div>
            <textarea id="jsText" placeholder="Your JS here"></textarea>
            <button id="check">Check</button>
            <div id="result"></div>
        </div>        
		<div>
			<a href="http://mumstudents.org/jshint/referer.php"><img src="jshint-small.png"/></a>
		</div>
    </body>
</html>
