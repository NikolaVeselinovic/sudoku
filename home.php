<?php
include "back-end/user.php";
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: login.php");
}
?>
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
	<script>
		var id = '<?php echo $_SESSION['user']->id?>';
		(function() {
            var css = document.createElement('link');
            css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css';
            css.rel = 'stylesheet';
            css.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>
</head>

<body class="home-sudoku">
	<header>
		<div class="menu">
			<a href="#" class="newgame">New Game</a>
			<a href="#" class="pause">Pause</a>
			<a href="#" class="restart">Restart</a>
		</div>
	</header>
	<main class="sudoku-grid">
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
				<span>Your time is: <span class="stopwatch"></span> </span>
				<a href="#" class="newgame">New Game</a>
				<a href="#" class="restart">Restart</a>
				<a href="menu.php">Back to Menu</a>
			</div>
		</div>
		<div class="check f">
			<div class="cover"> </div>
			<div class="button-title">
				<h3>Failed!</h3>
				<span><a href="#" class="continue">Try Again</a></span>
				<a href="#" class="newgame">New Game</a>
				<a href="#" class="restart">Restart</a>
				<a href="menu.php">Back to Menu</a>

			</div>
		</div>
		<div class="table">
			<div class="tbl-holder">
				<table id="sudoku"></table>
			</div>
		</div>
	</main>
	<footer>
		<div class="footer-content">
			<div class="stopwatch"></div>
			<a href="#" id="check">Check</a>
		</div>
	</footer>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/local.js"></script>
</body>

</html>