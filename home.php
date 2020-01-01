<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main-style.css">
	<link rel="stylesheet" type="text/css" href="css/style-responsive.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sudoku</title>
</head>
<body>
	<header>
		<div class="menu">
			<a href="#" class="newgame">New Game</a>
			<a href="#" class="pause">Pause</a>
			<a href="#" class="restart">Restart</a>
		</div>
	</header>
	<main>
		<h1>Sudoku</h1>
		<div class="on open">
			<div class="cover"> </div>
			<div class="button-title">
				<a href="#" class="start">Start</a>
				<span>Welcome to Sudoku!</span>
			</div>
		</div>
		<div class="on paus">
			<div class="cover"> </div>
			<div class="button-title">
				<a href="#" class="continue"><img src="img/play.png"></a>
				<span>Press to continue...</span>
			</div>
		</div>
		<div class="check p">
			<div class="cover"> </div>
			<div class="button-title">
				<h3>Successfully Finished!</h3>
				<span>Your time is:  <span class="stopwatch"></span> </span>
				<a href="#" class="newgame">New Game</a>
				<a href="#" class="restart">Restart</a>
			</div>
		</div>
		<div class="check f">
			<div class="cover"> </div>
			<div class="button-title">
				<h3>Failed!</h3>
				<span><a href="#" class="continue">Try Again</a></span>
				<a href="#" class="newgame">New Game</a>
				<a href="#" class="restart">Restart</a>
			</div>
		</div>
		<div class="table">
			<div class="img-holder">
				<img src="img/eraser.png">
			</div>
			<div class="tbl-holder">
				<table id="sudoku"></table>
			</div>
			<div class="img-holder">
				<img src="img/pen.png">
			</div>
		</div>
	</main>
	<footer>
		<div class="stopwatch"></div>
		<a href="#" id="check">Check</a>
	</footer>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/local.js"></script>
</body>	
</html>