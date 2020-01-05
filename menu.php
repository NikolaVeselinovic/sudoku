<?php
include "back-end/user.php";
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="fonts/font-style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <link rel="stylesheet" type="text/css" href="css/style-responsive.css">

    <title>Sudoku - Menu</title>
</head>

<body>
    <main>
        <section class="welcome">
            <div class="main-menu">
                <p>Menu</p>
                <em>Hi <?php echo $_SESSION['user']->name . ' ' .  $_SESSION['user']->lastname ?>!</em>
                <a href="home.php">New Game</a>
                <a href="rank.php">Ranking List</a>
                <a href="edit-profile.php">Edit Profile</a>
                <?php if($_SESSION['user']->isAdmin){ ?>
                    <a href="allusers.php">All Users</a>
                <?php } ?>
                <a href="#" onclick="logout();return false;">LogOut</a>
            </div>
        </section>
    </main>
</body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="js/script.js"></script>
</html>