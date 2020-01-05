<?php
include("back-end/user.php");
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$ch = curl_init('http://localhost/sudoku/back-end/users');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result_json = json_decode($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <link rel="stylesheet" type="text/css" href="css/style-responsive.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            getAllUsers('<?php echo $_SESSION['user']->id; ?>', '', '', '');

            $('#search').on('input', function(e) {
                setTimeout(function() {
                    getAllUsers('<?php echo $_SESSION['user']->id; ?>', $('#search').val());
                }, 500);
            });

        });
        (function() {
            var css = document.createElement('link');
            css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css';
            css.rel = 'stylesheet';
            css.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All users</title>
</head>

<body>
    <main>
        <section class="welcome">
            <div class="allusers">
                <h5><a href="menu.php"><i class="fas fa-chevron-left"></i></a>All users</h5>
                <ul>
                    <li>
                        <em>&#8470;</em>
                        <em>Username</em>
                        <em>Name</em>
                        <em>Lastname</em>
                        <em></em>
                    </li>
                    
                    <li class="search">
                        <form autocomplete="off" action="" name="search" class="form">
                            <label>Search: </label>
                            <i class="fas fa-search"></i>
                            <input id="search" type="text" name="search" placeholder="Keyword">
                        </form>
                    </li>
                </ul>
            </div>
        </section>
    </main>

</body>


</html>